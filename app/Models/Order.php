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

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "orders";

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
            })
            ->orWhereHas('user', function ($query) use ($constraint) {
                $query->where('name', "LIKE", "%" . $constraint->getValue() . "%");
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

        self::creating(function ($order) {
            if (Auth::check()) {

                $order->created_by = Auth::user()->id;
                $order->order_no = self::count() + 1;
            }
        });

        self::created(function ($order) {
            // ... code here     
        });

        self::updating(function ($order) {
            if (Auth::check()) {
                $order->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($order) {
            // ... code here
        });

        self::deleting(function ($order) {
            $order->deleted_by = Auth::user()->id;
            $order->save();
        });

        self::deleted(function ($order) {
        });
    }


    public static function createUpdate($order, $request)
    {
        if (isset($request->client_id)) {
            $order->client_id = $request->client_id;
        } else {
            $order->client_id = Auth::user()->client->id;
        }

        if (isset($request->user_id)) {
            $order->user_id = $request->user_id;
        } else {
            $order->user_id = Auth::user()->id;
        }

        if (isset($request->order_no)) {
            $order->order_no = $request->order_no;
        }

        if (isset($request->shipping_address_id)) {
            $order->shipping_address_id = null;
            if (!is_null($request->shipping_address_id)) {
                $order->shipping_address_id = $request->shipping_address_id;
            }
        }

        if (isset($request->billing_address_id)) {
            $order->billing_address_id = null;
            if (!is_null($request->billing_address_id)) {
                $order->billing_address_id = $request->billing_address_id;
            }
        }

        if (isset($request->currency_id)) {
            $order->currency_id = null;
            if (!is_null($request->currency_id)) {
                $order->currency_id = $request->currency_id;
            }
        }

        if (isset($request->payment_mode)) {
            $order->payment_mode = $request->payment_mode;
        }

        if (isset($request->status)) {
            $order->status = $request->status;
        }

        $order->save();

        if(isset($request->order_item)) {

            foreach ($request->order_item as $value) {

                if(isset($value['id']) && $value['id']>0){
                    $orderItem = OrderItem::find($value['id']);
                }else{
                    $orderItem = new OrderItem();
                }
                
                $orderItem->order_id = $order->id;
                
                if (isset($request->client_id)) {
                    $orderItem->client_id = $request->client_id;
                } else {
                    $orderItem->client_id = Auth::user()->client->id;
                }
        
                if (isset($request->user_id)) {
                    $orderItem->user_id = $request->user_id;
                } else {
                    $orderItem->user_id = Auth::user()->id;
                }
        
                if (isset($value['product_id'])) {
                    $orderItem->product_id = null;
                    if (!is_null($value['product_id'])) {
                        $orderItem->product_id = $value['product_id'];
                    }
                }

                if (isset($value['sub_product_id'])) {
                    $orderItem->sub_product_id = null;
                    if (!is_null($value['sub_product_id'])) {
                        $orderItem->sub_product_id = $value['sub_product_id'];
                    }
                }
        
                if (isset($value['quantity'])) {
                    $orderItem->quantity = $value['quantity'];
                }
        
                if (isset($value['amount'])) {
                    $orderItem->amount = $value['amount'];
                }
        
                if (isset($value['status'])) {
                    $orderItem->status = $value['status'];
                }
                
                $orderItem->save();

                $inventory = Inventory::where('sub_product_id',$value['sub_product_id'])->first();

                $inventory->sub_product_id = $orderItem->sub_product_id;

                $result = InventoryHistory::where('inventory_id', $inventory->id)->where( 'order_id', $order->id)->first();

                if($result){
                    
                    $quantity = $result->stock - $orderItem->quantity;
                } else {

                    $quantity = 0 - $orderItem->quantity;
                }
                   
                $inventory->stock = $inventory->stock + $quantity;
                
                $inventory->save();

                if($result) {
                    $inventory_history = InventoryHistory::find($result->id);
                } else {
                    $inventory_history = new InventoryHistory();
                }

                $inventory_history->inventory_id = $inventory->id;

                $inventory_history->order_id = $order->id;

                $inventory_history->stock = $orderItem->quantity;
                
                $inventory_history->save();

            }  
        }

        return $order;
    }

    public static function frontOrderCreateUpdate($order, $request)
    {
        if (isset($request->client_id)) {
            $order->client_id = $request->client_id;
        } else {
            $order->client_id = Auth::user()->client->id;
        }

        if (isset($request->user_id)) {
            $order->user_id = $request->user_id;
        } else {
            $order->user_id = Auth::user()->id;
        }

        if (isset($request->order_no)) {
            $order->order_no = $request->order_no;
        }

        if (isset($request->shipping_address_id)) {
            $order->shipping_address_id = null;
            if (!is_null($request->shipping_address_id)) {
                $order->shipping_address_id = $request->shipping_address_id;
            }
        }

        if (isset($request->billing_address_id)) {
            $order->billing_address_id = null;
            if (!is_null($request->billing_address_id)) {
                $order->billing_address_id = $request->billing_address_id;
            }
        }

        if (isset($request->currency_id)) {
            $order->currency_id = null;
            if (!is_null($request->currency_id)) {
                $order->currency_id = $request->currency_id;
            }
        }

        if (isset($request->payment_mode)) {
            $order->payment_mode = $request->payment_mode;
        }

        if (isset($request->status)) {
            $order->status = $request->status;
        }

        $order->save();

        if(isset($request->order_item)) {

            foreach ($request->order_item as $value) {

                $query = OrderItem::where('user_id', Auth::user()->id)
                                    ->where('product_id', $value['product_id'])
                                    ->where('sub_product_id', $value['sub_product_id'])->first();
  
                if($query){
                    $orderItem = OrderItem::find($query->id);
                }else{
                    $orderItem = new OrderItem();
                }
                
                $orderItem->order_id = $order->id;
                
                if (isset($request->client_id)) {
                    $orderItem->client_id = $request->client_id;
                } else {
                    $orderItem->client_id = Auth::user()->client->id;
                }
        
                if (isset($request->user_id)) {
                    $orderItem->user_id = $request->user_id;
                } else {
                    $orderItem->user_id = Auth::user()->id;
                }
        
                if (isset($value['product_id'])) {
                    $orderItem->product_id = null;
                    if (!is_null($value['product_id'])) {
                        $orderItem->product_id = $value['product_id'];
                    }
                }

                if (isset($value['sub_product_id'])) {
                    $orderItem->sub_product_id = null;
                    if (!is_null($value['sub_product_id'])) {
                        $orderItem->sub_product_id = $value['sub_product_id'];
                    }
                }
        
                if (isset($value['quantity'])) {
                    $orderItem->quantity = $value['quantity'];
                }
        
                if (isset($value['amount'])) {
                    $orderItem->amount = $value['amount'];
                }
        
                if (isset($value['status'])) {
                    $orderItem->status = $value['status'];
                }
                
                $orderItem->save();

                $inventory = Inventory::where('sub_product_id',$value['sub_product_id'])->first();

                $inventory->sub_product_id = $orderItem->sub_product_id;

                $result = InventoryHistory::where('inventory_id', $inventory->id)->where( 'order_id', $order->id)->first();

                if($result){
                    
                    $quantity = $result->stock - $orderItem->quantity;
                } else {

                    $quantity = 0 - $orderItem->quantity;
                }
                   
                $inventory->stock = $inventory->stock + $quantity;
                
                $inventory->save();

                if($result) {
                    $inventory_history = InventoryHistory::find($result->id);
                } else {
                    $inventory_history = new InventoryHistory();
                }

                $inventory_history->inventory_id = $inventory->id;

                $inventory_history->order_id = $order->id;

                $inventory_history->stock = $orderItem->quantity;
                
                $inventory_history->save();

            }  
        }

        return $order;
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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency_id');
    }

    public function order_item()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
    
    /** Get the ID of Address table*/
    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }
}
