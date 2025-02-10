<?php

namespace App\Repositories;

use App\Models\Nota;

class NotaRepository
{
    public function getNotas($userId)
    {
        return Nota::where('usuario_id', $userId)->get();
    }

    public function getNotaById($id)
    {
        return Nota::findOrFail($id);
    }

    public function createNota(array $notaData)
    {
        return Nota::create($notaData);
    }

    public function updateNota(array $notaData, $nota)
    {
        $nota->update($notaData);
        return $nota;
    }

    public function deleteNota($nota)
    {
        $nota->delete();
    }
}
