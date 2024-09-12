<?php

namespace App\Http\Requests\Recibo;

use Illuminate\Foundation\Http\FormRequest;

class FormaPagosRequest extends FormRequest
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
            'formaPagos' => 'required|array|min:1',
            'monto_faltante' => 'required|numeric|in:0',
        ];
    }

    public function messages()
{
    return [
        'formaPagos.required' => 'Las formas de pago son obligatorias.',
        'formaPagos.array' => 'Las formas de pago deben estar en un formato de lista.',
        'formaPagos.min' => 'Debe agregar al menos una forma de pago.',

        'monto_faltante.required' => 'El campo monto faltante es obligatorio.',
        'monto_faltante.numeric' => 'El monto faltante debe ser un número.',
        'monto_faltante.in' => 'El monto faltante debe ser cero.',
    ];
}

}
