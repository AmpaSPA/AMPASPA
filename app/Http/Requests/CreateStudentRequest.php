<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateStudentRequest extends FormRequest
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
            'anionacim' => 'required|numeric|between:1999,2050',
          ];
        }
        case 'PUT':
        case 'PATCH':
      {
        return [
          'nombre' => 'required|max:255',
          'anionacim' => 'required|numeric|between:1999,2050',
          'course_id' => 'required',
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
      'nombre.required' => 'El nombre completo es obligatorio.',
      'nombre.max' => 'El nombre completo no debe superar los 255 caracteres.',
      'anionacim.required'  => 'El año de nacimiento es obligatorio.',
      'anionacim.numeric' => 'El año de nacimiento debe ser numérico.',
      'anionacim.between' => 'El año de nacimiento tiene que estar entre 1999 - 2050.',
      'course_id.required' => 'El curso es obligatorio.',
    ];
  }
}
