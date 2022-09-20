<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Seo extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "seos";

   protected $sortParameterName = 'sort';

    public $sortable = ['title','created_at'];

    protected $searchable = ['search_txt', 'title', 'robots'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('title', $constraint->getOperator(), $constraint->getValue())
                ->orWhere('robots', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($seo) {
            if(Auth::check()){
            $seo->created_by = Auth::user()->id;
            }
        });

        self::created(function ($seo) {
            // ... code here
        });

        self::updating(function ($seo) {
            if(Auth::check()){
            $seo->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($seo) {
            // ... code here
        });

        self::deleting(function ($seo) {
            $seo->deleted_by = Auth::user()->id;
            $seo->save();
        });

        self::deleted(function ($seo) {
        });
    }

    public static function addUpdate($seo, $request)
    {

        if (isset($request->title)) {
            $seo->title = $request->title;
        }

        if (isset($request->description)) {
            $seo->description = $request->description;
        }

        if (isset($request->robots)) {
            $seo->robots = $request->robots;
        }

        if (isset($request->view_port)) {
            $seo->view_port = $request->view_port;
        }

        if (isset($request->charset)) {
            $seo->charset = $request->charset;
        }

        if (isset($request->refresh_redirect)) {
            $seo->refresh_redirect = $request->refresh_redirect;
        }

        $seo->save();

        return $seo;
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



    public function seotable()
    {
        return $this->morphTo();
    }
}
