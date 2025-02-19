<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotaRequest extends FormRequest
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
        $rules =  [
            // el estado tendra como default un valor de 'pendiente'
            'estado' => 'sometimes|string',
            'titulo' => 'sometimes|string',
            'descripcion' => 'sometimes|string',
        ];
        if ($this->isMethod('put')) {
            $rules['estado'] = 'sometimes|string';
            $rules['titulo'] = 'sometimes|string|max:200';
            $rules['descripcion'] = 'sometimes|string|max:255';
        }
        return $rules;
    }
    /**
     * Get the error messages for the defined validation rules.
     * @return array<string, string>
     */
    public function messages()
    {
        return [
            // 'estado.string' => 'El estado debe ser una cadena de texto',
            // 'titulo.required' => 'El título es obligatorio',
            // 'titulo.string' => 'El título debe ser una cadena de texto',
            // 'descripcion.string' => 'La descripción debe ser una cadena de texto',
        ];
    }
}
