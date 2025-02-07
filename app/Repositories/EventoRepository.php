<?php

namespace App\Repositories;

use App\Models\Evento;

class EventoRepository
{

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

    public function updateEvento(array $eventoData, $id)
    {
        $evento = Evento::findOrFail($id);
        $evento->update($eventoData);
        return $evento;
    }

    public function deleteEvento($id)
    {
        $evento = Evento::findOrFail($id);
        $evento->delete();
    }
}
