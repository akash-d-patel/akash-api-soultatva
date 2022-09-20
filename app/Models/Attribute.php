<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;
use App\Scopes\ClientScope;


class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = 'attributes';
    protected $fillable = [
        'name', 'description', 'status'
    ];

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
                $query->where('name', $constraint->getOperator(), $constraint->getValue());
                //->orWhere('status', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    /**
     * Get the comments for the blog post.
     */
    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class);
    }

    public static function createUpdate($attribute, $request)
    {
        if (isset($request->client_id)) {
            $attribute->client_id = $request->client_id;
        } else {
            $attribute->client_id = Auth::user()->client->id;
        }

        if (isset($request->parent_id)) {
            $attribute->parent_id = null;
            if ($request->parent_id > 0) {
                $attribute->parent_id = $request->parent_id;
            }
        }

        if (isset($request->name)) {
            $attribute->name = $request->name;
        }

        if (isset($request->description)) {
            $attribute->description = $request->description;
        }
        if (isset($request->status)) {
            $attribute->status = $request->status;
        }

        // if (isset($request->order)) {
        //     $attribute->order = $request->order;
        // }

        $attribute->save();

        return $attribute;
    }
    public static function boot()
    {

        parent::boot();

        /* client globalscope */
        static::addGlobalScope(new ClientScope);

        self::creating(function ($attribute) {

            if (Auth::check()) {

                $attribute->created_by = Auth::user()->id;
                //  $attribute->order = self::count() + 1;

            }
        });

        self::created(function ($attribute) {
            // ... code here
        });

        self::updating(function ($attribute) {

            if (Auth::check()) {

                $attribute->updated_by = Auth::user()->id;
            }
        });

        self::updated(function ($attribute) {
            // ... code here
        });

        self::deleting(function ($attribute) {
            $attribute->deleted_by = Auth::user()->id;
            $attribute->save();
        });

        self::deleted(function ($attribute) {
        });
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
