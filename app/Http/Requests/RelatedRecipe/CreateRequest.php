<?php

namespace App\Http\Requests\RelatedRecipe;

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
            'recipe_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'recipe_id.required' => 'Please select recipe',
        ];
    }
}
