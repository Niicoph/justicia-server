<?php

namespace App\Policies;

use App\Models\Usuario;
use App\Models\Nota;

class NotaPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Usuario $usuario): bool
    {
        return false;
    }
    /**
     * Determine whether the user can view the model.
     */
    public function view(Usuario $usuario, Nota $nota): bool
    {
        return $usuario->id === $nota->usuario_id;
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return true;
    }
    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuario, Nota $nota): bool
    {
        return $usuario->id === $nota->usuario_id;
    }
    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Nota $nota): bool
    {
        return $usuario->id === $nota->usuario_id;
    }
    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Nota $nota): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Nota $nota): bool
    {
        return false;
    }
}
