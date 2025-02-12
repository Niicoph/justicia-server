<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controller;
use App\Http\Requests\AuthLoginRequest;
use App\Http\Requests\AuthRegisterRequest;
use Illuminate\Http\Request;
use App\Services\Auth\AuthService;
use Illuminate\Auth\AuthenticationException;
use Exception;

class AuthController extends Controller
{
    protected $authService;
    /**
     * Create a new AuthController instance.
     * @return void
     */
    public function __construct(AuthService $authService)
    {
        $this->middleware('auth.jwt', ['except' => ['login', 'register']]);
        $this->authService = $authService;
    }

    /**
     * Register a new user
     * @param AuthRegisterRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(AuthRegisterRequest $request)
    {
        try {
            $validated_data = $request->validated();
            $user = $this->authService->register($validated_data);
            return response()->json($user, 201);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }
    /**
     * log the user, return a JWT token if the credentials are correct
     * @param AuthLoginRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(AuthLoginRequest $request)
    {
        try {
            $credentials = $request->only(['email', 'password']);
            $response = $this->authService->login($credentials);
            return response()->json(
                [
                    'Message' => "Usuario logueado exitosamente",
                    'User' => $response['user']
                ],
                200
            )->cookie('sessionId', $response['token'], 0, '/', null, true, true);
        } catch (AuthenticationException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }
    /**
     * Log the user out (Invalidate the token).
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        try {
            $cookie = $request->cookie('sessionId');
            if (!$cookie) {
                return response()->json(['message' => 'Token no encontrado'], 401);
            }

            $this->authService->logout($cookie);

            return response()->json(['message' => 'Usuario deslogueado exitosamente'], 200)
                ->cookie('sessionId', '', -1, '/', null, true, true);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }
    /**
     * Refresh a token.
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh(Request $request)
    {
        try {
            $cookie = $request->cookie('sessionId');
            if (!$cookie) {
                return response()->json(['message' => 'Token no encontrado'], 401);
            } else {
                $newToken = $this->authService->refresh();
                return response()->json(['message' => "Usuario con token valido"], 200)
                    ->cookie('sessionId', $newToken, 0, '/', null, true, true);
            }
        } catch (Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }
    /**
     * Get the authenticated User.
     * @return \Illuminate\Http\JsonResponse
     */
    public function loggedUser()
    {
        try {
            $user = $this->authService->loggedUser();
            return response()->json($user, 200);
        } catch (AuthenticationException $e) {
            return response()->json(['message' => 'No autenticado'], 401);
        } catch (Exception $e) {
            return response()->json(['message' => 'Error en el servidor'], 500);
        }
    }
}
