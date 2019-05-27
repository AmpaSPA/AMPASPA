<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateActaRequest extends FormRequest
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
                    'documento_acta' => 'required|mimes:pdf|max:2048'
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
            'documento_acta.required' => 'No has seleccionado ningun fichero.',
            'documento_acta.mimes' => 'El fichero seleccionado debe ser un documento pdf.',
            'documento_acta.max' => 'El documento excede de 2Gb'
        ];
    }
}
