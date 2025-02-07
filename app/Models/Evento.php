<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Evento extends Model
{
    use HasFactory;
    protected $table = 'eventos';
    protected $fillable = ['titulo', 'descripcion', 'fecha', 'hora_inicio', 'hora_fin', 'notificar', 'minutos_previos_notificacion', 'usuario_id'];

    // un evento pertenece a un unico usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
