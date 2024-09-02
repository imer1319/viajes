<?php

namespace App\Http\Requests\Liquidacion;

use Illuminate\Foundation\Http\FormRequest;

class AnticipoRequest extends FormRequest
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
            'anticipos' => 'required|array',
        ];
    }

    public function messages()
    {
        return [
            'anticipos.required' => 'Los anticipos son obligatorios.',
            'anticipos.array' => 'Los anticipos deben ser un array.',
        ];
    }
}
