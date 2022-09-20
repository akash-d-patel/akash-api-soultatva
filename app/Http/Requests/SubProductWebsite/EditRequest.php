<?php

namespace App\Http\Requests\SubProductWebsite;

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
            'website_id' => 'required',
            'url' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'website_id.required' => 'Please enter website_id',
            'url.required' => 'Please enter url'
        ];
    }
}
