<?php

namespace App\Policies;

use App\Models\Usuario;

class UsuarioPolicy
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
    public function view(Usuario $usuarioAuth, Usuario $usuarioTarget): bool
    {
        // Permitir si el usuario autenticado es superadmin o si es admin del mismo estudio
        return ($usuarioAuth->rol->nombre === 'superadmin') ||
            ($usuarioAuth->estudio_id === $usuarioTarget->estudio_id && $usuarioAuth->rol->nombre === 'admin') ||
            ($usuarioAuth->id === $usuarioTarget->id);
    }
    /**
     * Determine whether the user can create models.
     */
    public function create(Usuario $usuario): bool
    {
        return $usuario->rol->nombre === 'admin' || $usuario->rol->nombre === 'superadmin';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Usuario $usuarioAuth, Usuario $usuarioTarget): bool
    {
        // Permitir si el usuario autenticado es superadmin o si es admin del mismo estudio o si es el mismo usuario
        return ($usuarioAuth->rol->nombre === 'superadmin') ||
            ($usuarioAuth->estudio_id === $usuarioTarget->estudio_id && $usuarioAuth->rol->nombre === 'admin') ||
            ($usuarioAuth->id === $usuarioTarget->id);
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Usuario $usuarioAuth, Usuario $usuarioTarget): bool
    {
        // If admin but not my own user
        return ($usuarioAuth->rol->nombre === 'admin' && $usuarioTarget->id !== $usuarioAuth->id) || $usuarioAuth->rol->nombre === 'superadmin';
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Usuario $usuario): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Usuario $usuario): bool
    {
        return false;
    }
}
