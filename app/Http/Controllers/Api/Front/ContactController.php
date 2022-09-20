<?php

namespace App\Http\Controllers\Api\Front;

use App\Http\Controllers\Api\BaseController;
use App\Http\Requests\Contact\CreateRequest;
use App\Http\Resources\ContactResource;
use App\Models\Contact;
use Illuminate\Http\Request;

use function App\Helpers\getSchedulerApiData;

class ContactController extends BaseController
{
    /**
     * List
     * @group Contact
     */
    public function list(Request $request)
    {
        $contacts = Contact::with(['creater'])->pimp()->paginate();
        $message = "All Records";
        ContactResource::collection($contacts);
        return $this->sendResponse(compact('contacts'), $message);
    }
    /**
     * Add
     * @group Contact
     */
    public function store(Request $request)
    {
        $contact = Contact::addUpdatedContact(new Contact, $request);
        $message = "contact added successfully";
        $contact = new ContactResource($contact);
        /*
         * Send email on contact inquiry with scheduler
         */
        $arrTemplateConstant = [];
        /**  Variable need to be change in template*/
        $arrTemplateConstant['#WEBSITE#'] = "Soultatva";
        $arrTemplateConstant['#LOGO-PATH#'] = "https://www.soultatva.com/images/sharing-logo.png";
        $arrTemplateConstant['#USER-NAME#'] = $contact->name;
        $arrTemplateConstant['#USER-EMAIL#'] = $contact->email;
        $arrTemplateConstant['#USER-MESSAGE#'] = $contact->message;
           
        $request->request->add(['client_id' =>  $contact->client_id]);
        $request->request->add(['project_id' =>  1]);
        $request->request->add(['from_email' =>  'admin@soultatva.com']);
        $request->request->add(['to_email' =>  'efiveorganics@gmail.com']);
        $request->request->add(['subject' =>  'Contact Inquiry']);
        $request->request->add(['status' =>  'Send']);

        if($contact->client_id == 2) {
            $request->request->add(['email_template_id' =>  24]);
            $request->request->add(['template' =>  '24_contact_inquiry']);
        } else {
            $request->request->add(['email_template_id' =>  1]);
            $request->request->add(['template' =>  '01_contact_inquiry']);
        }

        $request->request->add(['template_var' =>  json_encode($arrTemplateConstant)]);

        getSchedulerApiData($request);

        return $this->sendResponse(compact('contact'), $message);
    }
}
