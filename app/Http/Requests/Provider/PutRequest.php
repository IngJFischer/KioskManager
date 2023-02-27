<?php

namespace App\Http\Requests\Provider;

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
    }

    /**
     * Reglas de validación:
     * -Nombre: requerido, minimo 2, máximo 50 caracteres, único (exceptuando el que estamos modificando).
     */
    public function rules()
    {
        return [
            'name'=> 'required|min:2|max:50|unique:providers,name,'.$this->route('provider')->id,
        ];
    }
}
