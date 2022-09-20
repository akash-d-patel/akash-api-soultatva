<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;

class Description extends Model
{
    use HasFactory;
    use PimpableTrait;

    protected $table = 'descriptions';

    protected $sortParameterName = 'sort';

    public $sortable = ['title', 'created_at'];

    protected $searchable = ['search_txt', 'title'];


    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('title', $constraint->getOperator(), $constraint->getValue());
                
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    /* brand description create update method */

    public static function createUpdateBrand($brand, $description,$request) {
         
        if(isset($request->title)) {
            $description->title = $request->title;
        }

        if(isset($request->content)) {
            $description->content = $request->content;
        }

        $brand->descriptions()->save($description);
        return $description;
       
    }

    /* category description create update method */

    public static function createUpdateCategory($category, $description,$request) {
         
        if(isset($request->title)) {
            $description->title = $request->title;
        }

        if(isset($request->content)) {
            $description->content = $request->content;
        }

        $category->descriptions()->save($description);
        return $description;
       
    }

    /* product description create update method */

    public static function createUpdateProduct($product, $description,$request) {
         
        if(isset($request->title)) {
            $description->title = $request->title;
        }

        if(isset($request->content)) {
            $description->content = $request->content;
        }

        $product->descriptions()->save($description);
        return $description;
       
    }

    /* morphto relation */

    public function descriptiontable()
    {
        return $this->morphTo();
    }

    /* get the description Id and Brand model path*/
    
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'descriptiontable_id','id')->where('descriptiontable_type', Brand::class);
    }

   /* get the description Id and Category model path*/
    
    public function category()
    {
        return $this->belongsTo(Category::class, 'descriptiontable_id','id')->where('descriptiontable_type', Category::class);
    }

    /* get the description Id and Product model path*/
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'descriptiontable_id','id')->where('descriptiontable_type', Product::class);
    }
}
