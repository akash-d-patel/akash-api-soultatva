<?php

namespace App\Http\Controllers;

use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Requests\EmailTemplate\CreateRequest;
use App\Http\Requests\EmailTemplate\EditRequest;
use App\Http\Resources\EmailTemplateResource;
use App\Http\Controllers\Api\BaseController;
use GuzzleHttp;
use GuzzleHttp\Exception\RequestException;

class EmailTemplateController extends BaseController
{

    public function __construct()
    {
        $this->authorizeResource(EmailTemplate::class);
        $this->getMiddleware();
    }

    /**
     * List
     * @group EmailTemplate
     */
    public function index(Request $request, EmailTemplate $emailTemplate)
    {
        $emailTemplates = $emailTemplate->pimp()->paginate();
        EmailTemplateResource::collection($emailTemplates);
        return $this->sendResponse(compact('emailTemplates'), "All Record");
    }

    /**
     * Add
     * @group EmailTemplate
     */
    public function store(CreateRequest $request)
    {
        $emailTemplate = EmailTemplate::addUpdate(new EmailTemplate, $request);
        $message = "Email Template added successfully";
        $emailTemplate = new EmailTemplateResource($emailTemplate);
        return $this->sendResponse(compact('emailTemplate'), $message);
    }

    /**
     * Show
     * @group EmailTemplate
     */
    public function show(EmailTemplate $emailTemplate, Request $request)
    {
        $message = 'Email Template listed successfully';
        $emailTemplate = new EmailTemplateResource($emailTemplate);
        return $this->sendResponse(compact('emailTemplate'), $message);
    }

    /**
     * Update
     * @group EmailTemplate
     */
    public function update(EditRequest $request, EmailTemplate $emailTemplate)
    {
        $emailTemplate = EmailTemplate::addUpdate($emailTemplate, $request);
        $message = "Email Template updated successfully";
        $emailTemplate = new EmailTemplateResource($emailTemplate);
        return $this->sendResponse(compact('emailTemplate'), $message);
    }

    /**
     * Delete
     * @group EmailTemplate
     */
    public function destroy(EmailTemplate $emailTemplate, Request $request)
    {
        $emailTemplate->delete();
        $message = "Email Template deleted successfully";
        $emailTemplate = new EmailTemplateResource($emailTemplate);
        return $this->sendResponse(compact('emailTemplate'), $message);
    }

    // send email
    public function send(Request $request)
    {
        $url = env('SCHEDULER_URL');
        
        $requestContent =    [
            'form_params' => [
                'client_id' => $request->client_id,
                'email_template_id' => $request->email_template_id,
                'project_id' => $request->project_id,
                'from_email' => $request->from_email,
                'to_email[]' => $request->to_email,
                'cc[]' => $request->cc,
                'bcc[]' => $request->bcc,
                'subject' => $request->subject,
                'attechment' => $request->attechment,
                'template' => $request->template,
                'status' => $request->status
            ],
            'headers' => ['Accept' => 'application/json'],
        ];

        try {
            $client = new GuzzleHttp\Client();

            $apiRequest = $client->request('POST', $url, $requestContent);

            $response = json_decode($apiRequest->getBody());

            return $this->sendResponse(compact('response'));
        } catch (RequestException  $re) {
            return $this->sendError('something went wrong..');  
        }
    }
}
