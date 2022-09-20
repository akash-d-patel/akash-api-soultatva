<?php

namespace App\Http\Requests\Contact;

use Illuminate\Foundation\Http\FormRequest;

class EditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'subject' => 'required',
            'email' => 'required|email|unique:contacts,email',
            'contact_no' => 'required|digits:10|numeric|unique:contacts,contact_no',
            'message' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter the name',
            'subject.required' => 'Please enter the subject',
            'email.required' => 'Please enter the email',
            'contact_no.required' => 'Please enter the contact number',
            'message.required' => 'Please enter the message'
        ];
    }
}
