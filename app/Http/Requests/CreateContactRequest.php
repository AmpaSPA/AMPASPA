<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
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
                    'correo' => 'required|email',
                    'asunto' => 'required|max:50',
                    'mensaje' => 'required',
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
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.email' => 'El correo electrónico no es una dirección de correo válida.',
            'asunto.required' => 'El asunto es obligatorio.',
            'asunto.max' => 'El nombre no debe superar los 50 caracteres.',
            'mensaje.required' => 'El texto del mensaje es obligatorio.',
        ];
    }
}
