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

class HeaderMenu extends Model
{
    use HasFactory;
    use PimpableTrait;
    use SoftDeletes;
    protected $table = "header_menus";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'label', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'label', 'status'];

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
                      ->orwhere('label', "LIKE", "%" . $constraint->getValue() . "%");
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

        self::creating(function ($headerMenu) {

            if (Auth::check()) {

                $headerMenu->created_by = Auth::user()->id;
                $headerMenu->order = self::count() + 1;
            }
        });

        self::created(function ($headerMenu) {
            // ... code here     
        });

        self::updating(function ($headerMenu) {
            $headerMenu->updated_by = Auth::user()->id;
        });

        self::updated(function ($headerMenu) {
            // ... code here
        });

        self::deleting(function ($headerMenu) {
            $headerMenu->deleted_by = Auth::user()->id;
            $headerMenu->save();
        });

        self::deleted(function ($headerMenu) {
        });
    }


    public static function createUpdate($headerMenu, $request)
    {
        if (isset($request->client_id)) {
            $headerMenu->client_id = $request->client_id;
        } else {
            $headerMenu->client_id = Auth::user()->client->id;
        }

        if (isset($request->parent_id)) {
            $headerMenu->parent_id = null;
            if ($request->parent_id > 0) {
                $headerMenu->parent_id = $request->parent_id;
            }
        }

        if (isset($request->name)) {
            $headerMenu->name = $request->name;
        }

        if (isset($request->label)) {
            $headerMenu->label = $request->label;
        }

        if (isset($request->url)) {
            $headerMenu->url = $request->url;
        }

        if (isset($request->order)) {
            $headerMenu->order = $request->order;
        }

        if (isset($request->link_type)) {
            $headerMenu->link_type = $request->link_type;
        }

        if (isset($request->link_open_with)) {
            $headerMenu->link_open_with = $request->link_open_with;
        }

        if (isset($request->upper_top)) {
            $headerMenu->upper_top = $request->upper_top;
        }

        if (isset($request->top)) {
            $headerMenu->top = $request->top;
        }

        if (isset($request->bottom)) {
            $headerMenu->bottom = $request->bottom;
        }

        if (isset($request->left)) {
            $headerMenu->left = $request->left;
        }

        if (isset($request->right)) {
            $headerMenu->right = $request->right;
        }

        if (isset($request->is_authentication)) {
            $headerMenu->is_authentication = $request->is_authentication;
        }

        if (isset($request->status)) {
            $headerMenu->status = $request->status;
        }

        $headerMenu->save();

        return $headerMenu;
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

    /* Get all of the client name */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }

}
