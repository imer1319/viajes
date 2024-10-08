<?php

namespace App\Http\Requests\Chofer;

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
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'cuil' => 'required|string|max:20|unique:chofers,cuil',
            'dni' => 'required|string|max:20|unique:chofers,dni',
            'domicilio' => 'required|string|max:255',
            'email' => 'nullable|email|unique:chofers,email|max:255',
            'telefono' => 'required|string|max:20',
            'saldo' => 'required|numeric|min:0'
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'cuil.required' => 'El CUIL es obligatorio.',
            'cuil.unique' => 'El CUIL ya está registrado.',
            'dni.required' => 'El DNI es obligatorio.',
            'dni.unique' => 'El DNI ya está registrado.',
            'domicilio.required' => 'El domicilio es obligatorio.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'saldo.required' => 'El saldo es obligatorio.',
            'saldo.numeric' => 'El saldo debe ser un número.',
            'saldo.min' => 'El saldo debe ser al menos 0.'
        ];
    }
}
