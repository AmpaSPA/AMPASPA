<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportCsvFileRequest extends FormRequest
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
            'csvfile' => 'required|mimes:csv,txt',
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
      'csvfile.required' => 'No has seleccionado ningún fichero que contenga la lista de socios a importar.',
      'csvfile.mimetypes' => 'El fichero seleccionado debe ser un fichero con extensión CSV.'
    ];
  }
}
