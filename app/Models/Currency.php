<?php

namespace App\Models;

use App\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Currency extends Model
{
    use HasFactory;
    use PimpableTrait;

    protected $table = "currencies";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'code', 'symbol'];

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
                    ->orWhere('code', "LIKE", "%" . $constraint->getValue() . "%")
                    ->orWhere('symbol', "LIKE", "%" . $constraint->getValue() . "%");
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot(){

        parent::boot();
        /* client globalscope */
        static::addGlobalScope(new ClientScope);
    }

    public static function addUpdate($currency, $request)
    {
        if (isset($request->client_id)) {
            $currency->client_id = $request->client_id;
        } else {
            $currency->client_id = Auth::user()->client->id;
        }

        if (isset($request->code)) {
            $currency->code = $request->code;
        }

        if (isset($request->name)) {
            $currency->name = $request->name;
        }

        if (isset($request->symbol)) {
            $currency->symbol = $request->symbol;
        }

        $currency->save();

        return  $currency;
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
