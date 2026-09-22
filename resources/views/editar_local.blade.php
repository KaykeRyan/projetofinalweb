<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Sala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #0a0a0a; color: #fff; padding: 40px 0; }
        .form-label { color: #b0b0b0; }
        .form-control, .form-select { background-color: #141414; border: 1px solid #333; color: #fff; }
        .form-control:focus, .form-select:focus { background-color: #141414; color: #fff; border-color: #ff1a1a; box-shadow: none; }
        .btn-primary { background-color: #ff1a1a; border: none; }
    </style>
</head>
<body>
    <div class="container" style="max-width: 500px;">
        <h3 class="mb-4">Editar Sala</h3>

        <form method="POST" action="{{ route('local.atualizar', $local->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="form-label">Bloco</label>
                <select name="bloco_id" class="form-select" required>
                    @foreach ($blocos as $bloco)
                        <option value="{{ $bloco->id }}" @selected($bloco->id == $local->bloco_id)>{{ $bloco->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tipo de local</label>
                <select name="tipo_local_id" class="form-select" required>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}" @selected($tipo->id == $local->tipo_local_id)>{{ $tipo->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nome</label>
                <input type="text" name="nome" class="form-control" value="{{ $local->nome }}" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Identificador</label>
                <input type="text" name="identificador" class="form-control" value="{{ $local->identificador }}">
            </div>

            <button type="submit" class="btn btn-primary w-100">Salvar alterações</button>
            <a href="{{ route('home') }}" class="btn btn-outline-light w-100 mt-2">Cancelar</a>
        </form>
    </div>
</body>
</html>