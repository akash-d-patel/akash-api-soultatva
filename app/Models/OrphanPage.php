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

class OrphanPage extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "orphan_pages";

    protected $fillable = ['client_id', 'old_url', 'new_url'];

    protected $sortParameterName = 'sort';

    public $sortable = ['old_url', 'new_url', 'created_at'];

    protected $searchable = ['search_txt', 'old_url', 'new_url'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('old_url', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('new_url', "LIKE", "%" . $constraint->getValue() . "%");
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

        self::creating(function ($orphanPage) {

            if (Auth::check()) {
                $orphanPage->created_by = Auth::user()->id;
            }
        });

        self::created(function ($orphanPage) {
            // ... code here
        });

        self::updating(function ($orphanPage) {
            $orphanPage->updated_by = Auth::user()->id;
        });

        self::updated(function ($orphanPage) {
            // ... code here
        });

        self::deleting(function ($orphanPage) {
            $orphanPage->deleted_by = Auth::user()->id;
            $orphanPage->save();
        });

        self::deleted(function ($orphanPage) {
        });
    }

    public static function addUpdatedOrphanPages($orphanPage, $request)
    {
        if (isset($request->client_id)) {
            $orphanPage->client_id = $request->client_id;
        } else {
            $orphanPage->client_id = Auth::user()->client->id;
        }

        if (isset($request->old_url)) {
            $orphanPage->old_url = $request->old_url;
        }

        if (isset($request->new_url)) {
            $orphanPage->new_url = $request->new_url;
        }

        $orphanPage->save();

        return $orphanPage;
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
}
