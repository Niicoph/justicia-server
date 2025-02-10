<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EventoController;

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

    Route::apiResources([
        'estudios' => EstudioController::class,
        'roles' => RolController::class,
    ]);

    Route::middleware('auth.jwt')->group(function () {
        Route::apiResource('eventos', EventoController::class);
        Route::apiResource('usuarios', UsuarioController::class);
    });
});
