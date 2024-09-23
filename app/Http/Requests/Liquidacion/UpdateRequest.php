<?php

namespace App\Http\Requests\Liquidacion;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'fecha' => 'required|date',
            'chofer_id' => 'required|exists:chofers,id',
            'observaciones' => 'nullable|string',
            'total_liquidacion' => 'required|numeric',
            'numero_interno' => 'required|numeric',
            'movimientos' => 'required|array',
            'gastos' => 'required|array',
            'anticipos' => 'required|array',
            'formaPagos' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'chofer_id.required' => 'El campo chofer es obligatorio.',
            'chofer_id.exists' => 'El chofer seleccionado no es válido.',
            'total_liquidacion.required' => 'El total de la liquidación es obligatorio.',
            'total_liquidacion.numeric' => 'El total de la liquidación debe ser un número.',
            'numero_interno.required' => 'El número interno es obligatorio.',
            'numero_interno.numeric' => 'El número interno debe ser un número.',
            'movimientos.required' => 'Debe incluir al menos un movimiento.',
            'movimientos.required' => 'Los movimientos deben ser un array.',
            'gastos.required' => 'Debe incluir al menos un gasto.',
            'gastos.array' => 'Los gastos deben ser un array.',
            'anticipos.required' => 'Debe incluir al menos un anticipo.',
            'anticipos.array' => 'Los anticipos deben ser un array.',
            'formaPagos.required' => 'Debe proporcionar al menos una forma de pago.',
            'formaPagos.array' => 'Las formas de pago ser un array.',
        ];
    }
}
