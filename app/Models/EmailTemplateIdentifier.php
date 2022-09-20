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

class EmailTemplateIdentifier extends Model
{
    use HasFactory;
    use SoftDeletes;
    use PimpableTrait;

    protected $table = "email_template_identifiers";

    protected $sortParameterName = 'sort';

    public $sortable = ['identifier', 'status', 'created_at'];

    protected $searchable = ['search_txt', 'identifier'];

    // use one filter to search in multiple columns

    protected function processSearchTxtFilter(Builder $builder, Constraint $constraint)
    {

        if ($constraint->getValue() == '') {
            return true;
        }

        // this logic should happen for LIKE/EQUAL operators only
        if ($constraint->getOperator() === Constraint::OPERATOR_LIKE || $constraint->getOperator() === Constraint::OPERATOR_EQUAL) {
            $builder->where(function ($query) use ($constraint) {
                $query->where('identifier', $constraint->getOperator(), $constraint->getValue());
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

        self::creating(function ($emailTemplateIdentifier) {

            if (Auth::check()) {
                $emailTemplateIdentifier->created_by = Auth::user()->id;
            }
        });

        self::created(function ($emailTemplateIdentifier) {
            // ... code here     
        });

        self::updating(function ($emailTemplateIdentifier) {
            $emailTemplateIdentifier->updated_by = Auth::user()->id;
        });

        self::updated(function ($emailTemplateIdentifier) {
            // ... code here
        });

        self::deleting(function ($emailTemplateIdentifier) {
            $emailTemplateIdentifier->deleted_by = Auth::user()->id;
            $emailTemplateIdentifier->save();
        });

        self::deleted(function ($emailTemplateIdentifier) {
        });
    }

    public static function addUpdateEmailTemplateIdentifier($emailTemplateIdentifier, $request)
    {
        if (isset($request->identifier)) {
            $emailTemplateIdentifier->identifier = $request->identifier;
        }

        if (isset($request->status)) {
            $emailTemplateIdentifier->status = $request->status;
        }

        $emailTemplateIdentifier->save();

        return $emailTemplateIdentifier;
    }

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
