<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Usuario;

class Estudio extends Model
{
    protected $table = 'estudios';
    protected $fillable = ['nombre', 'limite_docs', 'plan', 'api_token'];
    protected $hidden = ['api_token'];

    // Un estudio tiene muchos usuarios
    public function usuarios()
    {
        return $this->hasMany(Usuario::class);
    }
}
