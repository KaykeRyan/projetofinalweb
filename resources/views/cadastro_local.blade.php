<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Sala</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        /* Estilos personalizados - Tema Escuro */
        body {
            background-color: #0a0a0a !important;
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            overflow-x: hidden;
            padding: 20px;
        }

        /* Detalhes visuais de canto (iguais à imagem de referência) */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 150px;
            height: 150px;
            border-top: 4px solid #ff1a1a;
            border-left: 4px solid #ff1a1a;
            opacity: 0.4;
            pointer-events: none;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -50px;
            right: -50px;
            width: 200px;
            height: 200px;
            border-bottom: 6px solid #ff1a1a;
            border-right: 6px solid #ff1a1a;
            opacity: 0.6;
            transform: rotate(45deg);
            pointer-events: none;
        }

        .container {
            position: relative;
            z-index: 1;
            width: 100%;
            max-width: 900px;
            padding: 0;
        }

        h3 {
            color: #ffffff !important;
            font-weight: 900 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 0 0 10px rgba(255, 26, 26, 0.5);
        }

        /* Estilo do formulário (card preto) */
        form {
            background-color: #141414 !important;
            border: 1px solid #333 !important;
            border-radius: 12px !important;
            box-shadow: 0 0 20px rgba(255, 26, 26, 0.2) !important;
        }

        .form-label {
            color: #b0b0b0 !important;
            font-weight: 500;
        }

        /* Estilo dos inputs e selects */
        .form-control, .form-select {
            background-color: #0a0a0a !important;
            border: 1px solid #333 !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
            transition: all 0.3s ease;
        }

        .form-control:focus, .form-select:focus {
            background-color: #0a0a0a !important;
            border-color: #ff1a1a !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 26, 26, 0.25) !important;
            color: #ffffff !important;
        }

        .form-control::placeholder {
            color: #666 !important;
        }

        /* Ajuste para as opções do select no fundo escuro */
        .form-select option {
            background-color: #141414;
            color: #ffffff;
        }

        /* Estilo do botão */
        .btn-primary {
            background-color: #ff1a1a !important;
            border: none !important;
            border-radius: 8px !important;
            padding: 12px 32px !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(255, 26, 26, 0.5);
        }

        .btn-primary:hover {
            background-color: #e60000 !important;
            box-shadow: 0 0 25px rgba(255, 26, 26, 0.8);
            transform: translateY(-2px);
        }

        .btn-primary:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-4 mb-4">Cadastro de Sala</h3>

        <form id="form_cadastro_local" method="POST" action="{{ url('/cadastro_local') }}" class="row g-3 p-4 rounded">
            @csrf

            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="bloco_id" class="form-label">Bloco:</label>
                <select class="form-select" id="bloco_id" name="bloco_id" required>
                    <option value="" selected disabled>Selecione o bloco</option>
                    @foreach ($blocos as $bloco)
                        <option value="{{ $bloco->id }}">{{ $bloco->nome }} — {{ $bloco->descricao }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="tipo_local_id" class="form-label">Tipo de sala:</label>
                <select class="form-select" id="tipo_local_id" name="tipo_local_id" required>
                    <option value="" selected disabled>Selecione o tipo</option>
                    @foreach ($tipos as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-lg-8 col-md-8 col-sm-12">
                <label for="nome" class="form-label">Nome da sala:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Ex: Sala de Informática 1" required>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <label for="identificador" class="form-label">Identificador (opcional):</label>
                <input type="text" class="form-control" id="identificador" name="identificador" placeholder="Ex: B4-SI1">
            </div>

            <div class="col-12 text-end mt-4">
                <button type="submit" class="btn btn-primary">Cadastrar Sala</button>
            </div>
        </form>
    </div>
    
    <!-- Script original mantido -->
    <script src="{{ asset('js/cadastro_local.js') }}"></script>
</body>
</html>