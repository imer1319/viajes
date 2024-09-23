<?php

namespace App\Http\Requests\Factura;

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
            'cliente_id' => 'required|integer|exists:clientes,id',
            'numero_factura_1' => 'required|string|max:10',
            'numero_factura_2' => 'required|string|max:10',
            'numero_interno' => 'required|integer',
            'observaciones' => 'nullable|string|min:3',
            'condiciones_pago_id' => 'required|integer|exists:condiciones_pagos,id',
            'neto' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'saldo_total' => 'required|numeric|min:0',
            // movimientos
            'movimientos' => 'required|array',
            'movimientos.*.saldo_total' => 'required|numeric',
            'movimientos.*.chofer_id' => 'required|exists:chofers,id',
            'movimientos.*.fecha' => 'required|date',
        ];
    }

    public function messages()
    {
        return [
            'observaciones.min' => 'Las observaciones deben tener comi minimo :min caracteres.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'chofer_id.required' => 'El campo chofer es obligatorio.',
            'chofer_id.exists' => 'El chofer seleccionado no es válido.',
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
        ];
    }
}
