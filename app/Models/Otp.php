<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class Otp extends Model
{
    use HasFactory;
    use PimpableTrait;
    protected $table = "otps";

    protected $sortParameterName = 'sort';

    public $sortable = ['type', 'otp', 'created_at'];

    protected $searchable = ['search_txt', 'type'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('type', $constraint->getOperator(), $constraint->getValue());        
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    /* otp create and update method */

    public static function createUpdate($otp, $request,$user){


        if(isset($user->id)){
            $otp->user_id = $user->id;
        } 
        
        if(isset($request->type)) {
            $otp->type = $request->type;

        } else {
            $otp->type = $request->mobile_no;
        }

        if(isset($request->otp)) {
            $otp->otp = $request->otp;
        } else {
            $otp->otp = rand(100000,999999);
        }

        //$otp->verified_at = Carbon::now();
        $current = Carbon::now();
        $otp->expired_at = $current->addMinutes(10);

        $otp->save();

        return $otp;

    }
    /* get the user_id in user table */

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
