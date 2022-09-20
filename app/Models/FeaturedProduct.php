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

class FeaturedProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "featured_products";

    protected $sortParameterName = 'sort';

    public $sortable = ['status', 'created_at'];

    protected $searchable = ['search_txt', 'product_id', 'status'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('product_id', "LIKE", "%" . $constraint->getValue() . "%");
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

        self::creating(function ($featuredProduct) {

            if (Auth::check()) {

                $featuredProduct->created_by = Auth::user()->id;
            }
        });

        self::created(function ($featuredProduct) {
            // ... code here
        });

        self::updating(function ($featuredProduct) {
            $featuredProduct->updated_by = Auth::user()->id;
        });

        self::updated(function ($featuredProduct) {
            // ... code here
        });

        self::deleting(function ($featuredProduct) {
            $featuredProduct->deleted_by = Auth::user()->id;
            $featuredProduct->save();
        });

        self::deleted(function ($featuredProduct) {
        });
    }

    public static function createUpdate($featuredProduct, $request)
    {
        if (isset($request->client_id)) {
            $featuredProduct->client_id = $request->client_id;
        } else {
            $featuredProduct->client_id = Auth::user()->client->id;
        }

        if (isset($request->product_id)) {
            $featuredProduct->product_id = $request->product_id;
        }

        if (isset($request->status)) {
            $featuredProduct->status = $request->status;
        }

        $featuredProduct->save();

        return $featuredProduct;
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

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
