<?php

namespace App\Http\Requests\Flota;

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
            'placa' => [
                'required',
                'string',
                'max:20',
                Rule::unique('flotas')->ignore($this->flota->id)
            ],
            'marca' => 'required|string|max:255',
            'anio' => 'required|integer|min:1886|max:' . date('Y'),
            'kilometraje' => 'required|integer|min:0',
            'identificacion' => [
                'required',
                'string',
                'max:255',
                Rule::unique('flotas')->ignore($this->flota->id)
            ],
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'placa.required' => 'La placa es obligatoria.',
            'placa.unique' => 'La placa ya está en uso.',
            'marca.required' => 'La marca es obligatoria.',
            'anio.required' => 'El año es obligatorio.',
            'anio.integer' => 'El año debe ser un número entero.',
            'anio.min' => 'El año debe ser mayor o igual a 1886.',
            'anio.max' => 'El año no puede ser mayor al año actual.',
            'kilometraje.required' => 'El kilometraje es obligatorio.',
            'kilometraje.integer' => 'El kilometraje debe ser un número entero.',
            'kilometraje.min' => 'El kilometraje debe ser mayor o igual a 0.',
            'identificacion.required' => 'La identificación es obligatoria.',
            'identificacion.unique' => 'La identificación ya está en uso.',
        ];
    }
}
