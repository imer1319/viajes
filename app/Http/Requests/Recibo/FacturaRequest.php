<?php

namespace App\Http\Requests\Recibo;

use Illuminate\Foundation\Http\FormRequest;

class FacturaRequest extends FormRequest
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
            'form.total_recibo' => ['required', 'numeric', 'min:0'],
            'form.facturas' => ['required', 'array'],
            'form.saldo_total' => [
                'required',
                'numeric',
                'min:1',
                function ($attribute, $value, $fail) {
                    if ($value < $this->input('form.total_recibo')) {
                        $fail('El total de la factura debe ser menor o igual que el total del saldo de las facturas.');
                    }
                },
            ],
            'form.facturas.*.saldo_total' => 'required|numeric|min:0',
            'form.facturas.*.numero_factura_1' => 'required|string|size:4',
            'form.facturas.*.numero_factura_2' => 'required|string|size:8',
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $facturas = $this->input('form.facturas', []);
            foreach ($facturas as $index => &$factura) {
                if (!isset($factura['pago']) || is_null($factura['pago'])) {
                    $factura['pago'] = 0;
                }
                if ($factura['saldo_total'] < $factura['pago']) {
                    $validator->errors()->add(
                        "facturas.{$index}.pago",
                        "El pago no puede ser mayor que el saldo para la factura con número {$factura['numero_factura_1']}-{$factura['numero_factura_2']}."
                    );
                }
                if ($factura['pago'] <= 0) {
                    $validator->errors()->add(
                        "facturas.{$index}.pago",
                        "El pago para la factura con número {$factura['numero_factura_1']}-{$factura['numero_factura_2']} no puede ser 0."
                    );
                }
            }
            $this->merge(['form' => ['facturas' => $facturas]]);
        });
    }

    public function messages()
    {
        return [
            'form.total_saldo.required' => 'El campo total de saldo es obligatorio.',
            'form.total_saldo.numeric' => 'El total de saldo debe ser un número.',
            'form.facturas.required' => 'El campo facturas es obligatorio.',
            'form.facturas.array' => 'El campo facturas debe ser un arreglo.',
            'form.total_pagado.required' => 'El total de pago es obligatorio.',
            'form.total_pagado.numeric' => 'El total de pago debe ser un número.',
            'form.total_pagado.min' => 'El total de pago no puede ser menor a 1.',
        ];
    }
}
