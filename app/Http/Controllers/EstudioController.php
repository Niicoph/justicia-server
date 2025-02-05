<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstudioRequest;
use App\Services\EstudioService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Throwable;


class EstudioController extends Controller
{
    protected $estudioService;
    public function __construct(EstudioService $estudioService)
    {
        $this->estudioService = $estudioService;
    }

    /**
     * Muestra una lista de estudios.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $estudios = $this->estudioService->getEstudios();
            return response()->json($estudios, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener los estudios', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Muestra un estudio específico.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $estudio = $this->estudioService->getEstudioById($id);
            return response()->json($estudio, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Estudio no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Crea un nuevo estudio.
     * @param \Illuminate\Http\Request\EstudioRequest $estudioRequest
     * @return \Illuminate\Http\Response
     */
    public function store(EstudioRequest $estudioRequest)
    {
        try {
            $validated_data = $estudioRequest->validated();
            $estudio = $this->estudioService->storeEstudio($validated_data);
            return response()->json($estudio, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear el estudio', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Actualiza un estudio específico.
     * @param \App\Http\Requests\EstudioRequest $estudioRequest
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EstudioRequest $estudioRequest, $id)
    {
        try {
            $validated_data = $estudioRequest->validated();
            $estudio = $this->estudioService->updateEstudio($validated_data, $id);
            return response()->json($estudio, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Estudio no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }

    /**
     * Elimina un estudio específico.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->estudioService->deleteEstudio($id);
            return response()->json(['message' => 'Estudio eliminado correctamente'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Estudio no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }
}
