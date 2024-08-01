<?php

namespace App\Http\Requests\RetencionGanancias;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
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
            'codigo' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'minimo' => 'required|integer|min:0',
            'alicuota' => 'required|numeric|between:0,100',
            'codigo_retencion' => 'required|string|max:255',
            'codigo_afip' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'codigo.required' => 'El código es obligatorio.',
            'tipo.required' => 'El tipo es obligatorio.',
            'minimo.required' => 'El mínimo es obligatorio.',
            'minimo.integer' => 'El mínimo debe ser un número entero.',
            'alicuota.required' => 'La alícuota es obligatoria.',
            'alicuota.numeric' => 'La alícuota debe ser un número.',
            'alicuota.between' => 'La alícuota debe estar entre 0 y 100.',
            'codigo_retencion.required' => 'El código de retención es obligatorio.',
            'codigo_afip.required' => 'El código AFIP es obligatorio.',
        ];
    }
}
