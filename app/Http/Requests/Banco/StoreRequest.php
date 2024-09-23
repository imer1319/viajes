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
            'descripcion' => 'required|string|unique:bancos,descripcion',
            'domicilio' => 'required|string',
            'saldo' => 'nullable|numeric|min:0',
            'numero_cuenta' => 'required|string|unique:bancos,numero_cuenta',
            'cbu' => 'required|string|unique:bancos,cbu',
            'alias' => 'required|string|unique:bancos,alias',
        ];
    }


    public function messages()
    {
        return [
            'descripcion.required' => 'La descripción del banco es obligatoria.',
            'descripcion.unique' => 'La descripción ingresada ya existe en el sistema.',

            'domicilio.required' => 'El domicilio del banco es obligatorio.',

            'saldo.numeric' => 'El saldo debe ser un número.',
            'saldo.min' => 'El saldo no puede ser un valor negativo.',

            'numero_cuenta.required' => 'El número de cuenta es obligatorio.',
            'numero_cuenta.unique' => 'El número de cuenta ingresado ya existe.',

            'cbu.required' => 'El CBU es obligatorio.',
            'cbu.unique' => 'El CBU ingresado ya existe.',

            'alias.required' => 'El alias es obligatorio.',
            'alias.unique' => 'El alias ingresado ya existe.',
        ];
    }
}
