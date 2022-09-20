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

class Page extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "pages";

    protected $sortParameterName = 'sort';

    public $sortable = ['status', 'created_at'];

    protected $searchable = ['search_txt', 'title', 'status'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('title', "LIKE", "%" . $constraint->getValue() . "%");
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

        self::creating(function ($page) {

            if (Auth::check()) {

                $page->created_by = Auth::user()->id;
            }
        });

        self::created(function ($page) {
            // ... code here
        });

        self::updating(function ($page) {
            $page->updated_by = Auth::user()->id;
        });

        self::updated(function ($page) {
            // ... code here
        });

        self::deleting(function ($page) {
            $page->deleted_by = Auth::user()->id;
            $page->save();
        });

        self::deleted(function ($page) {
        });
    }

    public static function createUpdate($page, $request)
    {
        if (isset($request->client_id)) {
            $page->client_id = $request->client_id;
        } else {
            $page->client_id = Auth::user()->client->id;
        }

        if (isset($request->title)) {
            $page->title = $request->title;
        }

        if (isset($request->slug)) {
            $page->slug = $request->slug;
        }

        if (isset($request->description)) {
            $page->description = $request->description;
        }

        if (isset($request->types)) {
            $page->types = $request->types;
        }

        if (isset($request->is_authentication)) {
            $page->is_authentication = $request->is_authentication;
        }

        if (isset($request->status)) {
            $page->status = $request->status;
        }
        
        $page->save();

        return $page;
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

    public function meta()
    {
        return $this->morphOne(Meta::class, 'metatable');
    }

    public function schema()
    {
        return $this->morphOne(Schema::class, 'schematable');
    }
}
