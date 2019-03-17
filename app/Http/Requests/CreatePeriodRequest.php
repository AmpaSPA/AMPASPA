<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePeriodRequest extends FormRequest
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
                    'cuota' => 'required|numeric|min:1',
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
            'cuota.required' => 'Una cuota es obligatoria.',
            'cuota.min' => 'El valor de la cuota debe ser mayor que cero.',
            'cuota.numeric' => 'El valor de la cuota debe ser numérico mayor que cero.'
        ];
    }
}
