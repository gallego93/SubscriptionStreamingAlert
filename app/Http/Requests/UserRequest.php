<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('users', 'name')->ignore($userId),
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($userId),
            ],
            'password' => [
                'nullable',
                'min:8',
            ],
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            // name
            'name.required' => 'El nombre del usuario es obligatorio.',
            'name.string' => 'El nombre del usuario debe ser una cadena de texto.',
            'name.max' => 'El nombre del usuario no puede tener más de 255 caracteres.',
            'name.unique' => 'El nombre de usuario ya se encuentra registrado.',
            // email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya se encuentra registrado.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            // password
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
        ];
    }
}
