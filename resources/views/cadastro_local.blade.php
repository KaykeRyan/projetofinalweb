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
           NOVOS BOTÕES
           ========================================= */
        .btn-mortal-escorregar,
        .btn-macaco-xinga {
            border-radius: 8px !important;
            padding: 12px 28px !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            color: #fff !important;
            border: 2px solid #ff4d4d !important;
        }

        .btn-mortal-escorregar {
            background: linear-gradient(135deg, #ff1a1a 0%, #990000 100%) !important;
            box-shadow: 0 0 15px rgba(255, 26, 26, 0.5);
        }

        .btn-mortal-escorregar:hover {
            background: linear-gradient(135deg, #ff3333 0%, #cc0000 100%) !important;
            box-shadow: 0 0 25px rgba(255, 26, 26, 0.9);
            transform: translateY(-2px);
        }

        .btn-macaco-xinga {
            background: linear-gradient(135deg, #8B5A2B 0%, #4a2c0a 100%) !important;
            border-color: #c98a3c !important;
            box-shadow: 0 0 15px rgba(201, 138, 60, 0.5);
        }

        .btn-macaco-xinga:hover {
            background: linear-gradient(135deg, #a56b36 0%, #5c3810 100%) !important;
            box-shadow: 0 0 25px rgba(201, 138, 60, 0.9);
            transform: translateY(-2px);
        }

        .btn-mortal-escorregar:active,
        .btn-macaco-xinga:active {
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
           ESCORREGAR PARA BAIXO
           ========================================= */
        .escorregando {
            animation: escorregarBaixo 2s ease-in-out forwards;
        }

        @keyframes escorregarBaixo {
            0%   { transform: translateY(0); }
            100% { transform: translateY(100vh); }
        }

        /* Espaço extra que aparece após escorregar */
        .abismo {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background: radial-gradient(circle at center, #1a0000 0%, #000000 100%);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 9998;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.5s ease;
        }

        .abismo.visivel {
            opacity: 1;
            pointer-events: auto;
        }

        .abismo h2 {
            color: #ff1a1a;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 4px;
            font-size: 3rem;
            text-shadow: 0 0 30px rgba(255, 26, 26, 0.9);
            margin-bottom: 20px;
            text-align: center;
        }

        .abismo p {
            color: #b0b0b0;
            font-size: 1.2rem;
            margin-bottom: 30px;
            text-align: center;
        }

        .btn-voltar {
            background: linear-gradient(135deg, #ff1a1a 0%, #990000 100%) !important;
            color: #fff !important;
            border: 2px solid #ff4d4d !important;
            border-radius: 50px !important;
            padding: 12px 32px !important;
            font-weight: 700 !important;
            text-transform: uppercase;
            letter-spacing: 2px;
            box-shadow: 0 0 20px rgba(255, 26, 26, 0.6);
            transition: all 0.3s ease;
        }

        .btn-voltar:hover {
            transform: scale(1.08);
            box-shadow: 0 0 35px rgba(255, 26, 26, 0.9);
        }

        /* =========================================
           MACACO XINGANDO
           ========================================= */
        .macaco-xingao-wrapper {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            display: flex;
            align-items: flex-end;
            gap: 15px;
            opacity: 0;
            transform: translateY(50px) scale(0.5);
            transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
            pointer-events: none;
        }

        .macaco-xingao-wrapper.visivel {
            opacity: 1;
            transform: translateY(0) scale(1);
            pointer-events: auto;
        }

        .macaco-emoji {
            font-size: 5rem;
            animation: balancarMacaco 1.5s ease-in-out infinite;
            filter: drop-shadow(0 0 15px rgba(255, 26, 26, 0.7));
        }

        @keyframes balancarMacaco {
            0%, 100% { transform: rotate(-5deg); }
            50%      { transform: rotate(5deg); }
        }

        .balao-fala {
            background-color: #141414;
            border: 2px solid #ff1a1a;
            border-radius: 16px;
            padding: 18px 22px;
            max-width: 320px;
            box-shadow: 0 0 30px rgba(255, 26, 26, 0.5);
            position: relative;
        }

        .balao-fala::after {
            content: '';
            position: absolute;
            bottom: 20px;
            left: -14px;
            width: 0;
            height: 0;
            border-top: 12px solid transparent;
            border-bottom: 12px solid transparent;
            border-right: 14px solid #ff1a1a;
        }

        .balao-fala::before {
            content: '';
            position: absolute;
            bottom: 22px;
            left: -11px;
            width: 0;
            height: 0;
            border-top: 10px solid transparent;
            border-bottom: 10px solid transparent;
            border-right: 12px solid #141414;
            z-index: 1;
        }

        .balao-fala p {
            color: #ffffff;
            font-weight: 700;
            font-size: 1rem;
            margin: 0;
            line-height: 1.5;
        }

        .balao-fala .fechar-xinga {
            position: absolute;
            top: -10px;
            right: -10px;
            background: #ff1a1a;
            color: #fff;
            border: none;
            border-radius: 50%;
            width: 28px;
            height: 28px;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 0 10px rgba(255, 26, 26, 0.8);
            transition: all 0.2s ease;
        }

        .balao-fala .fechar-xinga:hover {
            transform: scale(1.15);
            background: #e60000;
        }
    </style>
</head>
<body>
    <div class="container" id="conteudoPrincipal">
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

            <!-- Botões de ação -->
            <div class="col-12 mt-4">
                <div class="d-flex flex-wrap justify-content-end gap-3 align-items-center">
                    <button type="button" class="btn btn-mortal-escorregar" id="btnMortalEscorregar">🤸 Mortal + Escorregar</button>
                    <button type="button" class="btn btn-macaco-xinga" id="btnMacacoXinga">🐒 Macaco Xingando</button>
                    <button type="submit" class="btn btn-primary">Cadastrar Sala</button>
                </div>
            </div>
        </form>
    </div>

    <!-- Abismo (aparece após escorregar) -->
    <div class="abismo" id="abismo">
        <h2>🕳️ Você caiu no abismo!</h2>
        <p>Brincadeira 😄 — clique abaixo para voltar.</p>
        <button type="button" class="btn btn-voltar" id="btnVoltar">Voltar</button>
    </div>

    <!-- Macaco xingando -->
    <div class="macaco-xingao-wrapper" id="macacoXingao">
        <div class="balao-fala">
            <button type="button" class="fechar-xinga" id="fecharXinga" aria-label="Fechar">×</button>
            <p id="textoXinga">Seu macaco!</p>
        </div>
        <div class="macaco-emoji">🐒</div>
    </div>

    <!-- Script original mantido -->
    <script src="{{ asset('js/cadastro_local.js') }}"></script>

    <!-- Scripts das novas animações -->
    <script>
        (function () {
            /* ============================================
               BOTÃO 1: MORTAL + ESCORREGAR
               ============================================ */
            const btnMortalEscorregar = document.getElementById('btnMortalEscorregar');
            const conteudoPrincipal = document.getElementById('conteudoPrincipal');
            const abismo = document.getElementById('abismo');
            const btnVoltar = document.getElementById('btnVoltar');
            let animando = false;

            btnMortalEscorregar.addEventListener('click', function () {
                if (animando) return;
                animando = true;

                // 1) Dá o mortal
                document.body.classList.add('dando-mortal');

                // 2) Após o mortal (1s), escorrega para baixo
                setTimeout(function () {
                    document.body.classList.remove('dando-mortal');
                    conteudoPrincipal.classList.add('escorregando');
                }, 1000);

                // 3) Após escorregar (1s + 2s = 3s), mostra o abismo
                setTimeout(function () {
                    abismo.classList.add('visivel');
                }, 3000);
            });

            // Botão voltar — restaura tudo
            btnVoltar.addEventListener('click', function () {
                abismo.classList.remove('visivel');
                conteudoPrincipal.classList.remove('escorregando');
                // Pequeno delay para a animação de volta
                setTimeout(function () {
                    animando = false;
                }, 500);
            });

            /* ============================================
               BOTÃO 2: MACACO XINGANDO
               ============================================ */
            const btnMacacoXinga = document.getElementById('btnMacacoXinga');
            const macacoXingao = document.getElementById('macacoXingao');
            const textoXinga = document.getElementById('textoXinga');
            const fecharXinga = document.getElementById('fecharXinga');

            // Frases de xingamento (todas chamando o usuário de macaco)
            const XINGAMENTOS = [
                'Seu macaco! 🐒',
                'Você é um macaco! 🐵',
                'Macaco! Macaco! Macaco! 🙈',
                'Sai daqui, seu macaco! 🐒',
                'Tu é um macacão! 🦧',
                'Olha o macaco aí, gente! 🐵',
                'Vai comer banana, seu macaco! 🍌🐒',
                'Macaco demais, hein! 🙊',
                'Você não passa de um macaco! 🐒',
                'Que macaco feio! 🙉'
            ];

            let escondendoTimeout = null;

            btnMacacoXinga.addEventListener('click', function () {
                // Sorteia uma frase
                const frase = XINGAMENTOS[Math.floor(Math.random() * XINGAMENTOS.length)];
                textoXinga.textContent = frase;

                // Mostra o macaco
                macacoXingao.classList.add('visivel');

                // Esconde automaticamente após 6 segundos
                if (escondendoTimeout) clearTimeout(escondendoTimeout);
                escondendoTimeout = setTimeout(function () {
                    macacoXingao.classList.remove('visivel');
                }, 6000);
            });

            // Fechar manualmente
            fecharXinga.addEventListener('click', function () {
                macacoXingao.classList.remove('visivel');
                if (escondendoTimeout) clearTimeout(escondendoTimeout);
            });
        })();
    </script>
</body>
</html>