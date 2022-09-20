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

class Blog extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "blogs";

    protected $fillable = ['client_id', 'title', 'slug', 'short_description', 'long_description', 'image_file', 'status'];

    protected $sortParameterName = 'sort';

    public $sortable = ['title', 'status', 'created_at'];

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

        self::creating(function ($blog) {

            if (Auth::check()) {
                $blog->created_by = Auth::user()->id;
            }
        });

        self::created(function ($blog) {
            // ... code here
        });

        self::updating(function ($blog) {
            $blog->updated_by = Auth::user()->id;
        });

        self::updated(function ($blog) {
            // ... code here
        });

        self::deleting(function ($blog) {
            $blog->deleted_by = Auth::user()->id;
            $blog->save();
        });

        self::deleted(function ($blog) {
        });
    }

    public static function addUpdatedBlogs($blog, $request)
    {
        if (isset($request->client_id)) {
            $blog->client_id = $request->client_id;
        } else {
            $blog->client_id = Auth::user()->client->id;
        }

        if (isset($request->title)) {
            $blog->title = $request->title;
        }

        if (isset($request->slug)) {
            $blog->slug = $request->slug;
        }

        if (isset($request->short_description)) {
            $blog->short_description = $request->short_description;
        }

        if (isset($request->long_description)) {
            $blog->long_description = $request->long_description;
        }

        if (isset($request->status)) {
            $blog->status = $request->status;
        }

        $blog->save();

        return $blog;
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

    /**
     * Get all the image detail
     */
    public function images()
    {
        return $this->morphMany(Image::class, 'imagetable');
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
