<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;

class Permission extends Model
{
    use HasFactory;
    use PimpableTrait;
    protected $table = "permissions";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'label', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'label'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('name', $constraint->getOperator(), $constraint->getValue())
                    ->orwhere('label', $constraint->getOperator(), $constraint->getValue());
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }
    
    public static function createUpdate($permission, $request){

        if (isset($request->parent_id)) {
            $permission->parent_id = null;
            if ($request->parent_id > 0) {
                $permission->parent_id = $request->parent_id;
            }
        }

        if(isset($request->name)) {
            $permission->name = $request->name;
        }

        if(isset($request->label)) {
            $permission->label = $request->label;
        }

        $permission->save();

        return $permission;

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
