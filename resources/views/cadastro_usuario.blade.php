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

    @vite(['resources/js/app.js'])

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

        /* Estilo dos inputs */
        .form-control {
            background-color: #0a0a0a !important;
            border: 1px solid #333 !important;
            color: #ffffff !important;
            border-radius: 8px !important;
            padding: 12px 16px !important;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            background-color: #0a0a0a !important;
            border-color: #ff1a1a !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 26, 26, 0.25) !important;
            color: #ffffff !important;
        }

        .form-control::placeholder {
            color: #666 !important;
        }

        /* Ajuste para o ícone do calendário no input de data */
        .form-control[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(1);
            opacity: 0.6;
            cursor: pointer;
        }

        /* Estilo do botão principal */
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

        /* =========================================
           NOVOS BOTÕES: MORTAL E MACACOS
           ========================================= */
        .btn-mortal,
        .btn-macacos {
            border-radius: 8px !important;
            padding: 12px 28px !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            color: #fff !important;
            border: 2px solid #ff4d4d !important;
        }

        .btn-mortal {
            background: linear-gradient(135deg, #ff1a1a 0%, #990000 100%) !important;
            box-shadow: 0 0 15px rgba(255, 26, 26, 0.5);
        }

        .btn-mortal:hover {
            background: linear-gradient(135deg, #ff3333 0%, #cc0000 100%) !important;
            box-shadow: 0 0 25px rgba(255, 26, 26, 0.9);
            transform: translateY(-2px);
        }

        .btn-macacos {
            background: linear-gradient(135deg, #8B5A2B 0%, #4a2c0a 100%) !important;
            border-color: #c98a3c !important;
            box-shadow: 0 0 15px rgba(201, 138, 60, 0.5);
        }

        .btn-macacos:hover {
            background: linear-gradient(135deg, #a56b36 0%, #5c3810 100%) !important;
            box-shadow: 0 0 25px rgba(201, 138, 60, 0.9);
            transform: translateY(-2px);
        }

        .btn-mortal:active,
        .btn-macacos:active {
            transform: translateY(0) scale(0.97);
        }

        /* =========================================
           ANIMAÇÃO MORTAL (cambalhota 360º)
           ========================================= */
        @keyframes mortal {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .dando-mortal {
            animation: mortal 1s ease-in-out;
            transform-origin: center center;
        }

        /* =========================================
           MACACOS CORRENDO NA PARTE DE BAIXO
           ========================================= */
        .macaco-corredor {
            position: fixed;
            bottom: 10px;
            font-size: 3rem;
            z-index: 9999;
            pointer-events: none;
            user-select: none;
            animation: correrMacaco linear forwards;
            filter: drop-shadow(0 0 8px rgba(255, 26, 26, 0.6));
            will-change: transform;
        }

        @keyframes correrMacaco {
            0% {
                left: -80px;
                transform: scaleX(1) translateY(0) rotate(0deg);
            }
            25% {
                transform: scaleX(1) translateY(-25px) rotate(-10deg);
            }
            50% {
                transform: scaleX(1) translateY(0) rotate(0deg);
            }
            75% {
                transform: scaleX(1) translateY(-25px) rotate(10deg);
            }
            100% {
                left: 110vw;
                transform: scaleX(1) translateY(0) rotate(0deg);
            }
        }

        /* Ajuste para o SweetAlert2 (caso seja usado) */
        .swal2-popup {
            background-color: #141414 !important;
            color: #ffffff !important;
            border: 1px solid #333 !important;
        }
        .swal2-title {
            color: #ffffff !important;
        }
        .swal2-confirm {
            background-color: #ff1a1a !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h3 class="text-center mt-4 mb-4">Cadastro de Usuário</h3>

        <form id="form_cadastro" method="POST" action="{{ url('/cadastro_usuario') }}" class="row g-3 p-4 rounded">
            @csrf
            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite seu nome" required>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu email" required>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Mínimo 6 caracteres" minlength="6" required>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="data_nascimento" class="form-label">Data de nascimento:</label>
                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
            </div>

            <div class="col-lg-6 col-md-6 col-sm-12">
                <label for="cpf" class="form-label">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" placeholder="000.000.000-00" required>
            </div>

            <!-- Botões de ação -->
            <div class="col-12 mt-4">
                <div class="d-flex flex-wrap justify-content-end gap-3 align-items-center">
                    <button type="button" class="btn btn-mortal" id="btnMortal">🤸 Dar um Mortal</button>
                    <button type="button" class="btn btn-macacos" id="btnMacacos">🐒 Chuva de Macacos</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Script original mantido -->
    <script src="{{ asset('js/cadastro_usuario.js') }}"></script>

    <!-- Scripts das novas animações -->
    <script>
        (function () {
            /* ============================================
               BOTÃO MORTAL — gira a página 360º
               ============================================ */
            const btnMortal = document.getElementById('btnMortal');
            let girando = false;

            btnMortal.addEventListener('click', function () {
                if (girando) return;
                girando = true;
                document.body.classList.add('dando-mortal');

                setTimeout(function () {
                    document.body.classList.remove('dando-mortal');
                    girando = false;
                }, 1000);
            });

            /* ============================================
               BOTÃO MACACOS — vários macacos correndo
               por 20 segundos na parte de baixo da tela
               ============================================ */
            const btnMacacos = document.getElementById('btnMacacos');
            const EMOJIS = ['🐒', '🐵', '🙈', '🙉', '🙊', '🦧'];
            let macacosAtivos = false;

            function criarMacaco() {
                const macaco = document.createElement('div');
                macaco.classList.add('macaco-corredor');
                macaco.textContent = EMOJIS[Math.floor(Math.random() * EMOJIS.length)];

                // Posição vertical (parte de baixo, com leve variação)
                const bottomOffset = 5 + Math.random() * 60; // px
                macaco.style.bottom = bottomOffset + 'px';

                // Tamanho variado
                const tamanho = 2 + Math.random() * 2.5; // rem
                macaco.style.fontSize = tamanho + 'rem';

                // Duração da corrida (velocidade variada)
                const duracao = 4 + Math.random() * 4; // 4 a 8 segundos
                macaco.style.animationDuration = duracao + 's';

                // Atraso inicial aleatório
                macaco.style.animationDelay = (Math.random() * 1.5) + 's';

                // Aplica a animação
                document.body.appendChild(macaco);

                // Remove o macaco após a animação terminar
                setTimeout(function () {
                    if (macaco.parentNode) {
                        macaco.parentNode.removeChild(macaco);
                    }
                }, (duracao + 2) * 1000);
            }

            btnMacacos.addEventListener('click', function () {
                if (macacosAtivos) return;
                macacosAtivos = true;
                btnMacacos.disabled = true;

                // Duração total: 20 segundos
                const DURACAO_TOTAL = 20000;
                const inicio = Date.now();

                // Cria um macaco a cada 350ms enquanto durar os 20s
                const intervalo = setInterval(function () {
                    if (Date.now() - inicio >= DURACAO_TOTAL) {
                        clearInterval(intervalo);
                        return;
                    }
                    // Cria de 1 a 2 macacos por vez para dar sensação de "vários"
                    criarMacaco();
                    if (Math.random() > 0.5) criarMacaco();
                }, 350);

                // Reabilita o botão após os 20 segundos
                setTimeout(function () {
                    macacosAtivos = false;
                    btnMacacos.disabled = false;
                }, DURACAO_TOTAL);
            });
        })();
    </script>
</body>
</html>