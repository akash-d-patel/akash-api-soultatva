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

class PromoCode extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "promo_codes";

    protected $fillable = ['client_id', 'title', 'code', 'description', 'no_of_usage', 'usage_per_user', 'minimum_value', 'category_products', 'value'];

    protected $sortParameterName = 'sort';

    public $sortable = ['title', 'no_of_usage', 'usage_per_user', 'minimum_value', 'created_at'];

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

    public static function boot()
    {
        parent::boot();

        /* client globalscope */
        static::addGlobalScope(new ClientScope);

        self::creating(function ($promoCode) {

            if (Auth::check()) {
                $promoCode->created_by = Auth::user()->id;
            }
        });

        self::created(function ($promoCode) {
            // ... code here
        });

        self::updating(function ($promoCode) {
            $promoCode->updated_by = Auth::user()->id;
        });

        self::updated(function ($promoCode) {
            // ... code here
        });

        self::deleting(function ($promoCode) {
            $promoCode->deleted_by = Auth::user()->id;
            $promoCode->save();
        });

        self::deleted(function ($promoCode) {
        });
    }

    public static function addUpdatedPromoCodes($promoCode, $request)
    {
        if (isset($request->client_id)) {
            $promoCode->client_id = $request->client_id;
        } else {
            $promoCode->client_id = Auth::user()->client->id;
        }

        if (isset($request->title)) {
            $promoCode->title = $request->title;
        }

        if (isset($request->code)) {
            $promoCode->code = $request->code;
        }

        if (isset($request->description)) {
            $promoCode->description = $request->description;
        }

        if (isset($request->start_date)) {
            $promoCode->start_date = $request->start_date;
        }

        if (isset($request->end_date)) {
            $promoCode->end_date = $request->end_date;
        }

        if (isset($request->no_of_usage)) {
            $promoCode->no_of_usage = $request->no_of_usage;
        }

        if (isset($request->usage_per_user)) {
            $promoCode->usage_per_user = $request->usage_per_user;
        }

        if (isset($request->minimum_value)) {
            $promoCode->minimum_value = $request->minimum_value;
        }

        if (isset($request->category_products)) {
            $promoCode->category_products = $request->category_products;
        }

        if (isset($request->type)) {
            $promoCode->type = $request->type;
        }

        if (isset($request->value)) {
            $promoCode->value = $request->value;
        }

        $promoCode->save();

        return $promoCode;
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
}
