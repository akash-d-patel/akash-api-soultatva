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

class OrderItem extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "order_items";

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
                $query->where('name', $constraint->getOperator(), $constraint->getValue());
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

        self::creating(function ($orderItem) {
            if (Auth::check()) {
                $orderItem->created_by = Auth::user()->id;
            }
        });

        self::created(function ($orderItem) {
            // ... code here     
        });

        self::updating(function ($orderItem) {
            if (Auth::check()) {
                $orderItem->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($orderItem) {
            // ... code here
        });

        self::deleting(function ($orderItem) {
            $orderItem->deleted_by = Auth::user()->id;
            $orderItem->save();
        });

        self::deleted(function ($orderItem) {
        });
    }

    public static function createUpdate($orderItem, $request)
    {
        if (isset($request->client_id)) {
            $orderItem->client_id = $request->client_id;
        } else {
            $orderItem->client_id = Auth::user()->client->id;
        }

        if (isset($request->user_id)) {
            $orderItem->user_id = null;
            if (!is_null($request->user_id)) {
                $orderItem->user_id = $request->user_id;
            }
        }

        if (isset($request->order_id)) {
            $orderItem->order_id = null;
            if (!is_null($request->order_id)) {
                $orderItem->order_id = $request->order_id;
            }
        }

        if (isset($request->product_id)) {
            $orderItem->product_id = null;
            if (!is_null($request->product_id)) {
                $orderItem->product_id = $request->product_id;
            }
        }

        if (isset($request->sub_product_id)) {
            $orderItem->sub_product_id = null;
            if (!is_null($request->sub_product_id)) {
                $orderItem->sub_product_id = $request->sub_product_id;
            }
        }

        if (isset($request->quantity)) {
            $orderItem->quantity = $request->quantity;
        }

        if (isset($request->amount)) {
            $orderItem->amount = $request->amount;
        }

        if (isset($request->status)) {
            $orderItem->status = $request->status;
        }

        $orderItem->save();


        return $orderItem;
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
     * Get the post that owns the comment.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function sub_product()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
