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

class Inventory extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "inventories";

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
                //$query->where('name', $constraint->getOperator(), $constraint->getValue());
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

        self::creating(function ($inventory) {
            if (Auth::check()) {
                $inventory->created_by = Auth::user()->id;
            }
        });

        self::created(function ($inventory) {
            // ... code here     
        });

        self::updating(function ($inventory) {
            if (Auth::check()) {
                $inventory->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($inventory) {
            // ... code here
        });

        self::deleting(function ($inventory) {
            $inventory->deleted_by = Auth::user()->id;
            $inventory->save();
        });

        self::deleted(function ($inventory) {
        });
    }

    public static function createUpdate($inventory, $request)
    {
        if (isset($request->client_id)) {
            $inventory->client_id = $request->client_id;
        } else {
            $inventory->client_id = Auth::user()->client->id;
        }

        if (isset($request->sub_product_id)) {
            $inventory->sub_product_id = null;
            if (!is_null($request->sub_product_id)) {
                $inventory->sub_product_id = $request->sub_product_id;
            }
        }

        if (isset($request->min_stock)) {
            $inventory->min_stock = $request->min_stock;
        }

        if (isset($request->max_stock)) {
            $inventory->max_stock = $request->max_stock;
        }

        if (isset($request->stock)) {
            $inventory->stock = $request->stock;
        }

        $inventory->save();

        return $inventory;
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
    public function sub_product()
    {
        return $this->belongsTo(SubProduct::class,'id', 'sub_product_id');
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function inventory_history()
    {
        return $this->hasMany(InventoryHistory::class, 'inventory_id');
    }

}
