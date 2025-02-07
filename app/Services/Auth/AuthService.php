<?php

namespace App\Services\Auth;

use App\Repositories\UsuarioRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;
use App\Models\Usuario;
use Exception;



class AuthService
{
    protected $usuarioRepository;

    public function __construct(UsuarioRepository $usuarioRepository)
    {
        $this->usuarioRepository = $usuarioRepository;
    }

    /**
     * Registra a un nuevo usuario
     * @param array $validated_data
     * @return \App\Models\Usuario
     */
    public function register($validated_data)
    {
        $validated_data['password'] = Hash::make($validated_data['password']);
        return $this->usuarioRepository->createUsuario($validated_data);
    }
    /**
     * Inicia sesión de un usuario
     * @param array $credentials
     * @return array $token, $user
     */
    public function login($credentials)
    {
        $user = Usuario::where('email', $credentials['email'])->first();
        if (!$user || !Hash::check($credentials['password'], $user->password)) {
            throw new Exception('Credenciales incorrectas');
        }
        $token = JWTAuth::fromUser($user);
        $encodedToken = base64_encode($token);
        return ['token' => $encodedToken, 'user' => $user];
    }
    /**
     * Desloguea a un usuario
     * @return void
     */
    public function logout()
    {
        Auth::logout();
    }
    /**
     * Refresca el token de un usuario
     * @return array $token, $user
     */
    public function refresh()
    {
        Auth::refresh();
        $user = Auth::user();
        return ['token' => Auth::getToken(), 'user' => $user];
    }
}
