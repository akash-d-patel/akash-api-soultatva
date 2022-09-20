<?php

namespace App\Http\Requests\SubProduct;

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
            'attribute_id' => 'required',
            'attribute_value_id' => 'required',
            'price' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'attribute_id.required' => 'Please enter attribute',
            'attribute_value_id.required' => 'Please enter attribute value',
            'price.required' => 'Please enter price',
        ];
    }
}
