<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\NotaController;
use App\Http\Controllers\PermisoDocController;

Route::prefix('v1')->group(function () {
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('login', 'login')->name('auth.login');
        //  Unicamente un superadmin podra registrar usuarios
        Route::post('register', 'register')->name('auth.register');
    });

    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::post('logout', 'logout')->name('auth.logout');
        Route::post('refresh', 'refresh')->name('auth.refresh');
        Route::get('me', 'loggedUser')->name('auth.me');
    });

    Route::middleware('auth.jwt')->group(function () {
        Route::apiResource('permisos-doc', PermisoDocController::class);
        Route::apiResource('eventos', EventoController::class);
        Route::get('usuarios/estudio', UsuarioController::class . '@indexByEstudio');
        Route::apiResource('usuarios', UsuarioController::class);
        Route::apiResource('estudios', EstudioController::class);
        Route::apiResource('roles', RolController::class);
        Route::apiResource('notas', NotaController::class);
    });
});
