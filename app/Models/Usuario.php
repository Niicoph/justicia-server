<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Estudio;
use App\Models\Rol;
use App\Models\Nota;
use App\Models\Evento;
use App\Models\PermisoDoc;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'email', 'password', 'rol_id', 'avatar'];
    protected $hidden = ['password'];

    // un usuario pertenece a un unico estudio
    public function estudios()
    {
        return $this->belongsTo(Estudio::class);
    }
    // un usuario posee un unico rol
    public function rol()
    {
        return $this->belongsTo(Rol::class);
    }
    // un usuario posee muchas notas personales
    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
    // un usuario posee muchos eventos
    public function eventos()
    {
        return $this->hasMany(Evento::class);
    }
    public function permisosDocs()
    {
        return $this->hasMany(PermisoDoc::class);
    }
}
