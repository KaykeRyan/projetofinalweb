<?php

namespace App\Http\Controllers;

use App\Models\Local;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        // Esse atributo é setado pelo TokenUsuarioMiddleware
        $usuario = $request->attributes->get('usuario_autenticado');

        $local = null;
        if ($request->hasSession() && $request->session()->has('local_id')) {
            $local = Local::with(['bloco', 'tipoLocal'])
                ->find($request->session()->get('local_id'));
        }

        return view('home', [
            'usuario' => $usuario,
            'local' => $local,
        ]);
    }
}