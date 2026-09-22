<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0a0a0a; color: #fff; padding: 40px 0; }
        .form-label { color: #b0b0b0; }
        .form-control { background-color: #141414; border: 1px solid #333; color: #fff; }
        .form-control:focus { background-color: #141414; color: #fff; border-color: #ff1a1a; box-shadow: none; }
        .btn-primary { background-color: #ff1a1a; border: none; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h3 class="mb-4">Editar Usuário</h3>

        <form method="POST" action="{{ route('usuario.atualizar') }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $usuario->nome }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Data de nascimento</label>
                <input type="date" name="data_nascimento" class="form-control" value="{{ $usuario->data_nascimento }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">CPF</label>
                <input type="text" name="cpf" class="form-control" value="{{ $usuario->cpf }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Nova senha (deixe em branco para manter a atual)</label>
                <input type="password" name="senha" class="form-control" minlength="6">
            </div>

            <button type="submit" class="btn btn-primary w-100">Salvar alterações</button>
            <a href="{{ route('home') }}" class="btn btn-outline-light w-100 mt-2">Cancelar</a>
        </form>
    </div>
</body>
</html>