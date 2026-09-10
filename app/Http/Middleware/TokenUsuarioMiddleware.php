<?php

namespace App\Http\Middleware;

use App\Models\TokenUsuario;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;

class TokenUsuarioMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (! $token && $request->hasSession()) {
            $token = $request->session()->get('token_usuario');
        }

        if (! $token) {
            return $this->unauthorizedResponse($request, 'Token não informado');
        }

        $tokenUsuario = TokenUsuario::where('token', $token)->first();

        if (! $tokenUsuario) {
            return $this->unauthorizedResponse($request, 'Token inválido');
        }

        if (Carbon::now()->greaterThan($tokenUsuario->valido_ate)) {
            $tokenUsuario->delete();
            if ($request->hasSession()) {
                $request->session()->forget('token_usuario');
            }

            return $this->unauthorizedResponse($request, 'Token expirado');
        }

        $request->attributes->set('usuario_autenticado', $tokenUsuario->usuario);

        return $next($request);
    }

    private function unauthorizedResponse(Request $request, string $mensagem)
    {
        if (! $request->expectsJson()) {
            return redirect()->route('cadastro_usuario');
        }

        return response()->json(['erro' => 's', 'mensagem' => $mensagem], 401);
    }
}
