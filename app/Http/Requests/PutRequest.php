<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Validation\Rule;
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

    /**
     * Reglas de validación:
     * quantity: requerido, mínimo valor 0.
     */
    public function rules()
    {
        return [
            'quantity' => 'required|min:0'
        ];
    }
}