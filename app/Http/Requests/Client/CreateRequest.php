<?php

namespace App\Http\Requests\Client;

use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest
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
            'email' => 'required|email|unique:clients,email',
            'mobile_no' => 'required|digits:10|numeric'
        ];
    }

    public function messages()
    {
        return [

            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'mobile_no.required' => 'Please enter mobile number'
        ];
    }
}
