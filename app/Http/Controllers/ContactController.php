<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Contact\CreateRequest;
use App\Http\Requests\Contact\EditRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

use function App\Helpers\getSchedulerApiData;

class ContactController extends BaseController
{
    public function __construct()
    {
        $this->authorizeResource(Contact::class);
        $this->getMiddleware();
    }

   /**
     * List
     * @group Contact
     */
    public function index()
    {
        $contacts = Contact::with('creater')->pimp()->paginate();
        $message = "All Records";
        ContactResource::collection($contacts);
        return $this->sendResponse(compact('contacts'),$message);
    }

    /**
     * Add
     * @group Contact
     */
    public function store(CreateRequest $request)
    {
        $contact = Contact::addUpdatedContact(new Contact, $request);
        $message = "contact added successfully";
        $contact = new ContactResource($contact);
        return $this->sendResponse(compact('contact'),$message);
    }

    /**
     * Show
     * @group Contact
     */
    public function show(Contact $contact)
    {
        $message = "contact listed successfully";
        $contact = new ContactResource($contact);
        return $this->sendResponse(compact('contact'),$message);
    }

    /**
     * Update
     * @group Contact
     */
    public function update(Request $request, Contact $contact)
    {
        $contact = Contact::addUpdatedContact($contact, $request);
        $message = "Contact updated successfully";
        $contact = new ContactResource($contact);
        if($contact->status == "read") {
            /*
            * Send email on contact inquiry reply userwith scheduler
            */
            $arrTemplateConstant = [];
            /**  Variable need to be change in template*/
            $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
            $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
            $arrTemplateConstant['#USER-NAME#'] = $contact->name;
            
            $request->request->add(['client_id' =>  $contact->client_id]);
            $request->request->add(['project_id' =>  1]);
            $request->request->add(['from_email' =>  'admin@soultatva.com']);
            $request->request->add(['to_email' =>  $contact->email]);
            $request->request->add(['subject' =>  'Contact enquiry reply user']);
            $request->request->add(['status' =>  'Send']);
            if($contact->client_id == 2) {
                $request->request->add(['email_template_id' =>  43]);
                $request->request->add(['template' =>  '43_contact_enquiry_reply_user']);
            } else {
                $request->request->add(['email_template_id' =>  20]);
                $request->request->add(['template' =>  '20_contact_enquiry_reply_user']);
            }
            $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);

            getSchedulerApiData($request);   

        }
        return $this->sendResponse(compact('contact'), $message);
    }

    /**
     * Delete
     * @group Contact
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        $message = "contact deleted successfully";
        $contact = new ContactResource($contact);
        return $this->sendResponse(compact('contact'),$message);
    }
}
