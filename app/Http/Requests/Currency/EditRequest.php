<?php

namespace App\Http\Requests\Currency;

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
            'code' => "required|unique:currencies,code,{$this->currency->id}",
            'symbol' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'code.required' => 'Please enter code',
            'symbol.required' => 'Please enter symbol',
        ];
    }
}
