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

class SubProductWebsite extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    
    protected $table = "sub_product_websites";

    protected $fillable = ['sub_product_id', 'website_id', 'url'];

    protected $sortParameterName = 'sort';

    public $sortable = ['sub_product_id', 'website_id', 'url', 'created_at'];

    protected $searchable = ['search_txt', 'sub_product_id', 'website_id', 'url'];


    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('sub_product_id', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('website_id', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('url', "LIKE", "%" . $constraint->getValue() . "%");
            });

            return true;
        }

        return false;
    }

    public static function boot()
    {
        parent::boot();

        /* client globalscope */
        static::addGlobalScope(new ClientScope);

        self::creating(function ($subProductWebsite) {
            if (Auth::check()) {

                $subProductWebsite->created_by = Auth::user()->id;
            }
        });

        self::created(function ($subProductWebsite) {
            // ... code here
        });

        self::updating(function ($subProductWebsite) {
            $subProductWebsite->updated_by = Auth::user()->id;
        });

        self::updated(function ($subProductWebsite) {
            // ... code here
        });

        self::deleting(function ($subProductWebsite) {
            $subProductWebsite->deleted_by = Auth::user()->id;
            $subProductWebsite->save();
        });

        self::deleted(function ($subProductWebsite) {
        });
    }

    /* website create and update method */

    public static function createUpdate($subProduct, $subProductWebsite, $request)
    {

        if (isset($request->client_id)) {
            $subProductWebsite->client_id = $request->client_id;
        } else {
            $subProductWebsite->client_id = Auth::user()->client->id;
        }

        if (isset($request->website_id)) {
            $subProductWebsite->website_id = $request->website_id;
        }

        if (isset($request->url)) {
            $subProductWebsite->url = $request->url;
        }

        if (isset($request->status)) {
            $subProductWebsite->status = $request->status;
        }

        $subProduct->subProductWebsites()->save($subProductWebsite);

        return $subProductWebsite;
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

    public function subProduct()
    {
        return $this->belongsTo(SubProduct::class, 'sub_product_id');
    }

    public function website()
    {
        return $this->belongsTo(Website::class, 'website_id');
    }
}
