<?php

namespace App\Http\Requests\OrderAddress;

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
            'user_id' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'order_id' => 'required',
            'address1' => 'required',
            'zip_code' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Please enter user',
            'country_id.required' => 'Please enter country',
            'state_id.required' => 'Please enter state',
            'city_id.required' => 'Please enter city',
            'order_id.required' => 'Please enter city',
            'address1.required' => 'Please enter address1',
            'zip_code.required' => 'Please enter zip code',
        ];
    }
}
