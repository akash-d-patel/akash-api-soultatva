<?php

namespace App\Models;

use App\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;

class RecipeProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "recipe_products";

    protected $sortParameterName = 'sort';

    public $sortable = ['recipe_id', 'product_id', 'created_at'];

    protected $searchable = ['search_txt', 'recipe_id', 'product_id'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('recipe_id', "LIKE", "%" . $constraint->getValue() . "%")
                     ->orWhere('product_id', "LIKE", "%" . $constraint->getValue() . "%");
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        /* client globalscope */
        static::addGlobalScope(new ClientScope);

        self::creating(function($recipeProduct){
        if(Auth::check()){
            $recipeProduct->created_by = Auth::user()->id;
        }
        });

        self::created(function($recipeProduct){
            // ... code here     
        });

        self::updating(function($recipeProduct){
            if(Auth::check()){
            $recipeProduct->updated_by = Auth::user()->id;
            }
        });

        self::updated(function($recipeProduct){
            // ... code here
        });

        self::deleting(function($recipeProduct){
            $recipeProduct->deleted_by = Auth::user()->id;
            $recipeProduct->save();
        });

        self::deleted(function($recipeProduct){

        });
    }
    
    
    public static function createUpdate($recipeProduct, $request){

        if (isset($request->client_id)) {
            $recipeProduct->client_id = $request->client_id;
        } else {
            $recipeProduct->client_id = Auth::user()->client->id;
        }

        if(isset($request->recipe_id)) {
            $recipeProduct->recipe_id = null;
            if(!is_null($request->recipe_id)){
                $recipeProduct->recipe_id = $request->recipe_id;
            }
        }

        if(isset($request->product_id)) {
            $recipeProduct->product_id = null;
            if(!is_null($request->product_id)){
                $recipeProduct->product_id = $request->product_id;
            }
        }

        if (isset($request->status)) {
            $recipeProduct->status = $request->status;
        }

        $recipeProduct->save();

        return $recipeProduct;

    }

    /**
     * Get the user's first name.
     *
     * @param  string  $value
     * @return string
     */
    
    public function getCreatedAttribute()
    {
        return ucfirst($this->creater->name);
    }


    /**
     * Get the phone associated with the user.
     */
    public function creater()
    {
        return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    }

    public function updater()
    {
        return $this->hasOne(User::class, 'id', 'updated_by')->withTrashed();
    }

    public function deleter()
    {
        return $this->hasone(User::class, 'id', 'deleted_by')->withTrasheds();
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
