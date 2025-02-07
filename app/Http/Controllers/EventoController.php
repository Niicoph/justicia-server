<?php

namespace App\Http\Controllers;

use App\Requests\EventoRequest;
use App\Services\EventoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;

class EventoController extends Controller
{
    protected $eventoService;
    public function __construct(EventoService $eventoService)
    {
        $this->eventoService = $eventoService;
    }
    /**
     * Muestra una lista de eventos personales basados en el usuario autenticado
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $userId = Auth::user();
        $eventos = $this->eventoService->getEventos($userId);
        if ($eventos->isEmpty()) {
            return response()->json(['message' => 'No hay eventos disponibles'], 404);
        }
        return response()->json($eventos, 200);
    }
}
