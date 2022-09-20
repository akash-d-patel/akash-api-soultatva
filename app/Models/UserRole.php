<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class UserRole extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "user_roles";

    protected $sortParameterName = 'sort';

    public $sortable = ['user_id', 'role_id', 'created_at'];

    protected $searchable = ['search_txt', 'user_id', 'role_id'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('user_id', $constraint->getOperator(), $constraint->getValue())
                      ->orWhere('role_id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function($userRole){
            if (Auth::check()) {
                $userRole->created_by = Auth::user()->id;
            }
        });

        self::created(function($userRole){
            // ... code here     
        });

        self::updating(function($userRole){
            if (Auth::check()) {
                $userRole->updated_by = Auth::user()->id;
            }
        });

        self::updated(function($userRole){
            // ... code here
        });

        self::deleting(function($userRole){
            $userRole->deleted_by = Auth::user()->id;
            $userRole->save();
        });

        self::deleted(function($userRole){

        });
    }
    
    
    public static function createUpdate($userRole, $request){

        if(isset($request->user_id)) {
            $userRole->user_id = null;
            if(!is_null($request->user_id)){
                $userRole->user_id = $request->user_id;
            }
        }
        if(isset($request->role_id)) {
            $userRole->role_id = null;
            if(!is_null($request->role_id)){
                $userRole->role_id = $request->role_id;
            }
        }

        $userRole->save();

        return $userRole;

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
     * Get the phone associated with the user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

}
