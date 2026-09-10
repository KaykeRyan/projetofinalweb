<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <style>
        body {
            align-items: center;
            background: #f4f7fb;
            color: #1f2937;
            display: flex;
            font-family: Arial, sans-serif;
            justify-content: center;
            margin: 0;
            min-height: 100vh;
        }
        main {
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 12px 30px rgba(31, 41, 55, 0.12);
            max-width: 560px;
            padding: 48px;
            text-align: center;
            width: calc(100% - 48px);
        }
        h1 { color: #2563eb; margin-top: 0; }
        .info { text-align: left; margin-top: 24px; }
        .info p { margin: 6px 0; }
    </style>
</head>
<body>
    <main>
        <h1>Bem-vindo, {{ $usuario->nome ?? 'Usuário' }}!</h1>
        <p>Seu cadastro foi confirmado e seu acesso está liberado.</p>

        <div class="info">
            <p><strong>Nome:</strong> {{ $usuario->nome ?? '-' }}</p>
            <p><strong>Email:</strong> {{ $usuario->email ?? '-' }}</p>
            <p><strong>CPF:</strong> {{ $usuario->cpf ?? '-' }}</p>
            <p><strong>Data de nascimento:</strong> {{ $usuario->data_nascimento ?? '-' }}</p>
        </div>
    </main>
</body>
</html>