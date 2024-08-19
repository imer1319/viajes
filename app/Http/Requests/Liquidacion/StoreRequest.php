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
            'observaciones' => 'nullable|string',
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
}
