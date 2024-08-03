<?php

namespace App\Http\Requests\TipoComprobante;

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
            'codigo' => 'required|string|max:255|unique:tipo_comprobantes,codigo',
            'descripcion' => 'required|string|max:255',
            'liquida_iva' => 'required|boolean',
            'emite' => 'required|boolean',
            'recibe' => 'required|boolean',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El campo codigo es obligatorio.',
            'codigo.string' => 'El campo codigo debe ser una cadena de texto.',
            'codigo.max' => 'El campo codigo no debe exceder :max caracteres.',
            'codigo.unique' => 'El código ya existe en la base de datos.',
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'descripcion.string' => 'El campo descripcion debe ser una cadena de texto.',
            'descripcion.max' => 'El campo descripcion no debe exceder :max caracteres.',
            'liquida_iva.required' => 'El campo liquidacion IVA es obligatorio.',
            'liquida_iva.boolean' => 'El campo liquidacion IVA debe ser verdadero o falso.',
            'emite.required' => 'El campo emite es obligatorio.',
            'emite.boolean' => 'El campo emite debe ser verdadero o falso.',
            'recibe.required' => 'El campo recibe es obligatorio.',
            'recibe.boolean' => 'El campo recibe debe ser verdadero o falso.',
        ];
    }
}
