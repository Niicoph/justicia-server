<?php

namespace App\Repositories;

use App\Models\Usuario;

class UsuarioRepository
{
    public function getUsuarios()
    {
        return Usuario::all();
    }
    public function getUsuariosByEstudio($estudio_id)
    {
        return Usuario::where('estudio_id', $estudio_id)->get();
    }

    public function getUsuarioById($id)
    {
        return Usuario::findOrFail($id);
    }

    public function createUsuario(array $usuarioData)
    {
        return Usuario::create($usuarioData);
    }

    public function updateUsuario(array $usuarioData, $usuario)
    {
        $usuario->update($usuarioData);
        return $usuario;
    }

    public function destroyUsuario($usuario)
    {
        $usuario->delete();
    }
}
