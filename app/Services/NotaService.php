<?php

namespace App\Services;

use App\Repositories\NotaRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\Nota;
use Illuminate\Support\Facades\Auth;

class NotaService
{
    use AuthorizesRequests;
    protected $notaRepository;
    public function __construct(NotaRepository $notaRepository)
    {
        $this->notaRepository = $notaRepository;
    }

    /**
     * Muestra una lista de notas personales
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getNotas()
    {
        $userId = Auth::id();
        return $this->notaRepository->getNotas($userId);
    }
    /**
     * Muestra una nota específica
     * @param int $id
     * @return \App\Models\Nota
     */
    public function getNotaById($id)
    {
        $nota = $this->notaRepository->getNotaById($id);
        $this->authorize('view', $nota);
        return $nota;
    }
    /**
     * Crea una nueva nota
     * @param array $notaData
     * @return \App\Models\Nota
     */
    public function storeNota(array $notaData)
    {
        $this->authorize('create', Nota::class);
        $notaData['usuario_id'] = Auth::id();
        return $this->notaRepository->createNota($notaData);
    }
    /**
     * Actualiza una nota
     * @param int $id
     * @param array $notaData
     * @return \App\Models\Nota
     */
    public function updateNota(array $notaData, $id)
    {
        $nota = $this->getNotaById($id);
        $this->authorize('update', $nota);
        return $this->notaRepository->updateNota($notaData, $nota);
    }
    /**
     * Elimina una nota
     * @param int $id
     * @return void
     */
    public function deleteNota($id)
    {
        $nota = $this->getNotaById($id);
        $this->authorize('delete', $nota);
        $this->notaRepository->deleteNota($nota);
    }
}
