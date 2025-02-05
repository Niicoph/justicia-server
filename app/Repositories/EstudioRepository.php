<?php

namespace App\Repositories;

use App\Models\Estudio;

class EstudioRepository
{
    public function getEstudios()
    {
        return Estudio::all();
    }

    public function getEstudioById($id)
    {
        return Estudio::findOrFail($id);
    }

    public function createEstudio(array $estudioData)
    {
        return Estudio::create($estudioData);
    }

    public function updateEstudio(array $estudioData, $id)
    {
        $estudio = Estudio::findOrFail($id);
        $estudio->update($estudioData);
        return $estudio;
    }

    public function deleteEstudio($id)
    {
        $estudio = Estudio::findOrFail($id);
        $estudio->delete();
    }
}
