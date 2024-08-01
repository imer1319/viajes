<?php

namespace App\Http\Requests\RetencionIngresoBruto;

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
            'descripcion' => 'required|string|max:255',
            'porcentaje' => 'required|numeric|between:0,100'
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser una cadena de texto.',
            'descripcion.max' => 'La descripción no puede exceder los 255 caracteres.',
            'porcentaje.required' => 'El porcentaje es obligatorio.',
            'porcentaje.numeric' => 'El porcentaje debe ser un número.',
            'porcentaje.between' => 'El porcentaje debe estar entre 0 y 100.'
        ];
    }
}
