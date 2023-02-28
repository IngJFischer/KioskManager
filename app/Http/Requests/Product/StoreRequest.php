<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        if ($this->expectsJson()) 
        {
            $response = new Response($validator->errors(), 422);
            throw new ValidationException($validator, $response);
        };

        parent::failedValidation($validator);
        
    }

    protected function prepareForValidation()
    {
        $this->merge(['name' => Str::title($this->name)]);
    }

    public function rules()
    {
        return [
            'name' => 'required|unique:products|min:2|max:75|',
            'description' => 'max:255',
            'barcode' => 'numeric|min_digits:10|max_digits:15',
            'list_price' => 'bail|required|decimal:2,3|min:0|not_in:0',
            'revenue' => 'required|numeric|min:0',
            'price' => 'required|numeric|min:0|not_in:0',
            'provider_id' => 'required|integer',
            'unit_sale' => 'required',
        ];
    }
}
