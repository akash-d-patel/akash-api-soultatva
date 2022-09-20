<?php

namespace App\Http\Requests\Otp;

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

            'otp' => 'required',
            'mobile_no' => 'required|digits:10|numeric',
        ];
    }

    public function messages()
    {
        return [
            'otp.required' => 'Please enter otp',
            'mobile_no.required' => 'Please enter mobile number',
        ];
    }
}
