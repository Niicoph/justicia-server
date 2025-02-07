<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthRegisterRequest;
use App\Http\Requests\AuthLoginRequest;
use App\Services\Auth\AuthService;
use Exception;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;

class AuthController extends Controller
{
    protected $authService;
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    /**
     * Registra a un nuevo usuario
     * @param AuthRegisterRequest $authRegisterRequest
     * @return \Illuminate\Http\Response
     */
    public function register(AuthRegisterRequest $authRegisterRequest)
    {
        try {
            $validated_data = $authRegisterRequest->validated();
            $usuario = $this->authService->register($validated_data);
            return response()->json($usuario, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al registrar el usuario', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Inicia sesión de un usuario
     * @param AuthLoginRequest $authLoginRequest
     * @return \Illuminate\Http\Response
     */
    public function login(AuthLoginRequest $authLoginRequest)
    {
        try {
            $credentials = $authLoginRequest->validated();
            $response = $this->authService->login($credentials);
            return response()->json(['message' => 'Usuario logueado', 'user' => $response['user']['nombre']], 200)
                ->cookie('sessionId', $response['token'], 0, '/', null, true, true);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al iniciar sesión', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Desloguea a un usuario
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        try {
            $this->authService->logout();
            return response()->json(['message' => 'Usuario deslogueado'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al desloguear el usuario', 'error' => $e->getMessage()], 500);
        }
    }
    /**
     * Refresca el token de un usuario
     * @return \Illuminate\Http\Response
     */
    public function refresh()
    {
        try {
            $response = $this->authService->refresh();
            return response()->json($response, 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error al refrescar el token', 'error' => $e->getMessage()], 500);
        }
    }
}
