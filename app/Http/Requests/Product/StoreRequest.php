<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|unique|min:2|max:75|',
            'description' => 'max:255',
            'barcode' => 'numeric|min:10|max:15',
            'list_price' => '',
            'revenue' => '',
            'price' => '',
            'provider_id' => '',
            'unit_sale' => '',
        ];
    }
}
