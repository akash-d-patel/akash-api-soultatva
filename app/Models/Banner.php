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


class Banner extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "banners";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'status', 'created_at'];

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

        self::creating(function ($banner) {
            if (Auth::check()) {

                $banner->created_by = Auth::user()->id;
            }
        });

        self::created(function ($banner) {
            // ... code here     
        });

        self::updating(function ($banner) {
            if (Auth::check()) {
                $banner->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($banner) {
            // ... code here
        });

        self::deleting(function ($banner) {
            $banner->deleted_by = Auth::user()->id;
            $banner->save();
        });

        self::deleted(function ($banner) {
        });
    }


    public static function createUpdate($banner, $request)
    {
        if (isset($request->client_id)) {
            $banner->client_id = $request->client_id;
        } else {
            $banner->client_id = Auth::user()->client->id;
        }

        if (isset($request->name)) {
            $banner->name = $request->name;
        }

        if (isset($request->description)) {
            $banner->description = $request->description;
        }

        if (isset($request->status)) {
            $banner->status = $request->status;
        }

        if (isset($request->constant)) {
            $banner->constant = $request->constant;
        }

        $banner->save();

        return $banner;
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


    public function images()
    {
        return $this->morphMany(Image::class, 'imagetable');
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
