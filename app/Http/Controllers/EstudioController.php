<?php

namespace App\Http\Controllers;

use App\Http\Requests\EstudioRequest;
use App\Services\EstudioService;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;


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
            if ($estudios->isEmpty()) {
                return response()->json(['message' => 'No hay estudios para mostrar'], 404);
            }
            return response()->json($estudios, 200);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver los estudios'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al mostrar los estudios', 'error' => $e->getMessage()], 500);
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
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver este estudio'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el estudio', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Crea un nuevo estudio.
     * @param \Illuminate\Http\Request\EstudioRequest $estudioRequest
     * @return \Illuminate\Http\Response
     */
    public function store(EstudioRequest $estudioRequest)
    {
        $validated_data = $estudioRequest->validated();
        try {
            $estudio = $this->estudioService->storeEstudio($validated_data);
            return response()->json($estudio, 201);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para crear un estudio'], 403);
        } catch (\Exception $e) {
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
        $validated_data = $estudioRequest->validated();
        try {
            $estudio = $this->estudioService->updateEstudio($validated_data, $id);
            return response()->json($estudio, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Estudio no encontrado'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para actualizar este estudio'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el estudio', 'error' => $e->getMessage()], 500);
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
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para eliminar este estudio'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el estudio', 'error' => $e->getMessage()], 500);
        }
    }
}
