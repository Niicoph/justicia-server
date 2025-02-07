<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Nota extends Model
{
    use HasFactory;
    protected $table = 'notas';
    protected $fillable = ['estado', 'titulo', 'descripcion', 'usuario_id'];

    // una nota pertenece a un unico usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
