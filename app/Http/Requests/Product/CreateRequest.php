<?php

namespace App\Http\Requests\Product;

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
            'brand_id' => 'required',
            'name' => 'required',
            'short_description' => 'required',
            'country_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'brand_id.required' => 'Please select brand',
            'name.required' => 'Please enter name',
            'short_description.required' => 'Please enter short_description',
            'country_id.required' => 'Please select country'
        ];
    }
}
