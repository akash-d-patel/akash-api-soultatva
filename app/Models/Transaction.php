<?php

namespace App\Models;

use App\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;

class Transaction extends Model
{
    use HasFactory;
    use PimpableTrait;

    protected $table = "transactions";

    protected $sortParameterName = 'sort';

    public $sortable = ['status', 'created_at'];

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
                $query->where('status', "LIKE", "%" . $constraint->getValue() . "%");
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function createUpdate($transaction, $request)
    {
        if (isset($request->client_id)) {
            $transaction->client_id = $request->client_id;
        } $url = URL('/');
        $client_id = Client::where('name', $url)->value('id');
        $transaction->client_id = $client_id;

        if (isset($request->order_id)) {
            $transaction->order_id = $request->order_id;
        }
        
        $order = Order::find($request->order_id); 
        $orderUser = $order->user_id;
        $user = User::find($orderUser);
        $transactionUserId = $user->id;
        $transactionUserName = $user->name;
        $transactionUserEmail = $user->email;
        $transactionUserPhone = $user->mobile_no;

        if (isset($request->user_id)) {
            $transaction->user_id = $request->user_id;
        } else {
            $transaction->user_id = $transactionUserId;
        }

        if (isset($request->total)) {
            $transaction->total = $request->total;
        }

        if (isset($request->first_name)) {
            $transaction->first_name = $request->first_name;
        } else {
            $transaction->first_name = $transactionUserName;
        }

        if (isset($request->last_name)) {
            $transaction->last_name = $request->last_name;
        }

        if (isset($request->email)) {
            $transaction->email = $request->email;
        } else {
            $transaction->email = $transactionUserEmail;
        }

        if (isset($request->phone)) {
            $transaction->phone = $request->phone;
        } else {
            $transaction->phone = $transactionUserPhone;
        }

        if (isset($request->product_info)) {
            $transaction->product_info = $request->product_info;
        } else {
            $transaction->product_info = $transaction->order_id;
        }

        if (isset($request->service_provider)) {
            $transaction->service_provider = $request->service_provider;
        }

        $order = Order::find($request->order_id);
        $orderAddress = $order->billing_address_id;
        $address = Address::find($orderAddress);
        $transactionZipcode = $address->pin_code;
        $transactionCity = $address->city_id;
        $transactionState = $address->state_id;
        $transactionCountry = $address->country_id;
        $transactionAddress1 = $address->address_line1;
        $transactionAddress2 = $address->address_line2;
        
        if (isset($request->zipcode)) {
            $transaction->zipcode = $request->zipcode;
        } else {
            $transaction->zipcode = $transactionZipcode;
        }   

        if (isset($request->city)) {
            $transaction->city = $request->city;
        } else {
            $transaction->city = $transactionCity;
        }

        if (isset($request->state)) {
            $transaction->state = $request->state;
        } else {
            $transaction->state = $transactionState;
        }

        if (isset($request->country)) {
            $transaction->country = $request->country;
        } else {
            $transaction->country = $transactionCountry;
        }

        if (isset($request->address1)) {
            $transaction->address1 = $request->address1;
        } else {
            $transaction->address1 = $transactionAddress1;
        }

        if (isset($request->address2)) {
            $transaction->address2 = $request->address2;
        } else {
            $transaction->address2 = $transactionAddress2;
        }

        if (isset($request->status)) {
            $transaction->status = $request->status;
        }
        
        $transaction->save();

        return $transaction;
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
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
