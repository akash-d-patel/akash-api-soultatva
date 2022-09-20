<?php

namespace App\Http\Requests\Website;

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
            'website_url' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'website_url.required' => 'Please enter website_url'
        ];
    }
}
