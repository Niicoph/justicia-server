<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventoRequest;
use App\Services\EventoService;
use Illuminate\Routing\Controller;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;


class EventoController extends Controller
{
    protected $eventoService;
    public function __construct(EventoService $eventoService)
    {
        $this->eventoService = $eventoService;
    }
    /**
     * Muestra una lista de eventos personales
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $eventos = $this->eventoService->getEventos();
            if ($eventos->isEmpty()) {
                return response()->json(['message' => 'No hay eventos para mostrar'], 404);
            }
            return response()->json($eventos, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrio un error al mostrar los eventos', $e], 500);
        }
    }
    /**
     * Muestra un evento específico
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id)
    {
        try {
            $evento = $this->eventoService->getEventoById($id);
            return response()->json($evento, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver este evento'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrio un error al mostrar el evento'], 500);
        }
    }
    /**
     * Crea un nuevo evento personal
     * @param EventoRequest $eventoRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(EventoRequest $eventoRequest)
    {
        $validated_data = $eventoRequest->validated();
        try {
            $evento = $this->eventoService->storeEvento($validated_data);
            return response()->json($evento, 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrio un error al crear el evento'], 500);
        }
    }
    /**
     * Edita un evento personal
     * @param EventoRequest $eventoRequest
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(EventoRequest $eventoRequest, $id)
    {
        $validated_data = $eventoRequest->validated();
        try {
            $evento = $this->eventoService->updateEvento($validated_data, $id);
            return response()->json($evento, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para editar este evento'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error al actualizar el evento'], 500);
        }
    }
    /**
     * Elimina un evento personal
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $this->eventoService->deleteEvento($id);
            return response()->json(['message' => 'Evento eliminado'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Evento no encontrado'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para eliminar este evento'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error al eliminar el evento'], 500);
        }
    }
}
