<?php

namespace App\Http\Requests\InventoryHistory;

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
            'inventory_id' => 'required',
            'order_id' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'inventory_id.required' => 'Please enter inventory',
            'order_id.required' => 'Please enter order',
        ];
    }
}
