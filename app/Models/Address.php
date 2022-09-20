<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Address extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    public $timestamps = false;

    protected $table = "addresses";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'mobile_no', 'pin_code', 'address_line1', 'status'];

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
                      ->orWhere('mobile_no', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('pin_code', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('address_line1', "LIKE", "%" . $constraint->getValue() . "%");
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($address) {
            if (Auth::check()) {
                $address->created_by = Auth::user()->id;
            }
        });

        self::created(function ($address) {
            // ... code here     
        });

        self::updating(function ($address) {
            if (Auth::check()) {
                $address->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($address) {
            // ... code here
        });

        self::deleting(function ($address) {
            $address->deleted_by = Auth::user()->id;
            $address->save();
        });

        self::deleted(function ($address) {
        });
    }

    public static function createUpdate($address, $request)
    {
        if (isset($request->client_id)) {
            $address->client_id = $request->client_id;
        } else {
            $address->client_id = Auth::user()->client->id;
        }

        if (isset($request->name)) {
            $address->name = $request->name;
        }

        if (isset($request->mobile_no)) {
            $address->mobile_no = $request->mobile_no;
        }

        if (isset($request->address_line1)) {
            $address->address_line1 = $request->address_line1;
        }

        if (isset($request->address_line2)) {
            $address->address_line2 = $request->address_line2;
        }

        if (isset($request->landmark)) {
            $address->landmark = $request->landmark;
        }


        if (isset($request->country_id)) {
            $address->country_id = null;
            if (!is_null($request->country_id)) {
                $address->country_id = $request->country_id;
            }
        }

        if (isset($request->state_id)) {
            $address->state_id = null;
            if (!is_null($request->state_id)) {
                $address->state_id = $request->state_id;
            }
        }

        if (isset($request->city_id)) {
            $address->city_id = null;
            if (!is_null($request->city_id)) {
                $address->city_id = $request->city_id;
            }
        }

        if (isset($request->pin_code)) {
            $address->pin_code = $request->pin_code;
        }
        if (isset($request->type)) {
            $address->type = $request->type;
        }
        if (isset($request->status)) {
            $address->status = $request->status;
        }

        // $user->addresses()->save($address);

        $address->save();


        return $address;
    }

    public static function createUpdateUserAddress($user, $address, $request)
    {

        if (isset($request->client_id)) {
            $address->client_id = $request->client_id;
        } else {
            $address->client_id = Auth::user()->client->id;
        }

        if (isset($request->name)) {
            $address->name = $request->name;
        }

        if (isset($request->mobile_no)) {
            $address->mobile_no = $request->mobile_no;
        }

        if (isset($request->address_line1)) {
            $address->address_line1 = $request->address_line1;
        }

        if (isset($request->address_line2)) {
            $address->address_line2 = $request->address_line2;
        }

        if (isset($request->landmark)) {
            $address->landmark = $request->landmark;
        }


        if (isset($request->country_id)) {
            $address->country_id = null;
            if (!is_null($request->country_id)) {
                $address->country_id = $request->country_id;
            }
        }

        if (isset($request->state_id)) {
            $address->state_id = null;
            if (!is_null($request->state_id)) {
                $address->state_id = $request->state_id;
            }
        }

        if (isset($request->city_id)) {
            $address->city_id = null;
            if (!is_null($request->city_id)) {
                $address->city_id = $request->city_id;
            }
        }

        if (isset($request->pin_code)) {
            $address->pin_code = $request->pin_code;
        }
        if (isset($request->type)) {
            $address->type = $request->type;
        }
        if (isset($request->status)) {
            $address->status = $request->status;
        }

        $user->addresses()->save($address);

        return $address;
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

    public function addresstable()
    {
        return $this->morphTo();
    }
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'addresstable_id', 'id')->where('addresstable_type', 'App\Models\User');
    }
}
