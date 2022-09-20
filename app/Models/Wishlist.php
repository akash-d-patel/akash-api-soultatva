<?php

namespace App\Models;

use App\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;

class Wishlist extends Model
{
    use HasFactory;
    use PimpableTrait;

    protected $table = "wishlists";

    protected $sortParameterName = 'sort';

    public $sortable = ['product_id', 'sub_product_id', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'status'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('product_id', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('sub_product_id', "LIKE", "%" . $constraint->getValue() . "%");
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
    }

    public static function createUpdate($wishlist, $request)
    {
        if (isset($request->client_id)) {
            $wishlist->client_id = $request->client_id;
        } else {
            $wishlist->client_id = Auth::user()->client->id;
        }

        if (isset($request->user_id)) {
            $wishlist->user_id = $request->user_id;
        } else {
            $wishlist->user_id = Auth::user()->id;
        }

        if (isset($request->product_id)) {
            $wishlist->product_id = null;
            if (!is_null($request->product_id)) {
                $wishlist->product_id = $request->product_id;
            }
        }

        if (isset($request->sub_product_id)) {
            $wishlist->sub_product_id = null;
            if (!is_null($request->sub_product_id)) {
                $wishlist->sub_product_id = $request->sub_product_id;
            }
        }
        
        $wishlist->save();

        return $wishlist;
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
     * Get all of the clients's name.
     */
    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }
}
