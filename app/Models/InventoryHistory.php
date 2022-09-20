<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class InventoryHistory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "inventory_histories";

    protected $sortParameterName = 'sort';

    public $sortable = ['created_at'];

    protected $searchable = ['search_txt'];

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

        self::creating(function ($inventoryHistory) {
            if (Auth::check()) {
                $inventoryHistory->created_by = Auth::user()->id;
            }
        });

        self::created(function ($inventoryHistory) {
            // ... code here     
        });

        self::updating(function ($inventoryHistory) {
            if (Auth::check()) {
                $inventoryHistory->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($inventoryHistory) {
            // ... code here
        });

        self::deleting(function ($inventoryHistory) {
            $inventoryHistory->deleted_by = Auth::user()->id;
            $inventoryHistory->save();
        });

        self::deleted(function ($inventoryHistory) {
        });
    }

    public static function createUpdate($inventory,$inventoryHistory, $request)
    {

        $inventoryHistory->inventory_id = $inventory->id;

        if (isset($request->order_id)) {
            $inventoryHistory->order_id = null;
            if (!is_null($request->order_id)) {
                $inventoryHistory->order_id = $request->order_id;
            }
        }

        if (isset($request->stock)) {
            $inventoryHistory->stock = $request->stock;
        }

        $inventoryHistory->save();

        return $inventoryHistory;
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
    public function inventory()
    {
        return $this->belongsTo(Inventory::class, 'inventory_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
