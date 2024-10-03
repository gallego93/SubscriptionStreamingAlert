<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
        $ProductId = $this->route('product');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('products', 'name')->ignore($ProductId)
            ],

            'price' => 'required|string|max:255',
            'period' => 'max:255',

        ];
    }
    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre del producto debe ser una cadena de texto.',
            'name.max' => 'El nombre del producto no puede contener mas de 255 caracteres.',
            'name.unique' => 'El nombre del producto ya se encuentra registrado.',
            //price
            'price.required' => 'El precio del producto es obligatorio.',
            'price.string' => 'El precio del producto debe de ser una cadena de texto.',
            'price.max' => 'El precio del producto no puede contener mas de 255 caracteres.',
            //period
            'period.max' => 'El periodo del producto no puede contener mas de 255 caracteres.',
        ];
    }
}
