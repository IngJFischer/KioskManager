<?php

namespace App\Http\Requests\Product;

use Illuminate\Support\Str;
use Illuminate\Http\Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;

class PutRequest extends FormRequest
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
        $this->merge(['list_price' => number_format((float)$this->list_price, 2, '.', '')]);
    }

    public function rules()
    {
        return [
            'name' => 'required|min:2|max:75|unique:products,name,'.$this->route('product')->id,
            'description' => 'max:255',
            'barcode' => 'numeric|min:10|max:15',
            'list_price' => 'bail|required|decimal:2,3|min:0|not_in:0',
            'revenue' => 'required|numeric|min:0',
            'provider_id' => 'required|integer',
        ];
    }
}