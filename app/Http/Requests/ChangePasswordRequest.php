<?php

namespace App\Http\Requests;

use App\Rules\CurrentPassword;
use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
        return [
            'current_password' => ['required', 'min:6', new CurrentPassword()],
            'password' => 'required|confirmed|min:6',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'current-password.required' => 'La contraseña actual es obligatoria.',
            'current-password.min' => 'La contraseña actual debe tener al menos 6 caracteres.',
            'password.required' => 'La nueva contraseña es obligatoria.',
            'password.min' => 'La nueva contraseña debe contener al menos 6 caracteres.',
            'password.confirmed' => 'La confirmación de contraseña no ha coincidido.',
        ];
    }
}
