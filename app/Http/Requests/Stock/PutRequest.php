<?php

namespace App\Http\Requests\Stock;

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

    public function rules()
    {
        return [
            'product_id' => 'required|unique:sotcks',
            'quantity' => 'required|min: 0',
        ];
    }
}
