<?php

namespace App\Http\Requests\Factura;

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
            'condiciones_pago_id' => 'required|exists:condiciones_pagos,id',
            'numero_factura_1' => 'required|string',
            'numero_factura_2' => 'required|string',
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
            'condiciones_pago_id.required' => 'La condicion de pago es obligatoria.',
            'condiciones_pago_id.exists' => 'La condicion de pago seleccionada no es válido.',
            'numero_factura_1.required' => 'El número de factura 1 es obligatorio.',
            'numero_factura_1.string' => 'El número de factura 1 debe ser un texto.',
            'numero_factura_2.required' => 'El número de factura 2 es obligatorio.',
            'numero_factura_2.string' => 'El número de factura 2 debe ser un texto.',
        ];
    }
}
