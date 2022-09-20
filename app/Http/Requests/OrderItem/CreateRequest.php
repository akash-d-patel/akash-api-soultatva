<?php

namespace App\Http\Requests\OrderItem;

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
            'order_id' => 'required',
            'product_id' => 'required',
            'sub_product_id' => 'required',
            'quantity' => 'required',
            'amount' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_id.required' => 'Please enter user',
            'order_id.required' => 'Please enter order',
            'product_id.required' => 'Please enter product',
            'sub_product_id.required' => 'Please enter sub product',
            'quantity.required' => 'Please enter quantity',
            'amount.required' => 'Please enter amount',
        ];
    }
}
