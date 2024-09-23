<?php

namespace App\Http\Requests\Liquidacion;

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
            'observaciones' => 'nullable|string|min:3',
            'chofer_id' => 'required|exists:chofers,id',
            'fecha' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'observaciones.min' => 'Las observaciones deben tener comi minimo :min caracteres.',
            'fecha.required' => 'La fecha es obligatoria.',
            'fecha.date' => 'La fecha debe ser una fecha válida.',
            'chofer_id.required' => 'El chofer es obligatorio.',
            'chofer_id.exists' => 'El chofer seleccionado no es válido.',
        ];
    }
}
