<?php

namespace App\Http\Requests\Gasto;

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
            'numero_interno' => 'required|integer',
            'fecha' => 'required|date',
            'proveedor_id' => 'required|exists:proveedors,id',
            'importe' => 'required|numeric|min:0',
            'saldo' => 'required|numeric|min:0',
            'chofer_id' => 'required|exists:chofers,id',
            'flota_id' => 'required|exists:flotas,id',
            'detalle' => 'required|min:3|string',
            'tipo_gastos' => 'required|array',
        ];
    }
    
    public function messages()
    {
        return [
            'numero_interno.required' => 'El número interno es obligatorio.',
            'numero_interno.integer' => 'El número interno debe ser un número entero.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha no tiene un formato válido.',
            'proveedor_id.required' => 'El proveedor es obligatorio.',
            'proveedor_id.exists' => 'El proveedor seleccionado no es válido.',
            'importe.required' => 'El importe es obligatorio.',
            'importe.numeric' => 'El importe debe ser un número.',
            'importe.min' => 'El importe debe ser mayor o igual a 0.',
            'saldo.required' => 'El saldo es obligatorio.',
            'saldo.numeric' => 'El saldo debe ser un número.',
            'saldo.min' => 'El saldo debe ser mayor o igual a 0.',
            'chofer_id.required' => 'El chofer es obligatorio.',
            'chofer_id.exists' => 'El chofer seleccionado no es válido.',
            'flota_id.required' => 'La flota es obligatoria.',
            'flota_id.exists' => 'La flota seleccionada no es válida.',
            'detalle.required' => 'El detalle es obligatorio.',
            'detalle.min' => 'El detalle debe ser mayor o igual a 3 caracteres.',
            'tipo_gastos.required' => 'Los tipos de gasto son obligatorio',
            'tipo_gastos.array' => 'Los tipos de gasto deben ser un array',
        ];
    }
}
