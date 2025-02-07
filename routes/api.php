<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AuthController;


Route::prefix('v1')->group(function () {
    // Estudio
    Route::prefix('estudios')->controller(EstudioController::class)->group(function () {
        Route::get('/', 'index')->name('estudios.index');
        Route::get('{id}', 'show')->name('estudios.show');
        Route::post('/', 'store')->name('estudios.store');
        Route::put('{id}', 'update')->name('estudios.update');
        Route::delete('{id}', 'destroy')->name('estudios.destroy');
    });

    // Rol
    Route::prefix('roles')->controller(RolController::class)->group(function () {
        Route::get('/', 'index')->name('roles.index');
        Route::get('{id}', 'show')->name('roles.show');
        Route::post('/', 'store')->name('roles.store');
        Route::put('{id}', 'update')->name('roles.update');
        Route::delete('{id}', 'destroy')->name('roles.destroy');
    });

    // Usuario
    Route::prefix('usuarios')->controller(UsuarioController::class)->group(function () {
        Route::get('/', 'index')->name('usuarios.index');
        Route::get('{id}', 'show')->name('usuarios.show');
        Route::post('/', 'store')->name('usuarios.store');
        Route::put('{id}', 'update')->name('usuarios.update');
        Route::delete('{id}', 'destroy')->name('usuarios.destroy');
    });

    // Auth
    Route::prefix('auth')->middleware('api')->controller(AuthController::class)->group(function () {
        Route::post('login', 'login')->name('auth.login');
        Route::post('logout', 'logout')->name('auth.logout');
        Route::post('refresh', 'refresh')->name('auth.refresh');
        Route::post('me', 'loggedUser')->name('auth.me');
    });
});
