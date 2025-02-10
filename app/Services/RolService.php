<?php

namespace App\Services;

use App\Repositories\RolRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Rol;

class RolService
{
    use AuthorizesRequests;
    protected $rolRepository;

    public function __construct(RolRepository $rolRepository)
    {
        $this->rolRepository = $rolRepository;
    }
    /**
     * Muestra una lista de roles
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRoles()
    {
        $this->authorize('viewAny', Rol::class);
        return $this->rolRepository->getRoles();
    }
    /**
     * Muestra un rol específico
     * @param int $id
     * @return \App\Models\Rol
     */
    public function getRolById($id)
    {
        $rol =  $this->rolRepository->getRolById($id);
        $this->authorize('view', $rol);
        return $rol;
    }
    /**
     * Crea un nuevo rol
     * @param array $rolData
     * @return \App\Models\Rol
     */
    public function createRol(array $rolData)
    {
        $this->authorize('create', Rol::class);
        return $this->rolRepository->createRol($rolData);
    }
    /**
     * Actualiza un rol
     * @param array $rolData
     * @param int $id
     * @return \App\Models\Rol
     */
    public function updateRol(array $rolData, $id)
    {
        $rol = $this->getRolById($id);
        $this->authorize('update', $rol);
        return $this->rolRepository->updateRol($rolData, $rol);
    }
    /**
     * Elimina un rol
     * @param int $id
     * @return void
     */
    public function destroyRol($id)
    {
        $rol = $this->getRolById($id);
        $this->authorize('delete', $rol);
        $this->rolRepository->destroyRol($rol);
    }
}
