<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDataSocioRequest extends FormRequest
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
          'nombre' => 'required|max:255',
          'apellidos' => 'required|max:255',
          'telefono' => 'required|max:9|regex:/^[0-9]+$/',
          'doctype_id' => 'required',
          'numdoc' => 'required|max:9|regex:/^[0-9a-zA-Z]+$/',
          'paymenttype_id' => 'required',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
          'nombre.required' => 'El nombre es obligatorio.',
          'nombre.max' => 'El nombre no debe superar los 255 caracteres.',
          'apellidos.required' => 'Al menos un apellido es obligatorio. Recomendado introducir ambos apellidos.',
          'apellidos.max' => 'Los apellidos no deben superar los 255 caracteres.',
          'telefono.required' => 'El teléfono es obligatorio.',
          'telefono.max' => 'El teléfono no debe superar los 9 caracteres.',
          'telefono.regex' => 'El formato del teléfono es incorrecto.',
          'doctype_id.required' => 'El tipo de documento es obligatorio.',
          'numdoc.required' => 'El número de documento es obligatorio.',
          'numdoc.regex' => 'El formato del número de documento es incorrecto.',
          'numdoc.max' => 'El número de documento no debe superar los 9 caracteres.',
          'paymenttype_id.required' => 'El tipo de pago es obligatorio',
        ];
    }
}
