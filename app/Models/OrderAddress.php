<?php

namespace App\Models;

use App\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class OrderAddress extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "order_addresses";

    protected $sortParameterName = 'sort';

    public $sortable = ['created_at'];

    protected $searchable = ['search_txt', 'zip_code'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('zip_code', $constraint->getOperator(), $constraint->getValue());
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

        self::creating(function ($orderAddress) {
            if (Auth::check()) {
                $orderAddress->created_by = Auth::user()->id;
            }
        });

        self::created(function ($orderAddress) {
            // ... code here     
        });

        self::updating(function ($orderAddress) {
            if (Auth::check()) {
                $orderAddress->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($orderAddress) {
            // ... code here
        });

        self::deleting(function ($orderAddress) {
            $orderAddress->deleted_by = Auth::user()->id;
            $orderAddress->save();
        });

        self::deleted(function ($orderAddress) {
        });
    }

    public static function createUpdate($orderAddress, $request)
    {
        if (isset($request->client_id)) {
            $orderAddress->client_id = $request->client_id;
        } else {
            $orderAddress->client_id = Auth::user()->client->id;
        }

        if (isset($request->user_id)) {
            $orderAddress->user_id = null;
            if (!is_null($request->user_id)) {
                $orderAddress->user_id = $request->user_id;
            }
        }

        if (isset($request->order_id)) {
            $orderAddress->order_id = null;
            if (!is_null($request->order_id)) {
                $orderAddress->order_id = $request->order_id;
            }
        }

        if (isset($request->country_id)) {
            $orderAddress->country_id = null;
            if (!is_null($request->country_id)) {
                $orderAddress->country_id = $request->country_id;
            }
        }

        if (isset($request->state_id)) {
            $orderAddress->state_id = null;
            if (!is_null($request->state_id)) {
                $orderAddress->state_id = $request->state_id;
            }
        }

        if (isset($request->city_id)) {
            $orderAddress->city_id = null;
            if (!is_null($request->city_id)) {
                $orderAddress->city_id = $request->city_id;
            }
        }

        if (isset($request->address1)) {
            $orderAddress->address1 = $request->address1;
        }

        if (isset($request->address2)) {
            $orderAddress->address2 = $request->address2;
        }

        if (isset($request->zip_code)) {
            $orderAddress->zip_code = $request->zip_code;
        }

        if (isset($request->status)) {
            $orderAddress->status = $request->status;
        }

        $orderAddress->save();

        return $orderAddress;
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

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
