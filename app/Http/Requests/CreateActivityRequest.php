<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateActivityRequest extends FormRequest
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
                    'fechaactividad' => 'required|date_format:Y-m-d|after:today',
                    'nombre' => 'required|max:255',
                    'descripcion' => 'required|max:500',
                    'activitytype_id' => 'required',
                    'subvencion' => 'required|numeric',
                    'precio' => 'required|numeric'
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'fechaactividad' => 'required|date_format:Y-m-d|after:today',
                    'nombre' => 'required|max:255',
                    'descripcion' => 'required|max:500',
                    'activitytype_id' => 'required',
                    'subvencion' => 'required|numeric',
                    'precio' => 'required|numeric'
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
            'fechaactividad.required' => 'La fecha de la actividad es obligatoria.',
            'fechaactividad.date_format' => 'La fecha de la actividad debe tener el formato AAAA-MM-DD.',
            'fechaactividad.after' => 'La fecha de la actividad debe ser una fecha posterior a hoy.',
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.max' => 'El nombre no puede exceder de 255 caracteres.',
            'descripcion.required' => 'La descripción de la actividad es obligatoria.',
            'descripcion.max' => 'La descripción de la actividad no puede exceder de 500 caracteres.',
            'activitytype_id.required' => 'El tipo de actividad es obligatorio.',
            'subvencion.required' => 'La subvención es obligatoria.',
            'subvencion.numeric' => 'La subvención debe tener un valor numérico.',
            'precio.required' => 'El precio es obligatorio.',
            'precio.numeric' => 'El precio debe tener un valor numérico.',
        ];
    }
}
