<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\EmailTemplateIdentifier\CreateRequest;
use App\Http\Requests\EmailTemplateIdentifier\EditRequest;
use App\Http\Resources\EmailTemplateIdentifierResource;
use App\Models\EmailTemplateIdentifier;
use Illuminate\Http\Request;

class EmailTemplateIdentifierController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(EmailTemplateIdentifier::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group EmailTemplateIdentifier
     */
    public function index()
    {
        $emailTemplateIdentifiers = EmailTemplateIdentifier::with('creater')->pimp()->paginate();
        $message = "All Records";
        EmailTemplateIdentifierResource::collection($emailTemplateIdentifiers);
        return $this->sendResponse(compact('emailTemplateIdentifiers'),$message);
    }

    /**
     * Add
     * @group EmailTemplateIdentifier
     */
    public function store(CreateRequest $request)
    {
        $emailTemplateIdentifier = EmailTemplateIdentifier::addUpdateEmailTemplateIdentifier(new EmailTemplateIdentifier, $request);
        $message = "emailTemplateIdentifier added successfully";
        $emailTemplateIdentifier = new EmailTemplateIdentifierResource($emailTemplateIdentifier);
        return $this->sendResponse(compact('emailTemplateIdentifier'),$message);
    }

    /**
     * Show
     * @group EmailTemplateIdentifier
     */
    public function show(EmailTemplateIdentifier $emailTemplateIdentifier)
    {
        $message = "emailTemplateIdentifier listed successfully";
        $emailTemplateIdentifier = new EmailTemplateIdentifierResource($emailTemplateIdentifier);
        return $this->sendResponse(compact('emailTemplateIdentifier'),$message);
    }

    /**
     * Update
     * @group EmailTemplateIdentifier
     */
    public function update(EditRequest $request, EmailTemplateIdentifier $emailTemplateIdentifier)
    {
        $emailTemplateIdentifier = EmailTemplateIdentifier::addUpdateEmailTemplateIdentifier($emailTemplateIdentifier, $request);
        $message = "emailTemplateIdentifier updated successfully";
        $emailTemplateIdentifier = new EmailTemplateIdentifierResource($emailTemplateIdentifier);
        return $this->sendResponse(compact('emailTemplateIdentifier'),$message);
    }

    /**
     * Delete
     * @group EmailTemplateIdentifier
     */
    public function destroy(EmailTemplateIdentifier $emailTemplateIdentifier)
    {
        $emailTemplateIdentifier->delete();
        $message = "emailTemplateIdentifier deleted successfully";
        $emailTemplateIdentifier = new EmailTemplateIdentifierResource($emailTemplateIdentifier);
        return $this->sendResponse(compact('emailTemplateIdentifier'),$message);
    }
}
