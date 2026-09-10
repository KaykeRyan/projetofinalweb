<?php

namespace App\Http\Controllers;

use App\Models\TokenUsuario;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UsuarioController extends Controller
{
    public function cadastro_usuario(Request $request)
    {
        return view('cadastro_usuario');
    }

    public function cadastro_usuario_post(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email',
            'senha' => 'required|string|min:6',
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14',
        ]);

        $usuarioExistente = Usuario::where('email', $request->email)->first();

        if ($usuarioExistente) {
            if (! Hash::check($request->senha, $usuarioExistente->senha)) {
                return response()->json([
                    'erro' => 's',
                    'mensagem' => 'Email já cadastrado. Confirme a senha para continuar.',
                ], 200);
            }

            return $this->criarTokenESessao($request, $usuarioExistente, 'Email confirmado com sucesso');
        }

        if (Usuario::where('cpf', $request->cpf)->exists()) {
            return response()->json([
                'erro' => 's',
                'mensagem' => 'CPF já cadastrado',
            ], 200);
        }

        try {
            $usuario = new Usuario;
            $usuario->nome = $request->nome;
            $usuario->email = $request->email;
            $usuario->senha = bcrypt($request->senha);
            $usuario->data_nascimento = $request->data_nascimento;
            $usuario->cpf = $request->cpf;
            $usuario->save();

            return $this->criarTokenESessao($request, $usuario, 'Usuário cadastrado com sucesso');
        } catch (\Exception $e) {
            return response()->json(['erro' => 's', 'mensagem' => 'Erro ao cadastrar usuário. Tente novamente.'], 200);
        }

    }

    private function criarTokenESessao(Request $request, Usuario $usuario, string $mensagem)
    {
        TokenUsuario::where('usuario_id', $usuario->id)->delete();

        $token = Str::random(60);

        TokenUsuario::create([
            'usuario_id' => $usuario->id,
            'token' => $token,
            'valido_ate' => Carbon::now()->addDays(7),
        ]);

        if ($request->hasSession()) {
            $request->session()->put('token_usuario', $token);
        }

        return response()->json([
            'erro' => 'n',
            'mensagem' => $mensagem,
            'token' => $token,
        ], 200);
    }
}
