<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePermissionRequest extends FormRequest
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
              'name' => 'required|unique:permissions|max:40',
            ];
          }
        case 'PUT':
        case 'PATCH':
        {
          return [
            'name' => 'required|max:40',
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
      'name.unique' => 'El permiso debe ser único. Este permiso ya existe en nuestra  BBDD.',
      'name.max' => 'El nombre no debe superar los 40 caracteres.',
    ];
  }
}