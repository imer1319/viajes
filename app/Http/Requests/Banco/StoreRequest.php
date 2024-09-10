<?php

namespace App\Http\Requests\Banco;

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
            'descripcion' => 'required|string|max:255',
            'domicilio' => 'nullable|string|max:255',
            'saldo' => 'required|numeric|min:0',
            'numero_cuenta' => 'required|string|max:20|regex:/^[0-9]+$/',
            'cbu' => 'required|string|size:22|regex:/^[0-9]+$/',
            'alias' => 'nullable|string|max:20',
        ];
    }

    public function messages()
    {
        return [
            'descripcion.required' => 'La descripción es obligatoria.',
            'descripcion.string' => 'La descripción debe ser un texto.',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres.',
            'domicilio.string' => 'El domicilio debe ser un texto.',
            'domicilio.max' => 'El domicilio no puede tener más de 255 caracteres.',
            'saldo.required' => 'El saldo es obligatorio.',
            'saldo.numeric' => 'El saldo debe ser un número.',
            'saldo.min' => 'El saldo no puede ser negativo.',
            'numero_cuenta.required' => 'El número de cuenta es obligatorio.',
            'numero_cuenta.string' => 'El número de cuenta debe ser un texto.',
            'numero_cuenta.max' => 'El número de cuenta no puede tener más de 20 caracteres.',
            'numero_cuenta.regex' => 'El número de cuenta solo puede contener números.',
            'cbu.required' => 'El CBU es obligatorio.',
            'cbu.string' => 'El CBU debe ser un texto.',
            'cbu.size' => 'El CBU debe tener exactamente 22 caracteres.',
            'cbu.regex' => 'El CBU solo puede contener números.',
            'alias.string' => 'El alias debe ser un texto.',
            'alias.max' => 'El alias no puede tener más de 20 caracteres.',
        ];
    }
}
