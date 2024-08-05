<?php

namespace App\Http\Requests\CondicionIva;

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

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'codigo' => 'required|string|max:255|unique:condicion_ivas,codigo',
            'descripcion' => 'required|string|max:255',
        ];
    }
    
    public function messages()
    {
        return [
            'codigo.required' => 'El campo código es obligatorio.',
            'codigo.string' => 'El campo código debe ser una cadena de texto.',
            'codigo.max' => 'El campo código no debe superar los 255 caracteres.',
            'codigo.unique' => 'El campo código ya existe.',
            'descripcion.required' => 'El campo descripción es obligatorio.',
            'descripcion.string' => 'El campo descripción debe ser una cadena de texto.',
            'descripcion.max' => 'El campo descripción no debe superar los 255 caracteres.',
        ];
    }
}
