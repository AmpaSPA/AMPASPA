<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMeetingRequest extends FormRequest
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
                    'fechareunion' => 'required|date_format:Y-m-d|after:today',
                    'horareunion' => [
                        'required',
                        'max:5',
                        'regex:/^([0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'
                    ],
                    'meetingtype_id' => 'required'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'fechareunion' => 'required|date_format:Y-m-d|after:today',
                    'horareunion' => [
                        'required',
                        'max:5',
                        'regex:/^([0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/'
                    ],
                    'meetingtype_id' => 'required'
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
            'fechareunion.required' => 'La fecha de la reunión es obligatoria.',
            'fechareunion.date_format' => 'La fecha de la reunión debe tener el formato AAAA-MM-DD.',
            'fechareunion.after' => 'La fecha de la reunión debe ser una fecha posterior a hoy.',
            'horareunion.required' => 'La hora de la reunión es obligatoria.',
            'horareunion.max' => 'La hora de la reunión no puede exceder de 5 caracteres.',
            'horareunion.regex' => 'El formato de la hora de la reunión es incorrecto.',
            'meetingtype_id.required' => 'El tipo de reunión es obligatorio.'
        ];
    }
}
