<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateInvoiceRequest extends FormRequest
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
                    'fecha' => 'required|date_format:Y-m-d|before:today',
                    'emisor' => 'required|max:255',
                    'destinatario' => 'required|max:255',
                    'concepto' => 'required|max:255',
                    'importe' => 'required|numeric'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'fecha' => 'required|date_format:Y-m-d|before:today',
                    'emisor' => 'required|max:255',
                    'destinatario' => 'required|max:255',
                    'concepto' => 'required|max:255',
                    'importe' => 'required|numeric'
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
            'fecha.required' => 'La fecha de la factura es obligatoria.',
            'fecha.date_format' => 'La fecha de la factura debe tener el formato AAAA-MM-DD.',
            'fecha.before' => 'La fecha de la factura debe ser una fecha anterior a hoy.',
            'emisor.required' => 'El nombre del emisor es obligatorio.',
            'emisor.max' => 'El nombre del emisor no puede exceder de 255 caracteres.',
            'destinatario.required' => 'El nombre del destinatario es obligatorio.',
            'destinatario.max' => 'El nombre del destinatario no puede exceder de 255 caracteres.',
            'concepto.required' => 'El texto del concepto es obligatorio.',
            'concepto.max' => 'El texto del concepto no puede exceder de 255 caracteres.',
            'importe.required' => 'El importe es obligatorio.',
            'importe.numeric' => 'El importe debe tener un valor numérico.',
        ];
    }
}
