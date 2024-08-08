<?php

namespace App\Http\Requests\Proveedor;

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
            'razon_social' => 'required|string|max:255',
            'domicilio' => 'required|string|max:255',
            'cuit' => 'required|string|max:20|unique:clientes,cuit',
            'numero_ingreso_bruto' => 'required|numeric',
            'condicion_iva_id' => 'required|exists:condicion_ivas,id',
            'telefono' => 'required|string|max:20',
            'celular' => 'nullable|string|max:20',
            'provincia_id' => 'required|exists:provincias,id',
            'departamento_id' => 'required|exists:departamentos,id',
            'localidad_id' => 'required|exists:localidades,id',
            'codigo_postal' => 'required|string|max:10',
            'email' => 'nullable|email|max:255|unique:clientes,email',
            'contacto' => 'required|string|max:255',
            'retencion_ganancia_id' => 'required|exists:retencion_ganancias,id',
            'retencion_ingreso_bruto_id' => 'required|exists:retencion_ingresos_brutos,id',
            'plan_cuenta_id' => 'required|exists:plan_cuentas,id',
            'saldo' => 'required|numeric',
            'estado' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'razon_social.required' => 'La razón social es obligatoria.',
            'razon_social.string' => 'La razón social debe ser una cadena de texto.',
            'razon_social.max' => 'La razón social no debe exceder los 255 caracteres.',

            'domicilio.required' => 'El domicilio es obligatorio.',
            'domicilio.string' => 'El domicilio debe ser una cadena de texto.',
            'domicilio.max' => 'El domicilio no debe exceder los 255 caracteres.',

            'cuit.required' => 'El CUIT es obligatorio.',
            'cuit.string' => 'El CUIT debe ser una cadena de texto.',
            'cuit.max' => 'El CUIT no debe exceder los 20 caracteres.',
            'cuit.unique' => 'El CUIT ya está registrado.',

            'numero_ingreso_bruto.required' => 'El número de ingreso bruto es obligatorio.',
            'numero_ingreso_bruto.numeric' => 'El número de ingreso bruto debe ser un número.',

            'condicion_iva_id.required' => 'La condición de IVA es obligatoria.',
            'condicion_iva_id.exists' => 'La condición de IVA seleccionada no es válida.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.string' => 'El teléfono debe ser una cadena de texto.',
            'telefono.max' => 'El teléfono no debe exceder los 20 caracteres.',

            'celular.string' => 'El celular debe ser una cadena de texto.',
            'celular.max' => 'El celular no debe exceder los 20 caracteres.',

            'provincia_id.required' => 'La provincia es obligatoria.',
            'provincia_id.exists' => 'La provincia seleccionada no es válida.',

            'departamento_id.required' => 'El departamento es obligatorio.',
            'departamento_id.exists' => 'El departamento seleccionado no es válido.',

            'localidad_id.required' => 'La localidad es obligatoria.',
            'localidad_id.exists' => 'La localidad seleccionada no es válida.',

            'plan_cuenta_id.required' => 'El plan de cuenta es obligatoria.',
            'plan_cuenta_id.exists' => 'El plan de cuenta seleccionada no es válida.',

            'codigo_postal.required' => 'El código postal es obligatorio.',
            'codigo_postal.string' => 'El código postal debe ser una cadena de texto.',
            'codigo_postal.max' => 'El código postal no debe exceder los 10 caracteres.',

            'email.email' => 'El correo electrónico debe ser una dirección de correo válida.',
            'email.max' => 'El correo electrónico no debe exceder los 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado.',

            'contacto.required' => 'El contacto es obligatorio.',
            'contacto.string' => 'El contacto debe ser una cadena de texto.',
            'contacto.max' => 'El contacto no debe exceder los 255 caracteres.',

            'retencion_ganancia_id.required' => 'La retención de ganancias es obligatoria.',
            'retencion_ganancia_id.exists' => 'La retención de ganancias seleccionada no es válida.',

            'retencion_ingreso_bruto_id.required' => 'La retención de ingresos brutos es obligatoria.',
            'retencion_ingreso_bruto_id.exists' => 'La retención de ingresos brutos seleccionada no es válida.',

            'tipo_documento_id.required' => 'El tipo de documento es obligatorio.',
            'tipo_documento_id.exists' => 'El tipo de documento seleccionado no es válido.',

            'numero_documento.required' => 'El número de documento es obligatorio.',
            'numero_documento.string' => 'El número de documento debe ser una cadena de texto.',
            'numero_documento.max' => 'El número de documento no debe exceder los 20 caracteres.',

            'estado.required' => 'El estado es obligatorio.',
            'estado.in' => 'El estado debe ser ACTIVO o INACTIVO.',
        ];
    }
}
