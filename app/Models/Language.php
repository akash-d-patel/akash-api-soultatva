<?php

namespace App\Models;

use App\Scopes\ClientScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;

class Language extends Model
{
    use HasFactory;
    use PimpableTrait;
    protected $table = "languages";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'initial'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('name', "LIKE", "%" . $constraint->getValue() . "%");
                    // ->orWhere('initial', $constraint->getOperator(), $constraint->getValue());
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
    }

    public static function addUpdate($language, $request)
    {
        if (isset($request->client_id)) {
            $language->client_id = $request->client_id;
        } else {
            $language->client_id = Auth::user()->client->id;
        }

        if (isset($request->name)) {
            $language->name = $request->name;
        }

        if (isset($request->initial)) {
            $language->initial = $request->initial;
        }

        if (isset($request->class)) {
            $language->class = $request->class;
        }

        $language->save();

        return $language;
    }

    /**
     * Get all of the clients's name.
     */

    public function client()
    {
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
