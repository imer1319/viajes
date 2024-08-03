<?php

namespace App\Http\Requests\CondicionesPago;

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
            'condicion' => ['required', 'string'],
            'dias' => ['required', 'numeric'],
        ];
    }

    public function messages()
    {
        return [
            'condicion.required' => 'El campo condicion es obligatorio.',
            'condicion.string' => 'El campo condicion debe ser una cadena de texto.',
            'condicion.max' => 'El campo condicion no debe exceder :max caracteres.',
            'dias.required' => 'El campo dias es obligatorio.',
            'dias.numeric' => 'El campo dias debe ser numerico.',
        ];
    }
}
