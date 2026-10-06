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
            'usuario' => [
                'id' => $usuario->id,
                'nome' => $usuario->nome,
                'email' => $usuario->email,
            ],
        ], 200);
    }

    public function editar(Request $request)
    {
        $usuario = $request->attributes->get('usuario_autenticado');

        return view('editar_usuario', compact('usuario'));
    }

    public function atualizar(Request $request)
    {
        $usuario = $request->attributes->get('usuario_autenticado');

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email,' . $usuario->id,
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:usuario,cpf,' . $usuario->id,
            'senha' => 'nullable|string|min:6',
        ]);

        $usuario->nome = $request->nome;
        $usuario->email = $request->email;
        $usuario->data_nascimento = $request->data_nascimento;
        $usuario->cpf = $request->cpf;

        if ($request->filled('senha')) {
            $usuario->senha = bcrypt($request->senha);
        }

        $usuario->save();

        return redirect()->route('home')->with('sucesso', 'Dados atualizados com sucesso!');
    }

    public function excluir(Request $request)
    {
        $usuario = $request->attributes->get('usuario_autenticado');

        $usuario->delete();

        if ($request->hasSession()) {
            $request->session()->flush();
        }

        return redirect()->route('cadastro_usuario')->with('sucesso', 'Conta excluída com sucesso.');
    }

        public function api_index(Request $request)
    {
        $usuarios = Usuario::select('id', 'nome', 'email', 'cpf', 'data_nascimento')
            ->orderBy('nome')
            ->get();

        return response()->json([
            'erro' => 'n',
            'usuarios' => $usuarios,
        ]);
    }

    public function api_atualizar(Request $request, $id)
    {
        $usuarioLogado = $request->attributes->get('usuario_autenticado');

        if ((int) $id !== $usuarioLogado->id) {
            return response()->json([
                'erro' => 's',
                'mensagem' => 'Você só pode editar sua própria conta.',
            ], 403);
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'required|email|unique:usuario,email,' . $usuarioLogado->id,
            'data_nascimento' => 'required|date',
            'cpf' => 'required|string|max:14|unique:usuario,cpf,' . $usuarioLogado->id,
            'senha' => 'nullable|string|min:6',
        ]);

        $usuarioLogado->nome = $request->nome;
        $usuarioLogado->email = $request->email;
        $usuarioLogado->data_nascimento = $request->data_nascimento;
        $usuarioLogado->cpf = $request->cpf;

        if ($request->filled('senha')) {
            $usuarioLogado->senha = bcrypt($request->senha);
        }

        $usuarioLogado->save();

        return response()->json([
            'erro' => 'n',
            'mensagem' => 'Dados atualizados com sucesso!',
        ]);
    }

    public function api_excluir(Request $request, $id)
    {
        $usuarioLogado = $request->attributes->get('usuario_autenticado');

        if ((int) $id !== $usuarioLogado->id) {
            return response()->json([
                'erro' => 's',
                'mensagem' => 'Você só pode excluir sua própria conta.',
            ], 403);
        }

        $usuarioLogado->delete();

        return response()->json([
            'erro' => 'n',
            'mensagem' => 'Conta excluída com sucesso.',
        ]);
    }
}