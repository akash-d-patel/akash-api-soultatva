<?php

namespace App\Http\Requests\UserRole;

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

            'user_id' => 'required',
            'role_id' => 'required',

        ];
    }

    public function messages()
    {
        return [

            'user_id.required' => 'Please select user',
            'role_id.required' => 'Please select role',
        ];
    }
}
