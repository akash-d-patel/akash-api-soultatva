<?php

namespace App\Http\Requests\Meta;

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
            'meta_title' => 'required',
            'meta_description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'meta_title.required' => 'Please enter meta_title',
            'meta_description.required' => 'Please enter meta_description',
        ];
    }
}
