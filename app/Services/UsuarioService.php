<?php

namespace App\Services;

use App\Repositories\UsuarioRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Estudio;


class UsuarioService
{
    use AuthorizesRequests;
    protected $usuarioRepository;
    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }
    /**
     * Muestra una lista de usuarios de un estudio
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsuariosByEstudio()
    {
        $user = Auth::user();
        $this->authorize('viewUsuarios', $user);
        return $this->usuarioRepository->getUsuariosByEstudio($user->estudio_id);
    }
    /**
     * Muestra una lista de usuarios
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsuarios()
    {
        $this->authorize('viewAny', Usuario::class);
        return $this->usuarioRepository->getUsuarios();
    }
    /**
     * Muestra un usuario específico
     * @param int $id
     * @return \App\Models\Usuario
     */
    public function getUsuarioById($id)
    {
        $usuario = $this->usuarioRepository->getUsuarioById($id);
        $this->authorize('view', $usuario);
        return $usuario;
    }
    /**
     * Crea un nuevo usuario
     * @param array $validated_data
     * @return \App\Models\Usuario
     */
    public function createUsuario($validated_data)
    {
        $this->authorize('create', Usuario::class);
        // Si no se especifica un estudio, se asigna el estudio del usuario autenticado
        $validated_data['estudio_id'] = Auth::user()->estudio_id;
        $validated_data['password'] = Hash::make($validated_data['password']);
        return $this->usuarioRepository->createUsuario($validated_data);
    }
    /**
     * Actualiza un usuario
     * @param array $usuarioData
     * @param int $id
     * @return \App\Models\Usuario
     */
    public function updateUsuario($usuarioData, $id)
    {
        $usuario = $this->getUsuarioById($id);
        $this->authorize('update', $usuario);
        if (isset($usuarioData['password'])) {
            $usuarioData['password'] = Hash::make($usuarioData['password']);
        }
        return $this->usuarioRepository->updateUsuario($usuarioData, $usuario);
    }
    /**
     * Elimina un usuario
     * @param int $id
     * @return void
     */
    public function destroyUsuario($id)
    {
        $usuario = $this->getUsuarioById($id);
        $this->authorize('delete', $usuario);
        $this->usuarioRepository->destroyUsuario($usuario);
    }
}
