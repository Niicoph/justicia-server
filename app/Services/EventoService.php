<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use App\Repositories\EventoRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EventoService
{
    use AuthorizesRequests;
    protected $eventoRepository;
    public function __construct(EventoRepository $eventoRepository)
    {
        $this->eventoRepository = $eventoRepository;
    }

    /**
     * Muestra una lista de eventos totales
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getTodayEventos()
    {
        $eventos = $this->eventoRepository->getEventosTotal();
        $filteredEvents = [];
        $horaActual = date('H:i:s');
        foreach ($eventos as $evento) {
            $horaInicio = $evento->hora_inicio;
            if ($horaInicio > $horaActual) {
                $filteredEvents[] = $evento;
            }
        }
        return $filteredEvents;
    }



    /**
     * Muestra una lista de eventos personales (auth user)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getEventos()
    {
        $userId = Auth::id();
        return $this->eventoRepository->getEventos($userId);
    }
    /**
     * Muestra un evento específico
     * @param int $id
     * @param int $userId
     * @return \App\Models\Evento || exception
     */
    public function getEventoById($id)
    {
        $evento = $this->eventoRepository->getEventoById($id);
        $this->authorize('view', $evento);
        return $evento;
    }
    /**
     * Crea un nuevo evento. Asigna el usuario autenticado como creador
     * @param array $eventoData
     * @return \App\Models\Evento
     */
    public function storeEvento(array $eventoData)
    {
        $eventoData['usuario_id'] = Auth::id();
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
        $evento = $this->getEventoById($id);
        $this->authorize('update', $evento);
        $eventoData['usuario_id'] = Auth::id();
        return $this->eventoRepository->updateEvento($eventoData, $evento);
    }
    /**
     * Elimina un evento
     * @param int $id
     * @return void
     */
    public function deleteEvento($id)
    {
        $evento = $this->getEventoById($id);
        $this->authorize('delete', $evento);
        $this->eventoRepository->deleteEvento($evento);
    }
}
