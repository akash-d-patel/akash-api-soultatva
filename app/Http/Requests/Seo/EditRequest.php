<?php

namespace App\Http\Requests\Seo;

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
            'title' => 'required',
            'description' => 'required',
            'robots' => 'required',
            'view_port' => 'required',
            'charset' => 'required',
            'refresh_redirect' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'please enter title',
            'description.required' => 'Please enter description',
            'robots.required' => 'Please enter robots',
            'view_port.required' => 'Please enter view port',
            'charset.required' => 'Please enter character set',
            'refresh_redirect.required' => 'Please enter refresh redirect',
        ];
    }
}
