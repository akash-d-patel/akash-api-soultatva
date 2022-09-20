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

class Website extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    
    protected $table = "websites";

    protected $fillable = ['name', 'website_url'];

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'website_url', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'website_url'];


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
                      ->orWhere('website_url', "LIKE", "%" . $constraint->getValue() . "%");
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

        self::creating(function ($website) {
            if (Auth::check()) {

                $website->created_by = Auth::user()->id;
            }
        });

        self::created(function ($website) {
            // ... code here
        });

        self::updating(function ($website) {
            $website->updated_by = Auth::user()->id;
        });

        self::updated(function ($website) {
            // ... code here
        });

        self::deleting(function ($website) {
            $website->deleted_by = Auth::user()->id;
            $website->save();
        });

        self::deleted(function ($website) {
        });
    }

    /* website create and update method */

    public static function createUpdate($website, $request)
    {

        if (isset($request->client_id)) {
            $website->client_id = $request->client_id;
        } else {
            $website->client_id = Auth::user()->client->id;
        }

        if (isset($request->name)) {
            $website->name = $request->name;
        }

        if (isset($request->website_url)) {
            $website->website_url = $request->website_url;
        }

        if (isset($request->status)) {
            $website->status = $request->status;
        }

        $website->save();

        return $website;
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
}
