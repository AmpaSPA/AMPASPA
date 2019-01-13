<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFirmaRequest extends FormRequest
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
          'firma' => 'required|mimetypes:application/pdf',
        ];
      }
        case 'PUT':
        case 'PATCH':
        default:break;
      }
      return [];
    }

  /**
   * @return array
   */
  public function messages()
  {
    return [
      'firma.required' => 'No has seleccionado ningún fichero que contenga el documento de adhesión.',
      'firma.mimetypes' => 'El fichero seleccionado debe ser un documento pdf.'
    ];
  }
}
