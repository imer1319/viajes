<?php

namespace App\Http\Requests\Liquidacion;

use Illuminate\Foundation\Http\FormRequest;

class GastoRequest extends FormRequest
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
            'gastos' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'gastos.required' => 'Los gastos son obligatorios.',
            'gastos.array' => 'Los gastos deben ser un array.',
        ];
    }
}
