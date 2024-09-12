<?php

namespace App\Http\Requests\Recibo;

use Illuminate\Foundation\Http\FormRequest;

class FormaPagoRequest extends FormRequest
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
        $rules = [
            'form_pago.forma_pago_id' => 'required|integer',
            'form_pago.importe' => 'required|numeric|min:1|max:' . $this->input('monto_faltante'),
        ];

        $forma_pago_id = $this->input('form_pago.forma_pago_id');

        if ($forma_pago_id == 1) {
            $rules = array_merge($rules, [
                'form_pago.banco_id' => 'required|integer|exists:bancos,id',
                'form_pago.fecha_emision' => 'required|date',
                'form_pago.fecha_vencimiento' => 'required|date|after_or_equal:form_pago.fecha_emision',
                'form_pago.numero' => 'required|string|max:255',
            ]);
        } elseif (in_array($forma_pago_id, [3, 4, 5, 6])) {
            $rules = array_merge($rules, [
                'form_pago.fecha_emision' => 'required|date',
                'form_pago.numero' => 'required|string|max:255',
            ]);
        }

        return $rules;
    }

    public function messages()
    {
        return [
            'form_pago.forma_pago_id.required' => 'La forma de pago es obligatoria.',
            'form_pago.forma_pago_id.exists' => 'La forma de pago seleccionada no es válida.',
            'form_pago.importe.required' => 'El importe es obligatorio.',
            'form_pago.importe.numeric' => 'El importe debe ser un número.',
            'form_pago.importe.min' => 'El importe debe ser al menos :min.',
            'form_pago.importe.max' => 'El importe no debe exceder :max.',
            'form_pago.importe.gt' => 'El importe debe ser mayor que 0.',
            'form_pago.fecha_emision.required' => 'La fecha de emisión es obligatoria.',
            'form_pago.fecha_emision.date' => 'La fecha de emisión debe ser una fecha válida.',
            'form_pago.fecha_emision.before_or_equal' => 'La fecha de emisión debe ser anterior o igual a la fecha de vencimiento.',
            'form_pago.fecha_vencimiento.required' => 'La fecha de vencimiento es obligatoria.',
            'form_pago.fecha_vencimiento.date' => 'La fecha de vencimiento debe ser una fecha válida.',
            'form_pago.fecha_vencimiento.after_or_equal' => 'La fecha de vencimiento debe ser posterior o igual a la fecha de emisión.',
        ];
    }
}
