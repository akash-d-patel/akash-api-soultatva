<?php
namespace App\Scopes;

use App\Models\Client;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;
use Illuminate\Support\Facades\Auth;

  
class ClientScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {
        $url = URL('/');
        if(Auth::check()){
            $builder->where('client_id', Auth::user()->Client->id);
        } 
        else {
            $client_id = Client::where('name', $url)->value('id');
            $builder->where('client_id', $client_id);
        }
    }
}