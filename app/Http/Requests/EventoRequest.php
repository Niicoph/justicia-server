<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventoRequest extends FormRequest
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
        $rules = [
            'titulo' => 'required|string|max:200',
            'descripcion' => 'required|string|max:300',
            'fecha' => 'required|date', // 'date_format:Y-m-d'
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i',
            'notificar' => 'required|boolean',
            'minutos_previos_notificacion' => 'required_if:notificar,true|integer|min:5|max:60',
            // usuario_id AUTH
        ];

        if ($this->isMethod('put')) {
            $rules = [
                'titulo' => 'sometimes|string|max:200',
                'descripcion' => 'sometimes|string|max:300',
                'fecha' => 'sometimes|date', // 'date_format:Y-m-d'
                'hora_inicio' => 'sometimes|date_format:H:i',
                'hora_fin' => 'sometimes|date_format:H:i',
                'notificar' => 'sometimes|boolean',
                'minutos_previos_notificacion' => 'required_if:notificar,true|integer|min:5|max:60',
            ];
        }
        return $rules;
    }
}
