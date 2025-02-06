<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsuarioRequest extends FormRequest
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
            'nombre' => 'required|string',
            'email' => 'required|email|max:255|unique:usuarios',
            'password' => 'required|string|min:8|max:30|confirmed',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048',
            // la idea es que estos valores no se pidan. Se envie automaticamente tomando el
            // valor del usuario logged (admin)
            'estudio_id' => 'required|integer',
            'rol_id' => 'required|integer',
        ];
        if ($this->isMethod('put')) {
            $rules['nombre'] = 'sometimes|string';
            $rules['email'] = 'sometimes|email|max:255|unique:usuarios';
            $rules['password'] = 'sometimes|string|min:8|max:30|confirmed';
            $rules['avatar'] = 'nullable|image|mimes:jpeg,png,jpg,svg|max:2048';
            $rules['estudio_id'] = 'sometimes|integer';
            $rules['rol_id'] = 'sometimes|integer';
        }
        return $rules;
    }
    /**
     * Get the error messages for the defined validation rules.
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre debe ser una cadena de texto',
            'email.required' => 'El email es obligatorio',
            'email.email' => 'El email debe ser una dirección de correo válida',
            'email.max' => 'El email debe tener un máximo de 255 caracteres',
            'email.unique' => 'El email ya está en uso',
            'password.required' => 'La contraseña es requerida',
            'password.string' => 'La contraseña debe ser una cadena de texto',
            'password.min' => 'La contraseña debe tener un mínimo de 8 caracteres',
            'password.max' => 'La contraseña debe tener un máximo de 30 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'avatar.image' => 'El archivo debe ser una imagen',
            'avatar.mimes' => 'El archivo debe ser de tipo: jpeg, png, jpg, svg',
            'avatar.max' => 'El archivo debe tener un máximo de 2048 KB',
            'estudio_id.required' => 'El estudio es requerido',
            'estudio_id.integer' => 'El estudio debe ser un número entero',
            'rol_id.required' => 'El rol es requerido',
            'rol_id.integer' => 'El rol debe ser un número entero',
        ];
    }
}
