<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Jedrzej\Pimpable\PimpableTrait;
use Jedrzej\Searchable\Constraint;

class Contact extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "contacts";

    protected $sortParameterName = 'sort';

    public $sortable = ['name', 'email', 'contact_no', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'name', 'email', 'contact_no', 'status'];

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
                      ->orWhere('email', "LIKE", "%" . $constraint->getValue() . "%")
                      ->orWhere('contact_no', "LIKE", "%" . $constraint->getValue() . "%");
            });

            return true;
        }

        // default logic should be executed otherwise
        return false;
    }

    public static function boot()
    {
        parent::boot();

        self::creating(function ($contact) {

            if (Auth::check()) {
                $contact->created_by = Auth::user()->id;
            }
        });

        self::created(function ($contact) {
            // ... code here
        });

        self::updating(function ($contact) {
            $contact->updated_by = Auth::user()->id;
        });

        self::updated(function ($contact) {
            // ... code here
        });

        self::deleting(function ($contact) {
            $contact->deleted_by = Auth::user()->id;
            $contact->save();
        });

        self::deleted(function ($contact) {
        });
    }

    public static function addUpdatedContact($contact, $request)
    {

        if (isset($request->client_id)) {
            $contact->client_id = $request->client_id;
        } else {
            $url = URL('/');
            $client_id = Client::where('name', $url)->value('id');
            $contact->client_id = $client_id;
        }

        if (isset($request->name)) {
            $contact->name = $request->name;
        }

        if (isset($request->subject)) {
            $contact->subject = $request->subject;
        }

        if (isset($request->email)) {
            $contact->email = $request->email;
        }

        if (isset($request->contact_no)) {
            $contact->contact_no = $request->contact_no;
        }

        if (isset($request->message)) {
            $contact->message = $request->message;
        }

        if (isset($request->status)) {
            $contact->status = $request->status;
        }

        $contact->save();

        return $contact;
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
