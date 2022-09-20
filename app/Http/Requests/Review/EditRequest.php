<?php

namespace App\Http\Requests\Review;

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
            'content' => 'required',
            'rate' => 'required'



        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'content.required' => 'Please enter content',
            'rate.required' => 'Please enter rating'

        ];
    }
}
