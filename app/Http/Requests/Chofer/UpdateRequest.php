<?php

namespace App\Http\Requests\Chofer;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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
            'nombre' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date',
            'cuil' => [
                'required',
                'string',
                'max:20',
                Rule::unique('chofers')->ignore($this->chofere->id)
            ],
            'dni' => [
                'required',
                'string',
                'max:20',
                Rule::unique('chofers')->ignore($this->chofere->id)
            ],
            'domicilio' => 'required|string|max:255',
            'email' =>  [
                'nullable',
                'string',
                'email',
                Rule::unique('chofers')->ignore($this->chofere->id)
            ],
            'telefono' => 'required|string|max:20',
            'saldo' => 'required|numeric'
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
        ];
    }
}
