<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFacturaRequest extends FormRequest
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
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
            case 'POST':
                return [
                    'documento' => 'required|mimes:pdf|max:2048'
                ];
            case 'PUT':
            case 'PATCH':
            default:
                break;
        }
        return [];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'documento.required' => 'No has seleccionado ningun fichero.',
            'documento.mimes' => 'El fichero seleccionado debe ser un documento pdf.',
            'documento.max' => 'El documento excede de 2Gb'
        ];
    }
}
