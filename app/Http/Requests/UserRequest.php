<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use function Laravel\Prompts\password;

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
        $usertId = $this->route('id'); // Obtiene el ID del usuario desde la ruta

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                // Si es una actualización, se excluye la validación de unicidad para este ID
                'unique:users,name,'. $usertId,
            ],
            'email' => [
                'required',
                'email',
                'max:255',
                // Si es una actualización, se excluye la validación de unicidad para este ID
                'unique:users,email,'. $usertId,
            ],
            'password' => [
                'required',
                'min:8',
            ],
        ];
    }
    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            //name
            'name.required' => 'El nombre del usuario es obligatorio.',
            'name.string' => 'El nombre del usuario debe ser una cadena de texto.',
            'name.max' => 'El nombre del usuario no puede tener más de 255 caracteres.',
            'name.unique' => 'El nombre de usuario ya se encuentra registrado.',
            //email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya se encuentra registrado.',
            'email.max' => 'El correo electrónico no puede contener menos de 255 caracteres.',
            //phone
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña no puede tener menos de 8 caracteres.'

        ];
    }
}
