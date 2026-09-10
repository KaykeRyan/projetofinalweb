<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cadastro_usuario', [UsuarioController::class, 'cadastro_usuario']);
Route::post('/cadastro_usuario', [UsuarioController::class, 'cadastro_usuario_post']);

Route::get('/home', [HomeController::class, 'index'])->middleware('token.usuario')->name('home');