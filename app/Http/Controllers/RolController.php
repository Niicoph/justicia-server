<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolRequest as RequestRol;
use App\Services\RolService;
use Exception;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;


class RolController extends Controller
{
    protected $rolService;
    public function __construct(RolService $rolService)
    {
        $this->rolService = $rolService;
    }
    /**
     * Muestra una lista de roles
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $roles = $this->rolService->getRoles();
            return response()->json($roles, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener los roles', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Muestra un rol específico
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $rol = $this->rolService->getRolById($id);
            return response()->json($rol, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Crea un nuevo rol
     * @param RequestRol $rolRequest
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRol $rolRequest)
    {
        try {
            $rol = $this->rolService->createRol($rolRequest);
            return response()->json($rol, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear el rol', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Actualiza un rol
     * @param RequestRol $rolRequest
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestRol $rolRequest, $id)
    {
        try {
            $rol = $this->rolService->updateRol($rolRequest, $id);
            return response()->json($rol, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Elimina un rol
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->rolService->destroyRol($id);
            return response()->json(['message' => 'Rol eliminado'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }
}
