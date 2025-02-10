<?php

namespace App\Policies;

use App\Models\Evento;
use App\Models\Usuario;


class EventoPolicy
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
    public function view(Usuario $usuario, Evento $evento): bool
    {
        return $usuario->id === $evento->usuario_id;
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
    public function update(Usuario $usuario, Evento $evento): bool
    {
        return $usuario->id === $evento->usuario_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuario, Evento $evento): bool
    {
        return $usuario->id === $evento->usuario_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario, Evento $evento): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario, Evento $evento): bool
    {
        return false;
    }
}
