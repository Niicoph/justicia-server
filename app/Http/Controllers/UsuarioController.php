<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsuarioRequest as RequestUsuario;
use App\Services\UsuarioService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Auth\Access\AuthorizationException;


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
            if ($usuarios->isEmpty()) {
                return response()->json(['message' => 'No hay usuarios para mostrar'], 404);
            }
            return response()->json($usuarios, 200);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver los usuarios'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al mostrar los usuarios', 'error' => $e->getMessage()], 500);
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
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para ver este usuario'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al obtener el usuario', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Crea un nuevo usuario.
     * @param RequestUsuario $usuarioRequest
     * @return \Illuminate\Http\Response
     */
    public function store(RequestUsuario $usuarioRequest)
    {
        $validated_data = $usuarioRequest->validated();
        try {
            $usuario = $this->usuarioService->createUsuario($validated_data);
            return response()->json($usuario, 201);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para crear un usuario'], 403);
        } catch (\Exception $e) {
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
        $validated_data = $usuarioRequest->validated();
        try {
            $usuario = $this->usuarioService->updateUsuario($validated_data, $id);
            return response()->json($usuario, 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para actualizar este usuario'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al actualizar el usuario', 'error' => $e->getMessage()], 500);
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
            return response()->json(['message' => 'Usuario eliminado correctamente'], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        } catch (AuthorizationException $e) {
            return response()->json(['message' => 'No tienes permiso para eliminar este usuario'], 403);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error al eliminar el usuario', 'error' => $e->getMessage()], 500);
        }
    }
}
