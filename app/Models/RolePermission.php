<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class RolePermission extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;
    protected $table = "role_permissions";

    protected $sortParameterName = 'sort';

    public $sortable = ['role_id', 'permission_id', 'created_at'];

    protected $searchable = ['search_txt', 'role_id', 'permission_id'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('role_id', $constraint->getOperator(), $constraint->getValue())
                      ->orWhere('permission_id', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

            self::creating(function($rolePermission){
            if(Auth::check()){
                $rolePermission->created_by = Auth::user()->id;
            }
        });

        self::created(function($rolePermission){
            // ... code here     
        });

        self::updating(function($rolePermission){
            if(Auth::check()){
            $rolePermission->updated_by = Auth::user()->id;
            }
        });

        self::updated(function($rolePermission){
            // ... code here
        });

        self::deleting(function($rolePermission){
            $rolePermission->deleted_by = Auth::user()->id;
            $rolePermission->save();
        });

        self::deleted(function($rolePermission){

        });
    }
    
    
    public static function createUpdate($rolePermission, $request){

        if(isset($request->role_id)) {
            $rolePermission->role_id = null;
            if(!is_null($request->role_id)){
                $rolePermission->role_id = $request->role_id;
            }
        }

        if(isset($request->permission_id)) {
            $rolePermission->permission_id = null;
            if(!is_null($request->permission_id)){
                $rolePermission->permission_id = $request->permission_id;
            }
        }

        $rolePermission->save();

        return $rolePermission;

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

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id');
    }
}
