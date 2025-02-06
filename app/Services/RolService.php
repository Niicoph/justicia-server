<?php

namespace App\Services;

use App\Http\Requests\RolRequest as RolRequest;
use App\Repositories\RolRepository;

class RolService
{
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
        return $this->rolRepository->getRoles();
    }
    /**
     * Muestra un rol específico
     * @param int $id
     * @return \App\Models\Rol
     */
    public function getRolById($id)
    {
        return $this->rolRepository->getRolById($id);
    }
    /**
     * Crea un nuevo rol
     * @param RolRequest $rolRequest
     * @return \App\Models\Rol
     */
    public function createRol(RolRequest $rolRequest)
    {
        $validated_data = $rolRequest->validated();
        return $this->rolRepository->createRol($validated_data);
    }
    /**
     * Actualiza un rol
     * @param RolRequest $rolRequest
     * @param int $id
     */
    public function updateRol(RolRequest $rolRequest, $id)
    {
        $validated_data = $rolRequest->validated();
        return $this->rolRepository->updateRol($validated_data, $id);
    }
    /**
     * Elimina un rol
     * @param int $id
     */
    public function destroyRol($id)
    {
        return $this->rolRepository->destroyRol($id);
    }
}
