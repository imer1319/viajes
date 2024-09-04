<?php

namespace App\Http\Requests\Movimiento;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'numero_interno' => 'required|integer',
            'fecha' => 'required|date',
            'cliente_id' => 'required|exists:clientes,id',
            'tipo_viaje_id' => 'required|exists:tipo_viajes,id',
            'detalle' => 'required|string',
            'numero_factura_1' => 'required|string|size:4',
            'numero_factura_2' => [
                'required',
                'string',
                'size:8',
                Rule::unique('movimientos')
                    ->where(function ($query) {
                        return $query->where('numero_factura_1', $this->numero_factura_1);
                    }),
            ],
            'precio_real' => 'required|numeric|min:0',
            'iva' => 'required|numeric|min:0',
            'total' => 'required|numeric|min:0',
            'saldo_total' => 'required|numeric|min:0',
            'flota_id' => 'required|exists:flotas,id',
            'chofer_id' => 'required|exists:chofers,id',
            'precio_chofer' => 'required|numeric|min:0',
            'porcentaje_pago' => 'required|integer|min:0|max:100',
            'comision_chofer' => 'required|numeric|min:0',
            'saldo_comision_chofer' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'numero_interno.required' => 'El número interno es obligatorio.',
            'numero_interno.integer' => 'El número interno debe ser un número entero.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'cliente_id.required' => 'El cliente es obligatorio.',
            'cliente_id.exists' => 'El cliente seleccionado no es válido.',
            'tipo_viaje_id.required' => 'El tipo de viaje es obligatorio.',
            'tipo_viaje_id.exists' => 'El tipo de viaje seleccionado no es válido.',
            'detalle.required' => 'El detalle es obligatorio.',
            'detalle.string' => 'El detalle debe ser un texto.',
            'numero_factura_1.required' => 'El número de factura 1 es obligatorio.',
            'numero_factura_1.string' => 'El número de factura 1 debe ser un texto.',
            'numero_factura_2.required' => 'El número de factura 2 es obligatorio.',
            'numero_factura_2.string' => 'El número de factura 2 debe ser un texto.',
            'numero_factura_2.unique' => 'Este numero ya ha sido registrado.',
            'precio_real.required' => 'El precio real es obligatorio.',
            'precio_real.numeric' => 'El precio real debe ser un número.',
            'precio_real.min' => 'El precio real debe ser mayor o igual a 0.',
            'iva.required' => 'El IVA es obligatorio.',
            'iva.numeric' => 'El IVA debe ser un número.',
            'iva.min' => 'El IVA debe ser mayor o igual a 0.',
            'total.required' => 'El total es obligatorio.',
            'total.numeric' => 'El total debe ser un número.',
            'total.min' => 'El total debe ser mayor o igual a 0.',
            'saldo_total.required' => 'El saldo total es obligatorio.',
            'saldo_total.numeric' => 'El saldo total debe ser un número.',
            'saldo_total.min' => 'El saldo total debe ser mayor o igual a 0.',
            'flota_id.required' => 'La flota es obligatoria.',
            'flota_id.exists' => 'La flota seleccionada no es válida.',
            'chofer_id.required' => 'El chofer es obligatorio.',
            'chofer_id.exists' => 'El chofer seleccionado no es válido.',
            'precio_chofer.required' => 'El precio del chofer es obligatorio.',
            'precio_chofer.numeric' => 'El precio del chofer debe ser un número.',
            'precio_chofer.min' => 'El precio del chofer debe ser mayor o igual a 0.',
            'porcentaje_pago.required' => 'El porcentaje de pago es obligatorio.',
            'porcentaje_pago.integer' => 'El porcentaje de pago debe ser un número entero.',
            'porcentaje_pago.min' => 'El porcentaje de pago debe ser mayor o igual a 0.',
            'porcentaje_pago.max' => 'El porcentaje de pago debe ser menor o igual a 100.',
            'comision_chofer.required' => 'La comisión del chofer es obligatoria.',
            'comision_chofer.numeric' => 'La comisión del chofer debe ser un número.',
            'comision_chofer.min' => 'La comisión del chofer debe ser mayor o igual a 0.',
            'saldo_comision_chofer.required' => 'El saldo de la comisión del chofer es obligatorio.',
            'saldo_comision_chofer.numeric' => 'El saldo de la comisión del chofer debe ser un número.',
            'saldo_comision_chofer.min' => 'El saldo de la comisión del chofer debe ser mayor o igual a 0.'
        ];
    }
}
