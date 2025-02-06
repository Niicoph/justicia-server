<?php

namespace App\Services;

use App\Http\Requests\UsuarioRequest as UsuarioRequest;
use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\Hash;

class UsuarioService
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * Muestra una lista de usuarios
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarioRepository->getUsuarios();
    }
    /**
     * Muestra un usuario específico
     * @param int $id
     * @return \App\Models\Usuario
     */
    public function getUsuarioById($id)
    {
        return $this->usuarioRepository->getUsuarioById($id);
    }
    /**
     * Crea un nuevo usuario
     * @param array $validated_data
     * @return \App\Models\Usuario
     */
    public function createUsuario($validated_data)
    {
        $validated_data['password'] = Hash::make($validated_data['password']);
        return $this->usuarioRepository->createUsuario($validated_data);
    }
    /**
     * Actualiza un usuario
     * @param UsuarioRequest $usuarioRequest
     * @param int $id
     * @return \App\Models\Usuario
     */
    public function updateUsuario(UsuarioRequest $usuarioRequest, $id)
    {
        $validated_data = $usuarioRequest->validated();
        return $this->usuarioRepository->updateUsuario($validated_data, $id);
    }
    /**
     * Elimina un usuario
     * @param int $id
     */
    public function destroyUsuario($id)
    {
        return $this->usuarioRepository->destroyUsuario($id);
    }
}
