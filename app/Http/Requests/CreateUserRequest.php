<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
      switch($this->method())
      {
        case 'GET':
        case 'DELETE':
        case 'POST':
        {
          return [
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'telefono' => 'required|max:9|regex:/^[0-9]+$/',
            'doctype_id' => 'required',
            'numdoc' => 'required|max:9|regex:/^[0-9a-zA-Z]+$/',
            'membertype_id' => 'required',
            'paymenttype_id' => 'required',
            'email' => 'required|email|unique:users,email',
          ];
        }
        case 'PUT':
        case 'PATCH':
        {
          return [
            'nombre' => 'required|max:255',
            'apellidos' => 'required|max:255',
            'telefono' => 'required|max:9|regex:/^[0-9]+$/',
            'doctype_id' => 'required',
            'numdoc' => 'required|max:9|regex:/^[0-9a-zA-Z]+$/',
            'membertype_id' => 'required',
            'paymenttype_id' => 'required',
          ];
        }
        default:break;
      }

      return [ ];
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
      'membertype_id.required' => 'El tipo de socio es obligatorio.',
      'paymenttype_id.required' => 'El tipo de pago es obligatorio',
      'email.required' => 'El correo electrónico es obligatorio.',
      'email.email' => 'El correo electrónico no es una dirección de correo válida.',
      'email.unique' => 'Ya existe un socio registrado con esa misma dirección de correo electrónico.',
      'password.required' => 'La contraseña es obligatoria.',
      'password.min' => 'La contraseña debe contener al menos 6 caracteres.',
      'password.confirmed' => 'La confirmación de contraseña no ha coincidido.',
    ];
  }
}
