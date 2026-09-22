<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/cadastro_usuario', [UsuarioController::class, 'cadastro_usuario_post']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->middleware('token.usuario');

Route::get('/usuarios', [UsuarioController::class, 'api_index'])->middleware('token.usuario');
Route::put('/usuarios/{id}', [UsuarioController::class, 'api_atualizar'])->middleware('token.usuario');
Route::delete('/usuarios/{id}', [UsuarioController::class, 'api_excluir'])->middleware('token.usuario');
Route::get('/minhas_salas', [LocalController::class, 'api_index'])->middleware('token.usuario');
Route::put('/minhas_salas/{id}', [LocalController::class, 'api_atualizar'])->middleware('token.usuario');
Route::delete('/minhas_salas/{id}', [LocalController::class, 'api_excluir'])->middleware('token.usuario');
Route::get('/blocos', [LocalController::class, 'api_blocos'])->middleware('token.usuario');
Route::get('/tipos_local', [LocalController::class, 'api_tipos'])->middleware('token.usuario');