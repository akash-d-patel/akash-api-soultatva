<?php

namespace App\Http\Requests\Banner;

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
            'description' => 'required',
            'constant' => 'required|unique:banners,constant',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'description.required' => 'Please enter description',
            'constant' => 'Please enter constant field'
        ];
    }
}
