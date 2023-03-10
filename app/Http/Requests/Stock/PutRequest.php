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

    protected function prepareForValidation()
    {
        /*Como en el request no pasaremos 'product_id', preparamos los datos
        obteniendolos de la ruta que hace este request*/
        $this->merge(['product_id' => $this->route('stock')->product_id]);
    }

    public function rules()
    {
        return [
            'product_id' => 'required|unique:stocks,product_id,'.$this->route('stock')->id,
            'quantity' => 'required|numeric|min:0',
        ];
    }
}
