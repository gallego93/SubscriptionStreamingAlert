<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
        //dd($this->route('id'));

        $clientId = $this->route('id'); // Obtiene el ID del cliente desde la ruta

        return [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                // Si es una actualización, se excluye la validación de unicidad para este ID
                'unique:clients,email,'. $clientId,
            ],
            'phone' => [
                'required',
                'string',
                'max:10',
                // Si es una actualización, se excluye la validación de unicidad para este ID
                'unique:clients,phone,'. $clientId,
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
            'name.required' => 'El nombre del cliente es obligatorio.',
            'name.string' => 'El nombre del cliente debe ser una cadena de texto.',
            'name.max' => 'El nombre del cliente no puede tener más de 255 caracteres.',
            //email
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.unique' => 'El correo electrónico ya se encuentra registrado.',
            'email.max' => 'El correo electrónico no puede contener mas de 255 caracteres.',
            //phone
            'phone.required' => 'El numero telefonico es obligatorio.',
            'phone.integer' => 'El numero telefonico del cliente debe ser numerico.',
            'phone.unique' => 'El numero telefonico ya se encuentra registrado.',
            'phone.max' => 'El numero del cliente no puede tener mas de 10 caracteres.'

        ];
    }
}
