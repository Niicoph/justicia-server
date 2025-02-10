<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Http\Requests\NotaRequest;
use App\Services\NotaService;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    protected $notaService;
    public function __construct(NotaService $notaService)
    {
        $this->notaService = $notaService;
    }
    /**
     * Muestra una lista de notas personales
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $notas = $this->notaService->getNotas();
            if ($notas->isEmpty()) {
                return response()->json(['message' => 'No hay notas para mostrar'], 404);
            }
            return response()->json($notas, 200);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver las notas'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al mostrar las notas', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Muestra una nota específica.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $nota = $this->notaService->getNotaById($id);
            return response()->json($nota, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver esta nota'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener la nota', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Crea una nueva nota.
     * @param \Illuminate\Http\Request\NotaRequest $notaRequest
     * @return \Illuminate\Http\Response
     */
    public function store(NotaRequest $notaRequest)
    {
        $validated_data = $notaRequest->validated();
        try {
            $nota = $this->notaService->storeNota($validated_data);
            return response()->json($nota, 201);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para crear una nota'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al crear la nota', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Actualiza una nota.
     * @param \Illuminate\Http\Request\NotaRequest $notaRequest
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NotaRequest $notaRequest, $id)
    {
        $validated_data = $notaRequest->validated();
        try {
            $nota = $this->notaService->updateNota($validated_data, $id);
            return response()->json($nota, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para actualizar esta nota'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar la nota', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Elimina una nota.
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->notaService->deleteNota($id);
            return response()->json(['message' => 'Nota eliminada'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Nota no encontrada'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para eliminar esta nota'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar la nota', 'error' => $e->getMessage()], 500);
        }
    }
}
