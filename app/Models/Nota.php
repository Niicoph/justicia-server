<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Nota extends Model
{
    protected $table = 'notas';
    protected $fillable = ['estado', 'titulo', 'descripcion', 'usuario_id'];

    // una nota pertenece a un unico usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
