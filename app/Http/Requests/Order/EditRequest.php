<?php

namespace App\Http\Requests\Order;

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
            'user_id' => 'required',
            // 'shipping_address_id' => 'required',
            // 'billing_address_id' => 'required',
            // 'currency_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Please enter user',
            // 'shipping_address_id.required' => 'Please enter shipping address',
            // 'billing_address_id.required' => 'Please enter billing address',
            // 'currency_id.required' => 'Please enter currency',
        ];
    }
}
