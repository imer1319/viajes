<?php

namespace App\Http\Requests\Recibo;

use Illuminate\Foundation\Http\FormRequest;

class HeadRequest extends FormRequest
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
            'observaciones' => 'required|string|min:3',
            'cliente_id' => 'required|exists:clientes,id',
            'fecha' => 'required|date',
        ];
    }
    
    public function messages()
    {
        return [
            'observaciones.required' => 'Las observaciones son obligatorias.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente seleccionado no es válido.',
        ];
    }
}
