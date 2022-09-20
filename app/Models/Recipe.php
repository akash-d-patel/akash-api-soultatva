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

class Recipe extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "recipes";

    protected $fillable = ['client_id', 'title', 'slug', 'description', 'ingredient', 'methods', 'status'];

    protected $sortParameterName = 'sort';

    public $sortable = ['title', 'approval_status', 'created_at'];

    protected $searchable = ['search_txt', 'title', 'approval_status'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('name', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orwhere('email', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orwhere('phone', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orwhere('title', "LIKE", "%" . $constraint->getValue() . "%");
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

        self::creating(function ($recipe) {

            if (Auth::check()) {
                $recipe->created_by = Auth::user()->id;
            }
        });

        self::created(function ($recipe) {
            // ... code here
        });

        self::updating(function ($recipe) {
            $recipe->updated_by = Auth::user()->id;
        });

        self::updated(function ($recipe) {
            // ... code here
        });

        self::deleting(function ($recipe) {
            $recipe->deleted_by = Auth::user()->id;
            $recipe->save();
        });

        self::deleted(function ($recipe) {
        });
    }

    public static function addUpdatedRecipes($recipe, $request)
    {
        if (isset($request->client_id)) {
            $recipe->client_id = $request->client_id;
        } else {
            $url = URL('/');
            $client_id = Client::where('name', $url)->value('id');
            $recipe->client_id = $client_id;
        }

        if (isset($request->name)) {
            $recipe->name = $request->name;
        }

        if (isset($request->email)) {
            $recipe->email = $request->email;
        }

        if (isset($request->phone)) {
            $recipe->phone = $request->phone;
        }

        if (isset($request->title)) {
            $recipe->title = $request->title;
        }

        if (isset($request->slug)) {
            $recipe->slug = $request->slug;
        }

        if (isset($request->description)) {
            $recipe->description = $request->description;
        }

        if (isset($request->ingredient)) {
            $recipe->ingredient = $request->ingredient;
        }

        if (isset($request->method)) {
            $recipe->method = $request->method;
        }

        if (isset($request->approval_status)) {
            $recipe->approval_status = $request->approval_status;
        }

        if (isset($request->approval_by)) {
            $recipe->approval_by = $request->approval_by;
        }

        $recipe->save();

        return $recipe;
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

    public function images()
    {
        return $this->morphMany(Image::class, 'imagetable');
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metatable');
    }

    public function schema()
    {
        return $this->morphOne(Schema::class, 'schematable');
    }
    
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewtable');
    }

    public function relatedRecipes()
    {
        return $this->morphMany(RelatedRecipe::class, 'relatedrecipetable');
    }
    public function recipeProducts()
    {
        return $this->hasMany(RecipeProduct::class, 'recipe_id');
    }
}
