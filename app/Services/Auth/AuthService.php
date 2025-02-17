<?php

namespace App\Services\Auth;

use App\Services\UsuarioService;
use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\AuthenticationException;
use Exception;

class AuthService
{
    protected $usuarioRepository;
    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * Register a new user. Solamente un superadmin podra registrar usuarios (la idea es no utilizar este metodo)
     * @param array $usuarioData
     * @return \App\Models\Usuario
     */
    public function register(array $usuarioData)
    {
        $usuarioData['password'] = bcrypt($usuarioData['password']);
        $usuarioData['estudio_id'] = NULL;
        return $this->usuarioRepository->createUsuario($usuarioData);
    }

    /**
     * Log the user in
     * @param array $credentials
     * @return array
     * @throws AuthenticationException
     */
    public function login(array $credentials): array
    {
        if (!$token = Auth::attempt($credentials)) {
            throw new AuthenticationException('Credenciales incorrectas');
        }

        return [
            'token' => base64_encode($token),
            'user' => Auth::user()
        ];
    }


    /**
     * Log the user out
     * @param string $cookie
     * @throws Exception
     */
    public function logout(string $cookie): void
    {
        $decodedToken = base64_decode($cookie, true);

        if (!$decodedToken) {
            throw new Exception('Token inválido');
        }

        Auth::setToken($decodedToken);
        Auth::invalidate();
    }

    /**
     * Refresh the token
     * @return string
     */
    public function refresh(): string
    {
        $tokenRefreshed = Auth::refresh();
        return base64_encode($tokenRefreshed);
    }

    /**
     * Get the authenticated user
     * @return \App\Models\Usuario
     */
    public function loggedUser()
    {
        return Auth::user();
    }
}
