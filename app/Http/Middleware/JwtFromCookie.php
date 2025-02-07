<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;  // Importa la clase correcta de la librería
use Illuminate\Support\Facades\Auth;

class JwtFromCookie
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $token = $request->cookie('sessionId');
            if (!$token) {
                return response()->json(['error' => 'Token not provided. Please log in to access this resource.'], 401);
            }
            $decodedToken = base64_decode($token);
            $tokenValid = JWTAuth::setToken($decodedToken)->authenticate();
            if (!$tokenValid) {
                return response()->json(['error' => 'Token is invalid. Please log in again.'], 401);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token authentication failed'], 500);
        }
        return $next($request);
    }
}
