<?php

namespace App\Http\Requests\CategoryProduct;

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
            
            'category_id' => 'required',
            'product_id' => 'required',

        ];
    }

    public function messages()
    {
        return [

            'category_id.required' => 'Please select category',
            'product_id.required' => 'Please select product',
        ];
    }
}
