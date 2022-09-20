<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;

class RelatedProduct extends Model
{
    use HasFactory;
    use PimpableTrait;
    use SoftDeletes;

    protected $table = 'related_products';

    protected $sortParameterName = 'sort';

    public $sortable = ['id', 'product_id'];

    protected $searchable = ['search_txt', 'product_id'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('product_id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($relatedProduct) {
            if(Auth::check()){

            $relatedProduct->created_by = Auth::user()->id;
            
            }
           
        });

        self::created(function ($relatedProduct) {
            // ... code here
        });

        self::updating(function ($relatedProduct) {
            $relatedProduct->updated_by = Auth::user()->id;
        });

        self::updated(function ($relatedProduct) {
            // ... code here
        });

        self::deleting(function ($relatedProduct) {
            $relatedProduct->deleted_by = Auth::user()->id;
            $relatedProduct->save();
        });

        self::deleted(function ($relatedProduct) {
        });
    }

    public static function createUpdate($product, $relatedProduct, $request)
    {

        if (isset($request->product_id)) {
            $relatedProduct->product_id = $request->product_id;
        }

        $product->relatedProducts()->save($relatedProduct);

        return $relatedProduct;
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


    public function relatedproductable()
    {
        return $this->morphTo();
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'relatedproductable_id','id')->where('relatedproductable_type', Product::class);
    }

    public function products()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
       
}
