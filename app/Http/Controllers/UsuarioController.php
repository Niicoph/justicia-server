<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest as RequestUsuario;
use App\Services\UsuarioService;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Throwable;

class UsuarioController extends Controller
{
    protected $usuarioService;
    public function __construct(UsuarioService $usuarioService)
    {
        $this->usuarioService = $usuarioService;
    }
    /**
     * Muestra una lista de Usuarios
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $usuarios = $this->usuarioService->getUsuarios();
            return response()->json($usuarios, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al obtener los usuarios', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Muestra un usuario específico
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $usuario = $this->usuarioService->getUsuarioById($id);
            return response()->json($usuario, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Crea un nuevo usuario
     * @param RequestUsuario $usuarioRequest
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUsuario $usuarioRequest)
    {
        try {
            $validated_data = $usuarioRequest->validated();
            $usuario = $this->usuarioService->createUsuario($validated_data);
            return response()->json($usuario, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al crear el usuario', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Actualiza un usuario
     * @param RequestUsuario $usuarioRequest
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestUsuario $usuarioRequest, $id)
    {
        try {
            $usuario = $this->usuarioService->updateUsuario($usuarioRequest, $id);
            return response()->json($usuario, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Elimina un usuario
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->usuarioService->destroyUsuario($id);
            return response()->json(['message' => 'Usuario eliminado'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (QueryException $e) {
            return response()->json(['message' => 'Error en la consulta', 'error' => $e->getMessage()], 500);
        } catch (Throwable $e) {
            return response()->json(['message' => 'Error inesperado', 'error' => $e->getMessage()], 500);
        }
    }
}
