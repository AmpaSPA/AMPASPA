<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAvatarRequest extends FormRequest
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
                    'avatar' => 'required|image',
                ];
            }
            case 'PUT':
            case 'PATCH':
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
      'avatar.required' => 'No has seleccionado ningun fichero.',
      'avatar.image' => 'El fichero seleccionado no se corresponde con un formato válido de imagen.'
    ];
  }
}
