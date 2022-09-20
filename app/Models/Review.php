<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Review extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = 'reviews';

    protected $sortParameterName = 'sort';

    public $sortable = ['content','rate', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'status','content', 'rate'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('content', $constraint->getOperator(), $constraint->getValue())
                      ->orwhere('rate', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    
    public static function boot()
    {
        parent::boot();

        self::creating(function ($review) {
            if(Auth::check()){

            $review->created_by = Auth::user()->id;
            
            }
           
        });

        self::created(function ($review) {
            // ... code here
        });

        self::updating(function ($review) {
            $review->updated_by = Auth::user()->id;
        });

        self::updated(function ($review) {
            // ... code here
        });

        self::deleting(function ($review) {
            $review->deleted_by = Auth::user()->id;
            $review->save();
        });

        self::deleted(function ($review) {
        });
    }
    public static function createUpdate($product, $review, $request)
    {

        if (isset($request->name)) {
            $review->name = $request->name;
        } else {
            $review->name = Auth::user()->name;
        }
        if (isset($request->content)) {
            $review->content = $request->content;
        }
        if (isset($request->rate)) {
            $review->rate = $request->rate;
        }
        if (isset($request->like)) {
            $review->like = $request->like;
        }
        if (isset($request->dislike)) {
            $review->dislike = $request->dislike;
        }
        if (isset($request->status)) {
            $review->status = $request->status;
        }
        $product->reviews()->save($review);
        
        return $review;
    }

    public static function createUpdateRecipeReview($recipe, $review, $request)
    {

        if (isset($request->name)) {
            $review->name = $request->name;
        } else {
            $review->name = Auth::user()->name;
        }
        if (isset($request->content)) {
            $review->content = $request->content;
        }
        if (isset($request->rate)) {
            $review->rate = $request->rate;
        }
        if (isset($request->like)) {
            $review->like = $request->like;
        }
        if (isset($request->dislike)) {
            $review->dislike = $request->dislike;
        }
        if (isset($request->status)) {
            $review->status = $request->status;
        }
        $recipe->reviews()->save($review);
        
        return $review;
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



    /**
     * Get the parent imageable model (user or post).
     */
    public function reviewtable()
    {
        return $this->morphTo();
    }
    public function product()
    {
        return $this->belongsTo(Product::class, 'reviewtable_id','id')->where('reviewtable_type', Product::class);
    }
    public function recipe()
    {
        return $this->belongsTo(Recipe::class, 'reviewtable_id','id')->where('reviewtable_type', Recipe::class);
    }
}
