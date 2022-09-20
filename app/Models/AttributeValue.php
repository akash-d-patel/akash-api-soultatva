<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;


class AttributeValue extends Model
{
    use HasFactory;
    use PimpableTrait;
    public $timestamps = false;
   
    protected $sortParameterName = 'sort';

    public $sortable = [ 'value'];

    protected $searchable = ['search_txt', 'value'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('value', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }
    /**
     * Get the post that owns the comment.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class,'attribute_id');
    }


    public static function createUpdate($attribute, $attributevalue,$request) {
         
        $attributevalue->attribute_id = $attribute->id;

        if(isset($request->value)) {
            $attributevalue->value = $request->value;
        }
        
        $attributevalue->save();
        return $attributevalue;
    }
}

