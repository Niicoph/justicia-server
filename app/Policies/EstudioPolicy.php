<?php

namespace App\Policies;

use App\Models\Estudio;
use App\Models\Usuario;

class EstudioPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return $usuario->rol->nombre === 'superadmin';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Estudio $estudio): bool
    {
        // si el usuario es superadmin o pertenece al estudio
        if ($usuario->estudio_id === $estudio->id || $usuario->rol->nombre === 'superadmin') {
            return true;
        }
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->rol->nombre === 'superadmin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario): bool
    {
        return $usuario->rol->nombre === 'superadmin';
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario): bool
    {
        return $usuario->rol->nombre === 'superadmin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Estudio $estudio): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Estudio $estudio): bool
    {
        return false;
    }
}
