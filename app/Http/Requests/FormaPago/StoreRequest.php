<?php

namespace App\Http\Requests\FormaPago;

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
            'abreviacion' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'El campo descripcion es obligatorio.',
            'descripcion.string' => 'El campo descripcion debe ser una cadena de texto.',
            'descripcion.max' => 'El campo descripcion no debe exceder :max caracteres.',
            'abreviacion.required' => 'El campo abreviacion es obligatorio.',
            'abreviacion.string' => 'El campo abreviacion debe ser una cadena de texto.',
            'abreviacion.max' => 'El campo abreviacion no debe exceder :max caracteres.',
        ];
    }
}
