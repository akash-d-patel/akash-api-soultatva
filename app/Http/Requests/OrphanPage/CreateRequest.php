<?php

namespace App\Http\Requests\OrphanPage;

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
            'old_url' => 'required',
            'new_url' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'old_url.required' => 'Please enter old_url',
            'new_url.required' => 'Please enter new_url'
        ];
    }
}
