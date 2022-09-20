<?php

namespace App\Http\Requests\HeaderMenu;

use Illuminate\Foundation\Http\FormRequest;

class MenuRequest extends FormRequest
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

            'menu_type' => 'required',
        ];
    }

    public function messages()
    {
        return [

            'menu_type.required' => 'Please enter the menu_type',
        ];
    }
}
