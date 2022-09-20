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

class Meta extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "metas";

    protected $fillable = ['client_id', 'meta_title', 'meta_description', 'meta_keywords'];

    protected $sortParameterName = 'sort';

    public $sortable = ['meta_title', 'created_at'];

    protected $searchable = ['search_txt', 'meta_title'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('meta_title', $constraint->getOperator(), $constraint->getValue());
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

        self::creating(function ($meta) {

            if (Auth::check()) {
                $meta->created_by = Auth::user()->id;
            }
        });

        self::created(function ($meta) {
            // ... code here
        });

        self::updating(function ($meta) {
            $meta->updated_by = Auth::user()->id;
        });

        self::updated(function ($meta) {
            // ... code here
        });

        self::deleting(function ($meta) {
            $meta->deleted_by = Auth::user()->id;
            $meta->save();
        });

        self::deleted(function ($meta) {
        });
    }

    /**
     * Meta
     */
    public static function createUpdate($meta, $request)
    {
        if (isset($request->client_id)) {
            $meta->client_id = $request->client_id;
        } else {
            $meta->client_id = Auth::user()->client->id;
        }

        if (isset($request->meta_title)) {
            $meta->meta_title = $request->meta_title;
        }

        if (isset($request->meta_description)) {
            $meta->meta_description = $request->meta_description;
        }

        if (isset($request->meta_keywords)) {
            $meta->meta_keywords = $request->meta_keywords;
        }

        if (isset($request->show_redirect_popup)) {
            $meta->show_redirect_popup = $request->show_redirect_popup;
        }

        if (isset($request->p_domain_verify)) {
            $meta->p_domain_verify = $request->p_domain_verify;
        }

        if (isset($request->og_title)) {
            $meta->og_title = $request->og_title;
        }

        if (isset($request->og_url)) {
            $meta->og_url = $request->og_url;
        }

        if (isset($request->og_image)) {
            $meta->og_image = $request->og_image;
        }

        if (isset($request->og_image_secure_url)) {
            $meta->og_image_secure_url = $request->og_image_secure_url;
        }

        if (isset($request->og_description)) {
            $meta->og_description = $request->og_description;
        }

        if (isset($request->og_site_name)) {
            $meta->og_site_name = $request->og_site_name;
        }

        if (isset($request->og_type)) {
            $meta->og_type = $request->og_type;
        }

        if (isset($request->og_price_amount)) {
            $meta->og_price_amount = $request->og_price_amount;
        }

        if (isset($request->og_price_currency)) {
            $meta->og_price_currency = $request->og_price_currency;
        }

        if (isset($request->ahrefs_site_verification)) {
            $meta->ahrefs_site_verification = $request->ahrefs_site_verification;
        }

        if (isset($request->robots)) {
            $meta->robots = $request->robots;
        }

        if (isset($request->google_site_verification)) {
            $meta->google_site_verification = $request->google_site_verification;
        }

        if (isset($request->twitter_card)) {
            $meta->twitter_card = $request->twitter_card;
        }

        if (isset($request->twitter_title)) {
            $meta->twitter_title = $request->twitter_title;
        }

        if (isset($request->twitter_site)) {
            $meta->twitter_site = $request->twitter_site;
        }

        if (isset($request->twitter_description)) {
            $meta->twitter_description = $request->twitter_description;
        }

        if (isset($request->twitter_image)) {
            $meta->twitter_image = $request->twitter_image;
        }

        if (isset($request->twitter_creator)) {
            $meta->twitter_creator = $request->twitter_creator;
        }

        $meta->save();

        return $meta;
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

    public function metatable()
    {
        return $this->morphTo();
    }
}
