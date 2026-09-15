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
            $local = new Local;
            $local->bloco_id = $request->bloco_id;
            $local->tipo_local_id = $request->tipo_local_id;
            $local->nome = $request->nome;
            $local->identificador = $request->identificador;
            $local->ativo = true;
            $local->save();

            // Guarda o local recém-cadastrado na sessão, para a Home exibir
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
}