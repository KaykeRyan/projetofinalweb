<?php

namespace App\Http\Controllers;

use App\Models\Bloco;
use App\Models\Local;
use App\Models\TipoLocal;
use Illuminate\Http\Request;

class LocalController extends Controller
{
    public function cadastro_local(Request $request)
    {
        $blocos = Bloco::orderBy('nome')->get();
        $tipos = TipoLocal::orderBy('nome')->get();

        return view('cadastro_local', [
            'blocos' => $blocos,
            'tipos' => $tipos,
        ]);
    }

    public function cadastro_local_post(Request $request)
    {
        $request->validate([
            'bloco_id' => 'required|exists:bloco,id',
            'tipo_local_id' => 'required|exists:tipo_local,id',
            'nome' => 'required|string|max:100',
        ]);

        $existente = Local::where('bloco_id', $request->bloco_id)
            ->where('nome', $request->nome)
            ->first();

        if ($existente) {
            return response()->json([
                'erro' => 's',
                'mensagem' => 'Já existe uma sala com esse nome nesse bloco.',
            ], 200);
        }

        try {
            $usuario = $request->attributes->get('usuario_autenticado');

            $local = new Local;
            $local->usuario_id = $usuario->id;
            $local->bloco_id = $request->bloco_id;
            $local->tipo_local_id = $request->tipo_local_id;
            $local->nome = $request->nome;
            $local->identificador = $request->identificador;
            $local->ativo = true;
            $local->save();

            if ($request->hasSession()) {
                $request->session()->put('local_id', $local->id);
            }

            return response()->json([
                'erro' => 'n',
                'mensagem' => 'Sala cadastrada com sucesso',
                'local' => $local,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'erro' => 's',
                'mensagem' => 'Erro ao cadastrar sala. Tente novamente.',
            ], 200);
        }
    }

    public function editar(Request $request, $id)
    {
        $usuario = $request->attributes->get('usuario_autenticado');
        $local = Local::with(['bloco', 'tipoLocal'])->findOrFail($id);

        if ($local->usuario_id !== $usuario->id) {
            abort(403, 'Você não tem permissão para editar esta sala.');
        }

        $blocos = Bloco::orderBy('nome')->get();
        $tipos = TipoLocal::orderBy('nome')->get();

        return view('editar_local', compact('local', 'blocos', 'tipos'));
    }

    public function atualizar(Request $request, $id)
    {
        $usuario = $request->attributes->get('usuario_autenticado');
        $local = Local::findOrFail($id);

        if ($local->usuario_id !== $usuario->id) {
            abort(403, 'Você não tem permissão para editar esta sala.');
        }

        $request->validate([
            'bloco_id' => 'required|exists:bloco,id',
            'tipo_local_id' => 'required|exists:tipo_local,id',
            'nome' => 'required|string|max:100',
        ]);

        $local->bloco_id = $request->bloco_id;
        $local->tipo_local_id = $request->tipo_local_id;
        $local->nome = $request->nome;
        $local->identificador = $request->identificador;
        $local->save();

        return redirect()->route('home')->with('sucesso', 'Sala atualizada com sucesso!');
    }

    public function excluir(Request $request, $id)
    {
        $usuario = $request->attributes->get('usuario_autenticado');
        $local = Local::findOrFail($id);

        if ($local->usuario_id !== $usuario->id) {
            abort(403, 'Você não tem permissão para excluir esta sala.');
        }

        if ($request->hasSession() && $request->session()->get('local_id') == $local->id) {
            $request->session()->forget('local_id');
        }

        $local->delete();

        return redirect()->route('home')->with('sucesso', 'Sala excluída com sucesso!');
    }



        public function api_index(Request $request)
    {
        $usuario = $request->attributes->get('usuario_autenticado');

        $salas = Local::with(['bloco', 'tipoLocal'])
            ->where('usuario_id', $usuario->id)
            ->orderBy('nome')
            ->get();

        return response()->json([
            'erro' => 'n',
            'salas' => $salas,
        ]);
    }

    public function api_atualizar(Request $request, $id)
    {
        $usuario = $request->attributes->get('usuario_autenticado');
        $local = Local::find($id);

        if (! $local) {
            return response()->json(['erro' => 's', 'mensagem' => 'Sala não encontrada.'], 404);
        }

        if ($local->usuario_id !== $usuario->id) {
            return response()->json(['erro' => 's', 'mensagem' => 'Você só pode editar suas próprias salas.'], 403);
        }

        $request->validate([
            'bloco_id' => 'required|exists:bloco,id',
            'tipo_local_id' => 'required|exists:tipo_local,id',
            'nome' => 'required|string|max:100',
        ]);

        $local->bloco_id = $request->bloco_id;
        $local->tipo_local_id = $request->tipo_local_id;
        $local->nome = $request->nome;
        $local->identificador = $request->identificador;
        $local->save();

        return response()->json([
            'erro' => 'n',
            'mensagem' => 'Sala atualizada com sucesso!',
        ]);
    }

    public function api_excluir(Request $request, $id)
    {
        $usuario = $request->attributes->get('usuario_autenticado');
        $local = Local::find($id);

        if (! $local) {
            return response()->json(['erro' => 's', 'mensagem' => 'Sala não encontrada.'], 404);
        }

        if ($local->usuario_id !== $usuario->id) {
            return response()->json(['erro' => 's', 'mensagem' => 'Você só pode excluir suas próprias salas.'], 403);
        }

        if ($request->hasSession() && $request->session()->get('local_id') == $local->id) {
            $request->session()->forget('local_id');
        }

        $local->delete();

        return response()->json([
            'erro' => 'n',
            'mensagem' => 'Sala excluída com sucesso.',
        ]);
    }

    public function api_blocos(Request $request)
    {
        return response()->json([
            'erro' => 'n',
            'blocos' => Bloco::orderBy('nome')->get(),
        ]);
    }

    public function api_tipos(Request $request)
    {
        return response()->json([
            'erro' => 'n',
            'tipos' => TipoLocal::orderBy('nome')->get(),
        ]);
    }
}