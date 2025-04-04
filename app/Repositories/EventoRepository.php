<?php

namespace App\Repositories;

use App\Models\Evento;

class EventoRepository
{

    public function getEventosTotal()
    {
        return Evento::where('fecha', now()->toDateString())->get();
    }

    public function getEventos($userId)
    {
        return Evento::where('usuario_id', $userId)->get();
    }

    public function getEventoById($id)
    {
        return Evento::findOrFail($id);
    }
    public function createEvento(array $eventoData)
    {
        return Evento::create($eventoData);
    }

    public function updateEvento(array $eventoData, $evento)
    {
        $evento->update($eventoData);
        return $evento;
    }

    public function deleteEvento($evento)
    {
        $evento->delete();
    }
}
