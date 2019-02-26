<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTopicRequest extends FormRequest
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
                    'titulo' => 'required',
                    'propietario' => 'required',
                    'responsable' => 'required',
                    'tema' => 'required'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'titulo' => 'required',
                    'propietario' => 'required',
                    'responsable' => 'required',
                    'tema' => 'required'
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
            'titulo.required' => 'El título es obligatorio.',
            'propietario.required' => 'El propietario del tema es obligatorio.',
            'responsable.required' => 'El responsable del seguimiento del tema es obligatorio.',
            'temas.required' => 'El tema de la reunión es obligatorio.'
        ];
    }
}
