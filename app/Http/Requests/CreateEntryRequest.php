<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateEntryRequest extends FormRequest
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
                    'entrytype_id' => 'required',
                    'descripcion' => 'required|max:500',
                    'invoice_id' => 'required'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'entrytype_id' => 'required',
                    'descripcion' => 'required|max:500',
                    'invoice_id' => 'required'
                ];
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
            'descripcion.required' => 'La descripción del movimiento es obligatoria.',
            'descripcion.max' => 'La descripción del movimiento no puede exceder de 500 caracteres.',
            'entrytype_id.required' => 'Un tipo de movimiento es obligatorio',
            'invoice_id.required' => 'Un número de factura es obligatorio'
        ];
    }
}
