<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EstudioController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('v1/estudios', [EstudioController::class, 'index']);
Route::get('v1/estudios/{id}', [EstudioController::class, 'show']);
Route::post('v1/estudios', [EstudioController::class, 'store']);
Route::put('v1/estudios/{id}', [EstudioController::class, 'update']);
Route::delete('v1/estudios/{id}', [EstudioController::class, 'destroy']);
