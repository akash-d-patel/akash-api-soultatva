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

class SubProduct extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "sub_products";

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
            ->orWhereHas('product', function($query) use ($constraint) {
                $query->where('name', "LIKE", "%" . $constraint->getValue() . "%");
            })
            ->orWhereHas('attribute', function($query) use ($constraint) {
                $query->where('name', "LIKE", "%" . $constraint->getValue() . "%");
            })
            ->orWhereHas('attribute_value', function($query) use ($constraint) {
                $query->where('value', "LIKE", "%" . $constraint->getValue() . "%");
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

        self::creating(function ($subProduct) {
            if (Auth::check()) {
                $subProduct->created_by = Auth::user()->id;
            }
        });

        self::created(function ($subProduct) {
            // ... code here     
        });

        self::updating(function ($subProduct) {
            if (Auth::check()) {
                $subProduct->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($subProduct) {
            // ... code here
        });

        self::deleting(function ($subProduct) {
            $subProduct->deleted_by = Auth::user()->id;
            $subProduct->save();
        });

        self::deleted(function ($subProduct) {
        });
    }

    public static function createUpdate($product, $subProduct, $request)
    {
        if (isset($request->client_id)) {
            $subProduct->client_id = $request->client_id;
        } else {
            $subProduct->client_id = Auth::user()->client->id;
        }

        if (isset($request->attribute_id)) {
            $subProduct->attribute_id = null;
            if (!is_null($request->attribute_id)) {
                $subProduct->attribute_id = $request->attribute_id;
            }
        }

        if (isset($request->attribute_value_id)) {
            $subProduct->attribute_value_id = null;
            if (!is_null($request->attribute_value_id)) {
                $subProduct->attribute_value_id = $request->attribute_value_id;
            }
        }

        if (isset($request->sku_code)) {
            $subProduct->sku_code = $request->sku_code;
        }

        if (isset($request->asin_code)) {
            $subProduct->asin_code = $request->asin_code;
        }

        if (isset($request->gtin_code)) {
            $subProduct->gtin_code = $request->gtin_code;
        }

        if (isset($request->hsn_code)) {
            $subProduct->hsn_code = $request->hsn_code;
        }

        if (isset($request->gst)) {
            $subProduct->gst = $request->gst;
        }

        if (isset($request->price)) {
            $subProduct->price = $request->price;
        }

        if (isset($request->mrp)) {
            $subProduct->mrp = $request->mrp;
        }

        if (isset($request->status)) {
            $subProduct->status = $request->status;
        }

        $product->sub_product()->save($subProduct);

        $inventory = Inventory::where('sub_product_id',$subProduct->id)->first();

        if(!$inventory){
        
            $inventory = new Inventory();
        }
       
        if (isset($request->client_id)) {
            $inventory->client_id = $request->client_id;
        } else {
            $inventory->client_id = Auth::user()->client->id;
        }

        $inventory->sub_product_id = $subProduct->id;

        if (isset($request->inventory['min_stock'])) {
            $inventory->min_stock = $request->inventory['min_stock'];
        }

        if (isset($request->inventory['max_stock'])) {
            $inventory->max_stock = $request->inventory['max_stock'];
        }

        if (isset($request->inventory['stock'])) {
            $inventory->stock = $request->inventory['stock'];
        }
        
        $inventory->save();

        return $subProduct;
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
     * Get all the multiple image
     */

    public function images()
    {
        return $this->morphMany(Image::class, 'imagetable');
    }

    /**
     * Get the post that owns the comment.
     */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id');
    }

    public function attribute_value()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id');
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

    public function inventory()
    {
        return $this->hasOne(Inventory::class,'sub_product_id');
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metatable');
    }

    public function schema()
    {
        return $this->morphOne(Schema::class, 'schematable');
    }
    
    public function subProductWebsites()
    {
        return $this->hasMany(SubProductWebsite::class, 'sub_product_id');
    }
}
