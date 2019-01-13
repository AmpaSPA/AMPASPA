<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
              'name'=>'required|unique:roles|max:15',
              'permissions' =>'required',
            ];
          }
        case 'PUT':
        case 'PATCH':
          {
            return [
              'name' => 'required|max:15',
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
      'name.required' => 'El nombre es obligatorio.',
      'name.max' => 'El nombre no debe superar los 15 caracteres.',
      'name.unique' => 'El rol debe ser único. Este rol ya existe en nuestra  BBDD.',
      'permissions.required' => 'Debe seleccionar al menos un permiso para el rol.',
    ];
  }
}
