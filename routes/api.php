<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;

// Estudio
Route::get('v1/estudios', [EstudioController::class, 'index']);
Route::get('v1/estudios/{id}', [EstudioController::class, 'show']);
Route::post('v1/estudios', [EstudioController::class, 'store']);
Route::put('v1/estudios/{id}', [EstudioController::class, 'update']);
Route::delete('v1/estudios/{id}', [EstudioController::class, 'destroy']);
// Rol
Route::get('v1/roles', [RolController::class, 'index']);
Route::get('v1/roles/{id}', [RolController::class, 'show']);
Route::post('v1/roles', [RolController::class, 'store']);
Route::put('v1/roles/{id}', [RolController::class, 'update']);
Route::delete('v1/roles/{id}', [RolController::class, 'destroy']);
// Usuario
Route::get('v1/usuarios', [UsuarioController::class, 'index']);
Route::get('v1/usuarios/{id}', [UsuarioController::class, 'show']);
Route::post('v1/usuarios', [UsuarioController::class, 'store']);
Route::put('v1/usuarios/{id}', [UsuarioController::class, 'update']);
Route::delete('v1/usuarios/{id}', [UsuarioController::class, 'destroy']);

// Auth
Route::post('v1/auth/register', [AuthController::class, 'register']);
Route::post('v1/auth/login', [AuthController::class, 'login']);
Route::post('v1/auth/logout', [AuthController::class, 'logout']);
Route::post('v1/auth/refresh', [AuthController::class, 'refresh']);
