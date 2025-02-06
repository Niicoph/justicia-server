<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RolRequest extends FormRequest
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
            'nombre' => 'required|string|max:30',
            'descripcion' => 'required|string|max:100',
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre debe ser un texto',
            'nombre.max' => 'El nombre no debe tener más de 30 caracteres',
            'descripcion.required' => 'La descripción es obligatorio',
            'descripcion.string' => 'La descripción debe ser un texto',
            'descripcion.max' => 'La descripción no debe tener más de 100 caracteres',
        ];
    }
}
