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
                    'fecha' => 'required|date_format:Y-m-d|before:today',
                    'descripcion' => 'required|max:500'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'fecha' => 'required|date_format:Y-m-d|before:today',
                    'descripcion' => 'required|max:500'
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
            'fecha.required' => 'La fecha de la entrada es obligatoria.',
            'fecha.date_format' => 'La fecha de la entrada debe tener el formato AAAA-MM-DD.',
            'fecha.before' => 'La fecha de la entrada debe ser una fecha anterior a hoy.',
            'descripcion.required' => 'La descripción del concepto es obligatoria.',
            'descripcion.max' => 'La descripción del concepto no puede exceder de 500 caracteres.',
        ];
    }
}
