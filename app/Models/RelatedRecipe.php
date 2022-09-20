<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;

class RelatedRecipe extends Model
{
    use HasFactory;
    use PimpableTrait;
    use SoftDeletes;

    protected $table = 'related_recipes';

    protected $sortParameterName = 'sort';

    public $sortable = ['id', 'recipe_id'];

    protected $searchable = ['search_txt', 'recipe_id'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('recipe_id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($relatedRecipe) {
            if(Auth::check()){

            $relatedRecipe->created_by = Auth::user()->id;
            
            }
           
        });

        self::created(function ($relatedRecipe) {
            // ... code here
        });

        self::updating(function ($relatedRecipe) {
            $relatedRecipe->updated_by = Auth::user()->id;
        });

        self::updated(function ($relatedRecipe) {
            // ... code here
        });

        self::deleting(function ($relatedRecipe) {
            $relatedRecipe->deleted_by = Auth::user()->id;
            $relatedRecipe->save();
        });

        self::deleted(function ($relatedRecipe) {
        });
    }

    public static function createUpdate($recipe, $relatedRecipe, $request)
    {

        if (isset($request->recipe_id)) {
            $relatedRecipe->recipe_id = $request->recipe_id;
        }

        $recipe->relatedRecipes()->save($relatedRecipe);

        return $relatedRecipe;
    }

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


    public function relatedrecipetable()
    {
        return $this->morphTo();
    }

    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'relatedrecipetable_id','id')->where('relatedrecipetable_type', Recipe::class);
    }

    public function recipes()
    {
        return $this->belongsTo(Recipe::class, 'recipe_id');
    }
}
