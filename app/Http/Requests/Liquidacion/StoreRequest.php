<?php

namespace App\Http\Requests\Liquidacion;

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
            'fecha' => 'required|date',
            'chofer_id' => 'required|exists:chofers,id',
            'observaciones' => 'required|string',
            'total_liquidacion' => 'required|numeric',
            'numero_interno' => 'required|numeric',
            // movimientos
            'movimientos' => 'required|array',
            'movimientos.*.saldo_total' => 'required|numeric',
            'movimientos.*.chofer_id' => 'required|exists:chofers,id',
            'movimientos.*.fecha' => 'required|date',
            //gastos
            'gastos' => 'required|array',
            'gastos.*.importe' => 'required|numeric',
            'gastos.*.chofer_id' => 'required|exists:chofers,id',
            //anticipos
            'anticipos' => 'required|array',
            'anticipos.*.importe' => 'required|numeric',
            'anticipos.*.chofer_id' => 'required|exists:chofers,id',
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'chofer_id.required' => 'El campo chofer es obligatorio.',
            'chofer_id.exists' => 'El chofer seleccionado no es válido.',
            'observaciones.required' => 'Las observaciones son obligatorias.',
            'total_liquidacion.required' => 'El total de la liquidación es obligatorio.',
            'total_liquidacion.numeric' => 'El total de la liquidación debe ser un número.',
            'numero_interno.required' => 'El número interno es obligatorio.',
            'numero_interno.numeric' => 'El número interno debe ser un número.',
            'movimientos.required' => 'Debe incluir al menos un movimiento.',
            'movimientos.*.id.exists' => 'El movimiento no es válido.',
            'movimientos.*.saldo_total.required' => 'El saldo total del movimiento es obligatorio.',
            'movimientos.*.saldo_total.numeric' => 'El saldo total del movimiento debe ser un número.',
            'movimientos.*.chofer_id.required' => 'El chofer del movimiento es obligatorio.',
            'movimientos.*.chofer_id.exists' => 'El chofer del movimiento no es válido.',
            'movimientos.*.fecha.required' => 'La fecha del movimiento es obligatoria.',
            'movimientos.*.fecha.date' => 'La fecha del movimiento no tiene un formato válido.',
            'gastos.required' => 'Debe incluir al menos un gasto.',
            'gastos.*.id.exists' => 'El gasto no es válido.',
            'gastos.*.importe.required' => 'El importe del gasto es obligatorio.',
            'gastos.*.importe.numeric' => 'El importe del gasto debe ser un número.',
            'gastos.*.chofer_id.required' => 'El chofer del gasto es obligatorio.',
            'gastos.*.chofer_id.exists' => 'El chofer del gasto no es válido.',
            'anticipos.required' => 'Debe incluir al menos un anticipo.',
            'anticipos.*.id.exists' => 'El anticipo no es válido.',
            'anticipos.*.importe.required' => 'El importe del anticipo es obligatorio.',
            'anticipos.*.importe.numeric' => 'El importe del anticipo debe ser un número.',
            'anticipos.*.chofer_id.required' => 'El chofer del anticipo es obligatorio.',
            'anticipos.*.chofer_id.exists' => 'El chofer del anticipo no es válido.',
        ];
    }
}
