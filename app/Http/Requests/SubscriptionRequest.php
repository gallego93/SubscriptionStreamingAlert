<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubscriptionRequest extends FormRequest
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
        return [
            'client_id' => 'required|max:255',
            'product_id' => 'required|max:255',
            'initial_date' => 'required|max:255',
            'final_date' => 'required|max:255',    
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'client_id.required' => 'El campo cliente es requerido, valide por favor.',
            'product_id.required' => 'El campo producto es requerido, valide por favor.',
            'initial_date.required' => 'El campo fecha de activacion es requerido, valide por favor.',
            'final_date.required' => 'El campo fecha de vencimiento es requerido, valide por favor.',

        ];
    }
}
