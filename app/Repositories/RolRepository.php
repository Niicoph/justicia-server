<?php

namespace App\Repositories;

use App\Models\Rol;

class RolRepository
{
    public function getRoles()
    {
        return Rol::all();
    }

    public function getRolById($id)
    {
        return Rol::findOrFail($id);
    }

    public function createRol(array $rolData)
    {
        return Rol::create($rolData);
    }

    public function updateRol(array $rolData, $id)
    {
        $rol = Rol::findOrFail($id);
        $rol->update($rolData);
        return $rol;
    }

    public function destroyRol($id)
    {
        $rol = Rol::findOrFail($id);
        $rol->delete();
    }
}
