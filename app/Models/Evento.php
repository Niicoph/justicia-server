<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';
    protected $fillable = ['titulo', 'descripcion', 'fecha', 'hora_inicio', 'hora_fin', 'notificar', 'minutos_previos_notificacion'];

    // un evento pertenece a un unico usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
