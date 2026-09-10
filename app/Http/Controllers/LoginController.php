<?php

namespace App\Http\Controllers;

use App\Models\TokenUsuario;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'senha' => 'required|string',
        ]);

        $usuario = Usuario::where('email', $request->email)->first();

        if (! $usuario || ! Hash::check($request->senha, $usuario->senha)) {
            return response()->json([
                'erro' => 's',
                'mensagem' => 'Email ou senha inválidos',
            ], 200);
        }

        // Remove tokens antigos do usuário
        TokenUsuario::where('usuario_id', $usuario->id)->delete();

        $token = Str::random(60);

        TokenUsuario::create([
            'usuario_id' => $usuario->id,
            'token' => $token,
            'valido_ate' => Carbon::now()->addDays(7),
        ]);

        return response()->json([
            'erro' => 'n',
            'mensagem' => 'Login realizado com sucesso',
            'token' => $token,
            'usuario' => [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
            ],
        ], 200);
    }

    public function logout(Request $request)
    {
        $token = $request->bearerToken();

        if ($token) {
            TokenUsuario::where('token', $token)->delete();
        }

        return response()->json(['erro' => 'n', 'mensagem' => 'Logout realizado com sucesso'], 200);
    }
}
