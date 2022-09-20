<?php

namespace App\Http\Requests\State;

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
            'country_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'country_id.required' => 'Please select country',
        ];
    }
}
