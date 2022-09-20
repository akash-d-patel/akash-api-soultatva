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

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    
    protected $table = "products";

    protected $fillable = ['brand_id', 'name', 'short_description', 'country_id'];

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'food_type', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'status'];


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
                      ->orWhere('food_type', "LIKE", "%" . $constraint->getValue() . "%");
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public static function boot()
    {
        parent::boot();

        /* client globalscope */
        static::addGlobalScope(new ClientScope);

        self::creating(function ($product) {
            if (Auth::check()) {

                $product->created_by = Auth::user()->id;
            }
        });

        self::created(function ($product) {
            // ... code here
        });

        self::updating(function ($product) {
            $product->updated_by = Auth::user()->id;
        });

        self::updated(function ($product) {
            // ... code here
        });

        self::deleting(function ($product) {
            $product->deleted_by = Auth::user()->id;
            $product->save();
        });

        self::deleted(function ($product) {
        });
    }

    /* product create and update method */

    public static function createUpdate($product, $request)
    {

        if (isset($request->client_id)) {
            $product->client_id = $request->client_id;
        } else {
            $product->client_id = Auth::user()->client->id;
        }

        if (isset($request->brand_id)) {
            $product->brand_id = null;
            if (!is_null($request->brand_id)) {
                $product->brand_id = $request->brand_id;
            }
        }

        if (isset($request->name)) {
            $product->name = $request->name;
        }

        if (isset($request->slug)) {
            $product->slug = $request->slug;
        }

        if (isset($request->short_description)) {
            $product->short_description = $request->short_description;
        }

        if (isset($request->country_id)) {
            $product->country_id = null;
            if (!is_null($request->country_id)) {
                $product->country_id = $request->country_id;
            }
        }

        if (isset($request->food_type)) {
            $product->food_type = $request->food_type;
        }

        if (isset($request->link_type)) {
            $product->link_type = $request->link_type;
        }

        if (isset($request->link_open_with)) {
            $product->link_open_with = $request->link_open_with;
        }

        if (isset($request->upper_top)) {
            $product->upper_top = $request->upper_top;
        }

        if (isset($request->top)) {
            $product->top = $request->top;
        }

        if (isset($request->bottom)) {
            $product->bottom = $request->bottom;
        }

        if (isset($request->left)) {
            $product->left = $request->left;
        }

        if (isset($request->right)) {
            $product->right = $request->right;
        }

        if (isset($request->status)) {
            $product->status = $request->status;
        }

        $product->save();

        if(isset($request->sub_product)) {

            foreach ($request->sub_product as $value) {

                if(isset($value['id']) && $value['id']>0){
                    $subProduct=SubProduct::find($value['id']);
                }else{
                    $subProduct=new SubProduct();
                }
                
                $subProduct->product_id=$product->id;
                
                if (isset($request->client_id)) {
                    $subProduct->client_id = $request->client_id;
                } else {
                    $subProduct->client_id = Auth::user()->client->id;
                }
        
                if (isset($value['attribute_id'])) {
                    $subProduct->attribute_id = null;
                    if (!is_null($value['attribute_id'])) {
                        $subProduct->attribute_id = $value['attribute_id'];
                    }
                }
        
                if (isset($value['attribute_value_id'])) {
                    $subProduct->attribute_value_id = null;
                    if (!is_null($value['attribute_value_id'])) {
                        $subProduct->attribute_value_id = $value['attribute_value_id'];
                    }
                }
        
                if (isset($value['sku_code'])) {
                    $subProduct->sku_code = $value['sku_code'];
                }
        
                if (isset($value['asin_code'])) {
                    $subProduct->asin_code = $value['asin_code'];
                }
        
                if (isset($value['gtin_code'])) {
                    $subProduct->gtin_code = $value['gtin_code'];
                }

                if (isset($value['hsn_code'])) {
                    $subProduct->hsn_code = $value['hsn_code'];
                }

                if (isset($value['gst'])) {
                    $subProduct->gst = $value['gst'];
                }
        
                if (isset($value['price'])) {
                    $subProduct->price = $value['price'];
                }
        
                if (isset($value['mrp'])) {
                    $subProduct->mrp = $value['mrp'];
                }
        
                if (isset($value['status'])) {
                    $subProduct->status = $value['status'];
                }

                $subProduct->save();

                if(isset($value['inventory']['id']) && $value['inventory']['id']>0){
                    $inventory = Inventory::find($value['inventory']['id']);
                }else{
                    $inventory = new Inventory();
                }
                
                if (isset($request->client_id)) {
                    $inventory->client_id = $request->client_id;
                } else {
                    $inventory->client_id = Auth::user()->client->id;
                }
        
                $inventory->sub_product_id = $subProduct->id;
        
                if (isset($value['inventory']['min_stock'])) {
                    $inventory->min_stock = $value['inventory']['min_stock'];
                }
        
                if (isset($value['inventory']['max_stock'])) {
                    $inventory->max_stock = $value['inventory']['max_stock'];
                }
        
                if (isset($value['inventory']['stock'])) {
                    $inventory->stock = $value['inventory']['stock'];
                }
        
                $inventory->save();
            } 
             
        }

        return $product;
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
     * Get all the description detail
     */

    public function descriptions()
    {
        return $this->morphMany(Description::class, 'descriptiontable');
    }

    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewtable');
    }

    /**
     * Get all the seo details
     */

    public function seo()
    {
        return $this->morphOne(Seo::class, 'seotable');
    }


    /**
     * Get all the brand data
     */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id');
    }

    /**
     * Get all of the client name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metatable');
    }

    public function schema()
    {
        return $this->morphOne(Schema::class, 'schematable');
    }

    public function sub_product()
    {
        return $this->hasMany(SubProduct::class, 'product_id');
    }

    /**
     * Get all the country data
     */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    public function relatedProducts()
    {
        return $this->morphMany(RelatedProduct::class, 'relatedproductable');
    }

    public function categoryProducts()
    {
        return $this->hasMany(CategoryProduct::class, 'product_id');
    }

    public function recipeProducts()
    {
        return $this->hasMany(RecipeProduct::class, 'product_id');
    }

    public function trendingProducts()
    {
        return $this->hasMany(TrendingProduct::class, 'product_id');
    }

    public function recommendedProducts()
    {
        return $this->hasMany(RecommendedProduct::class, 'product_id');
    }

    public function featuredProducts()
    {
        return $this->hasMany(FeaturedProduct::class, 'product_id');
    }
}
