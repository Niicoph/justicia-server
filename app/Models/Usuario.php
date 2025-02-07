<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Estudio;
use App\Models\Rol;
use App\Models\Nota;
use App\Models\Evento;
use App\Models\PermisoDoc;

use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;



class Usuario extends Authenticatable implements JWTSubject
{
    use HasFactory;
    use Notifiable;

    protected $table = 'usuarios';
    protected $fillable = ['nombre', 'email', 'password', 'avatar', 'estudio_id', 'rol_id'];
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

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();  // El identificador del JWT
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];  // Puedes agregar claims personalizados si lo deseas
    }
}
