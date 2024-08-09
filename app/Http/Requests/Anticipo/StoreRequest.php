<?php

namespace App\Http\Requests\Anticipo;

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
            'numero_interno' => 'required|integer|min:1',
            'fecha' => 'required|date',
            'chofer_id' => 'required|exists:chofers,id',
            'importe' => 'required|numeric|min:0',
            'saldo' => 'required|numeric|min:0',
        ];
    }

    public function messages()
    {
        return [
            'numero_interno.required' => 'El número interno es obligatorio.',
            'numero_interno.integer' => 'El número interno debe ser un número entero.',
            'numero_interno.min' => 'El número interno debe ser al menos 1.',

            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',

            'chofer_id.required' => 'El chofer es obligatorio.',
            'chofer_id.exists' => 'El chofer seleccionado no existe en la base de datos.',

            'importe.required' => 'El importe es obligatorio.',
            'importe.numeric' => 'El importe debe ser un número.',
            'importe.min' => 'El importe no puede ser negativo.',

            'saldo.required' => 'El saldo es obligatorio.',
            'saldo.numeric' => 'El saldo debe ser un número.',
            'saldo.min' => 'El saldo no puede ser negativo.',
        ];
    }
}
