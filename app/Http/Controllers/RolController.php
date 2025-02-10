<?php

namespace App\Http\Controllers;

use App\Http\Requests\RolRequest as RequestRol;
use App\Services\RolService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;


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
            if ($roles->isEmpty()) {
                return response()->json(['message' => 'No hay roles para mostrar'], 404);
            }
            return response()->json($roles, 200);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver los roles'], 403);
        } catch (\Exception $e) {
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
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver este rol'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el rol', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Crea un nuevo rol
     * @param RequestRol $rolRequest
     * @return \Illuminate\Http\Response
     */
    public function store(RequestRol $rolRequest)
    {
        $validated_data = $rolRequest->validated();
        try {
            $rol = $this->rolService->createRol($validated_data);
            return response()->json($rol, 201);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para crear un rol'], 403);
        } catch (\Exception $e) {
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
        $validated_data = $rolRequest->validated();
        try {
            $rol = $this->rolService->updateRol($validated_data, $id);
            return response()->json($rol, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para actualizar este rol'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el rol', 'error' => $e->getMessage()], 500);
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
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para eliminar este rol'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el rol', 'error' => $e->getMessage()], 500);
        }
    }
}
