<?php

namespace App\Http\Requests\Recibo;

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
            'numero_interno' => 'required|integer|min:1',
            'observaciones' => 'nullable|string',
            'saldo_total' => 'required|numeric|min:0',
            'total_recibo' => 'required|numeric|min:0',
            'facturas' => 'required|array',
            'formaPagos' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.integer' => 'El cliente debe ser un número entero.',
            'cliente_id.exists' => 'El cliente seleccionado no existe.',
            'numero_interno.required' => 'El número interno es obligatorio.',
            'numero_interno.integer' => 'El número interno debe ser un número entero.',
            'numero_interno.min' => 'El número interno debe ser al menos 1.',
            'saldo_total.required' => 'El saldo total es obligatorio.',
            'saldo_total.numeric' => 'El saldo total debe ser un número.',
            'saldo_total.min' => 'El saldo total no puede ser negativo.',
            'total_recibo.required' => 'El total del recibo es obligatorio.',
            'total_recibo.numeric' => 'El total del recibo debe ser un número.',
            'total_recibo.min' => 'El total del recibo no puede ser negativo.',
            'facturas.required' => 'Debe proporcionar al menos una factura.',
            'facturas.array' => 'El campo facturas debe ser un array.',
            'formaPagos.required' => 'Debe proporcionar al menos una forma de pago.',
            'formaPagos.array' => 'El campo formaPagos debe ser un array.',
        ];
    }
}
