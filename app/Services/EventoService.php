<?php

namespace App\Services;

use App\Models\Evento;
use App\Repositories\EventoRepository;

class EventoService
{
    protected $eventoRepository;
    public function __construct(EventoRepository $eventoRepository)
    {
        $this->eventoRepository = $eventoRepository;
    }

    /**
     * Muestra una lista de eventos personales (auth user)
     * @param int $userId
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEventos($userId)
    {
        return $this->eventoRepository->getEventos($userId);
    }
    /**
     * Muestra un evento específico
     * @param int $id
     * @return \App\Models\Evento
     */
    public function getEventoById($id)
    {
        return $this->eventoRepository->getEventoById($id);
    }
    /**
     * Crea un nuevo evento
     * @param array $eventoData
     * @return \App\Models\Evento
     */
    public function storeEvento(array $eventoData)
    {
        return $this->eventoRepository->createEvento($eventoData);
    }
    /**
     * Actualiza un evento
     * @param array $eventoData
     * @param int $id
     * @return \App\Models\Evento
     */
    public function updateEvento(array $eventoData, $id)
    {
        return $this->eventoRepository->updateEvento($eventoData, $id);
    }
    /**
     * Elimina un evento
     * @param int $id
     * @return void
     */
    public function deleteEvento($id)
    {
        return $this->eventoRepository->deleteEvento($id);
    }
}
