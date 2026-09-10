<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Esse atributo é setado pelo TokenUsuarioMiddleware
        $usuario = $request->attributes->get('usuario_autenticado');

        return view('home', ['usuario' => $usuario]);
    }
}