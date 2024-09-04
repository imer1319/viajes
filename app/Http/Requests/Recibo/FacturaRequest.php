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
            'facturas' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'facturas.required' => 'Los facturas son obligatorios.',
            'facturas.array' => 'Los facturas deben ser un array.',
        ];
    }
}
