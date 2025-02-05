<?php

namespace App\Services;

use App\Repositories\EstudioRepository;

class EstudioService
{
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
        return $this->estudioRepository->getEstudios();
    }

    /**
     * Muestra un estudio específico
     * @param int $id
     * @return \App\Models\Estudio
     */
    public function getEstudioById($id)
    {
        return $this->estudioRepository->getEstudioById($id);
    }

    /**
     * Crea un nuevo estudio
     * @param \App\Http\Requests\EstudioRequest $estudioRequest
     * @return \App\Models\Estudio
     */
    public function storeEstudio(array $estudioData)
    {
        return $this->estudioRepository->createEstudio($estudioData);
    }

    /**
     * Actualiza un estudio
     * @param \App\Http\Requests\EstudioRequest $estudioRequest
     * @param int $id
     * @return \App\Models\Estudio
     */
    public function updateEstudio(array $estudioData, $id)
    {
        return $this->estudioRepository->updateEstudio($estudioData, $id);
    }

    /**
     * Elimina un estudio
     * @param int $id
     * @return void
     */
    public function deleteEstudio($id)
    {
        return $this->estudioRepository->deleteEstudio($id);
    }
}
