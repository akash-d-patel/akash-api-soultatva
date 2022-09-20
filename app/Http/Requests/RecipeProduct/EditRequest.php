<?php

namespace App\Http\Requests\RecipeProduct;

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
            
            'recipe_id' => 'required',
            'product_id' => 'required',

        ];
    }

    public function messages()
    {
        return [

            'recipe_id.required' => 'Please select recipe',
            'product_id.required' => 'Please select product',
        ];
    }
}