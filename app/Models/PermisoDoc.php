<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisoDoc extends Model
{
    use HasFactory;
    protected $table = 'permisos_docs';
    protected $fillable = ['id_doc', 'usuario_id', 'permiso', 'tipo_permiso'];

    // cada permiso_doc pertenece a un unico usuario
    public function usuario()
    {
        return $this->belongsTo(Usuario::class);
    }
}
