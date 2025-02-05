<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EstudioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // or add your authorization logic
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'nombre' => 'required|string|max:120',
            'limite_docs' => 'required|integer|min:1000',
            'plan' => 'required|string|in:basico,premium,avanzado',
            'api_token' => 'required|string|max:60'
        ];

        if ($this->isMethod('put')) {
            $rules['nombre'] = 'sometimes|string|max:120';
            $rules['limite_docs'] = 'sometimes|integer|min:1000';
            $rules['plan'] = 'sometimes|string|in:basico,premium,avanzado';
            $rules['api_token'] = 'sometimes|string|max:60';
        }

        return $rules;
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre debe ser un texto',
            'nombre.max' => 'El nombre no debe exceder los 120 caracteres',
            'limite_docs.required' => 'El límite de documentos es obligatorio',
            'limite_docs.integer' => 'El límite de documentos debe ser un número entero',
            'limite_docs.min' => 'El límite de documentos debe ser mínimo 1000',
            'plan.required' => 'El plan es requerido',
            'plan.string' => 'El plan debe ser un texto',
            'plan.in' => 'El plan debe ser básico, premium o avanzado',
            'api_token.required' => 'El token de la API es requerido',
            'api_token.string' => 'El token de la API debe ser un texto',
            'api_token.max' => 'El token de la API no debe exceder los 60 caracteres',
        ];
    }
}
