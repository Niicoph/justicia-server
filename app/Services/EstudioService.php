<?php

namespace App\Services;

use App\Repositories\EstudioRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Estudio;

class EstudioService
{
    use AuthorizesRequests;
    protected $estudioRepository;
    public function __construct(EstudioRepository $estudioRepository)
    {
        $this->estudioRepository = $estudioRepository;
    }

    /**
     * Muestra una lista de estudios
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEstudios()
    {
        $this->authorize('viewAny', Estudio::class);
        return $this->estudioRepository->getEstudios();
    }

    /**
     * Muestra un estudio específico
     * @param int $id
     * @return \App\Models\Estudio
     */
    public function getEstudioById($id)
    {
        $estudio = $this->estudioRepository->getEstudioById($id);
        $this->authorize('view', $estudio);
        return $estudio;
    }

    /**
     * Crea un nuevo estudio
     * @param array $estudioData
     * @return \App\Models\Estudio
     */
    public function storeEstudio(array $estudioData)
    {
        $this->authorize('create', Estudio::class);
        return $this->estudioRepository->createEstudio($estudioData);
    }

    /**
     * Actualiza un estudio
     * @param int $id
     * @param array $estudioData
     * @return \App\Models\Estudio
     */
    public function updateEstudio(array $estudioData, $id)
    {
        $estudio = $this->getEstudioById($id);
        $this->authorize('update', $estudio);
        return $this->estudioRepository->updateEstudio($estudioData, $estudio);
    }

    /**
     * Elimina un estudio
     * @param int $id
     * @return void
     */
    public function deleteEstudio($id)
    {
        $estudio = $this->getEstudioById($id);
        $this->authorize('delete', $estudio);
        return $this->estudioRepository->deleteEstudio($estudio);
    }
}
