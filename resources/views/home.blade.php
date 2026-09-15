<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema de Alerta Inteligente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        /* =========================================
           CORREÇÃO DEFINITIVA DO FUNDO
           ========================================= */
        html, body {
            background-color: #0a0a0a !important;
            min-height: 100vh;
            margin: 0;
            padding: 0;
        }

        body {
            color: #ffffff;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            position: relative;
            overflow-x: hidden;
        }

        /* Detalhes geométricos de canto */
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 200px;
            height: 200px;
            border-top: 4px solid #ff1a1a;
            border-left: 4px solid #ff1a1a;
            opacity: 0.4;
            pointer-events: none;
            z-index: 0;
        }

        body::after {
            content: '';
            position: absolute;
            bottom: -80px;
            right: -80px;
            width: 250px;
            height: 250px;
            border-bottom: 6px solid #ff1a1a;
            border-right: 6px solid #ff1a1a;
            opacity: 0.6;
            transform: rotate(45deg);
            pointer-events: none;
            z-index: 0;
        }

        /* Efeito de brilho pulsante no fundo */
        .glow-bg {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(255, 26, 26, 0.08) 0%, transparent 70%);
            pointer-events: none;
            z-index: 0;
            animation: glowPulse 4s infinite alternate;
        }

        @keyframes glowPulse {
            0% { opacity: 0.5; transform: translate(-50%, -50%) scale(1); }
            100% { opacity: 1; transform: translate(-50%, -50%) scale(1.1); }
        }

        /* =========================================
           ANIMAÇÕES UTILITÁRIAS
           ========================================= */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }

        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        @keyframes pulsarBotao {
            0% { box-shadow: 0 0 30px rgba(255, 26, 26, 0.8); }
            50% { box-shadow: 0 0 60px rgba(255, 26, 26, 1), 0 0 100px rgba(255, 26, 26, 0.4); }
            100% { box-shadow: 0 0 30px rgba(255, 26, 26, 0.8); }
        }

        @keyframes sinalWifi {
            0% { opacity: 0.3; transform: scale(0.8); }
            50% { opacity: 1; transform: scale(1); }
            100% { opacity: 0.3; transform: scale(0.8); }
        }

        @keyframes scanLine {
            0% { top: 0%; }
            100% { top: 100%; }
        }

        .anim-fade-in { animation: fadeInUp 0.8s ease-out forwards; }
        .anim-float { animation: floatIcon 3s ease-in-out infinite; }

        /* =========================================
           TIPOGRAFIA
           ========================================= */
        h1, h3 {
            color: #ffffff !important;
            font-weight: 900 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        h3 {
            text-shadow: 0 0 15px rgba(255, 26, 26, 0.6);
        }

        .titulo-principal {
            font-size: 2.5rem;
            background: linear-gradient(90deg, #ffffff 0%, #ff1a1a 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: none;
        }

        .secao-titulo {
            color: #ff1a1a !important;
            font-size: 1.2rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            margin-bottom: 24px;
            position: relative;
            display: inline-block;
        }

        .secao-titulo::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 60px;
            height: 3px;
            background-color: #ff1a1a;
            box-shadow: 0 0 10px rgba(255, 26, 26, 0.8);
        }

        /* =========================================
           CARDS DE INFORMAÇÃO
           ========================================= */
        .card-info {
            background-color: #141414;
            border: 1px solid #333;
            border-radius: 12px;
            box-shadow: 0 0 20px rgba(255, 26, 26, 0.15);
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .card-info:hover {
            transform: translateY(-5px);
            border-color: #ff1a1a;
            box-shadow: 0 10px 30px rgba(255, 26, 26, 0.3);
        }

        .card-info .card-header {
            font-weight: 700;
            background-color: #ff1a1a !important;
            color: #ffffff;
            border-radius: 12px 12px 0 0 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            border-bottom: none;
            padding: 14px 20px;
        }

        .card-info .card-body {
            color: #e0e0e0;
            padding: 20px;
        }

        .card-info .card-body p {
            margin-bottom: 10px;
            font-size: 15px;
        }

        .card-info .card-body p strong {
            color: #b0b0b0;
            font-weight: 600;
        }

        .text-muted {
            color: #666 !important;
            font-style: italic;
        }

        /* =========================================
           BOTÃO CENTRAL ACIONAR
           ========================================= */
        .btn-acionar {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            font-size: 1.3rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 2px;
            background-color: #ff1a1a !important;
            border: 5px solid #ff4d4d !important;
            color: #ffffff !important;
            box-shadow: 0 0 30px rgba(255, 26, 26, 0.8);
            transition: all 0.3s ease;
            position: relative;
            z-index: 2;
        }

        .btn-acionar:disabled {
            opacity: 1;
            animation: pulsarBotao 1.5s infinite;
            cursor: not-allowed;
        }

        .btn-wrapper {
            position: relative;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }

        .btn-wrapper::before,
        .btn-wrapper::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 100%;
            border-radius: 50%;
            border: 2px solid #ff1a1a;
            opacity: 0;
            animation: pulseRing 2s infinite;
        }

        .btn-wrapper::after {
            animation-delay: 1s;
        }

        @keyframes pulseRing {
            0% { transform: scale(1); opacity: 0.7; }
            100% { transform: scale(1.5); opacity: 0; }
        }

        /* =========================================
           SEÇÃO HERO
           ========================================= */
        .hero-section {
            background: linear-gradient(135deg, #1a0000 0%, #141414 100%);
            border: 1px solid #ff1a1a;
            border-radius: 16px;
            padding: 40px;
            margin-top: 40px;
            box-shadow: 0 0 30px rgba(255, 26, 26, 0.2);
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, transparent, #ff1a1a, transparent);
            animation: scanLine 3s linear infinite;
        }

        .hero-section h2 {
            color: #ff1a1a;
            font-size: 1.8rem;
            font-weight: 900;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 16px;
        }

        .hero-section p {
            color: #d0d0d0;
            font-size: 15px;
            line-height: 1.7;
        }

        /* =========================================
           CARDS DE RECURSOS
           ========================================= */
        .feature-card {
            background-color: #141414;
            border: 1px solid #333;
            border-radius: 12px;
            padding: 24px;
            text-align: center;
            height: 100%;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .feature-card:hover {
            border-color: #ff1a1a;
            transform: translateY(-8px);
            box-shadow: 0 15px 40px rgba(255, 26, 26, 0.25);
        }

        .feature-card .feature-icon {
            font-size: 3rem;
            margin-bottom: 16px;
            display: block;
        }

        .feature-card h5 {
            color: #ffffff;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1rem;
            margin-bottom: 12px;
        }

        .feature-card p {
            color: #a0a0a0;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* =========================================
           IMAGENS DO PROJETO
           ========================================= */
        .img-projeto {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 12px;
            border: 2px solid #ff1a1a;
            box-shadow: 0 0 25px rgba(255, 26, 26, 0.3);
            transition: all 0.3s ease;
            cursor: pointer; /* Novo: cursor de clique */
        }

        .img-projeto:hover {
            transform: scale(1.03);
            box-shadow: 0 0 40px rgba(255, 26, 26, 0.6);
            border-color: #ff4d4d;
        }

        /* Moldura circular para a logo */
        .logo-wrapper {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #ff1a1a;
            box-shadow: 0 0 25px rgba(255, 26, 26, 0.6);
            margin: 0 auto;
            transition: all 0.3s ease;
            cursor: pointer; /* Novo: cursor de clique */
        }

        .logo-wrapper:hover {
            transform: scale(1.1);
            box-shadow: 0 0 40px rgba(255, 26, 26, 0.9);
        }

        .logo-wrapper img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Container de imagem com altura fixa */
        .img-container {
            height: 250px;
            border-radius: 12px;
            overflow: hidden;
        }

        .img-container-sm {
            height: 220px;
            border-radius: 12px;
            overflow: hidden;
        }

        /* =========================================
           MODAL DE IMAGEM AMPLIADA
           ========================================= */
        .modal-img .modal-content {
            background-color: #0a0a0a;
            border: 2px solid #ff1a1a;
            border-radius: 16px;
            box-shadow: 0 0 50px rgba(255, 26, 26, 0.6);
        }

        .modal-img .modal-body {
            padding: 0;
        }

        .modal-img .modal-body img {
            width: 100%;
            height: auto;
            border-radius: 14px;
            display: block;
        }

        .modal-img .btn-close {
            filter: invert(1) sepia(1) saturate(5) hue-rotate(330deg);
            opacity: 0.8;
            position: absolute;
            top: 12px;
            right: 12px;
            z-index: 10;
        }

        .modal-img .btn-close:hover {
            opacity: 1;
        }

        .modal-backdrop.show {
            opacity: 0.85;
            background-color: #000;
        }

        /* =========================================
           DIAGRAMA ARDUINO
           ========================================= */
        .arduino-diagram {
            display: flex;
            align-items: center;
            justify-content: space-around;
            flex-wrap: wrap;
            gap: 20px;
            padding: 30px;
            background-color: #0a0a0a;
            border-radius: 12px;
            border: 1px solid #333;
        }

        .arduino-node {
            background-color: #141414;
            border: 2px solid #ff1a1a;
            border-radius: 12px;
            padding: 20px;
            text-align: center;
            min-width: 120px;
            box-shadow: 0 0 15px rgba(255, 26, 26, 0.3);
            transition: all 0.3s ease;
        }

        .arduino-node:hover {
            transform: scale(1.1);
            box-shadow: 0 0 30px rgba(255, 26, 26, 0.6);
        }

        .arduino-node .node-icon {
            font-size: 2.2rem;
            display: block;
            margin-bottom: 8px;
        }

        .arduino-node span {
            color: #ffffff;
            font-weight: 700;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .arduino-arrow {
            color: #ff1a1a;
            font-size: 1.8rem;
            animation: sinalWifi 1.5s infinite;
        }
    </style>
</head>
<body>
    <!-- Efeito de brilho de fundo -->
    <div class="glow-bg"></div>

    <div class="container py-5 position-relative" style="z-index: 1;">
        
        <!-- =========================================
             CABEÇALHO COM LOGO (CLICÁVEL)
             ========================================= -->
        <div class="row align-items-center mb-5 anim-fade-in">
            <div class="col-md-2 text-center mb-3 mb-md-0">
                <div class="logo-wrapper" data-bs-toggle="modal" data-bs-target="#modalImagem">
                    <img src="{{ asset('imgs/macaco.img.png') }}" alt="Logo do Projeto">
                </div>
            </div>
            <div class="col-md-10 text-center text-md-start">
                <h1 class="titulo-principal mb-2">Bem-vindo, {{ $usuario->nome ?? 'Usuário' }}!</h1>
                <p style="color: #b0b0b0; font-size: 16px; margin: 0;">
                    <span style="color: #ff1a1a;">●</span> Sistema Online — Seu acesso está liberado e o alerta está ativo.
                </p>
            </div>
        </div>

        <!-- =========================================
             CARDS DE INFO + BOTÃO CENTRAL
             ========================================= -->
        <div class="row align-items-center g-4 mb-5 anim-fade-in">
            <!-- Card de Usuário -->
            <div class="col-lg-4 col-md-12">
                <div class="card card-info">
                    <div class="card-header">👤 Dados do Usuário</div>
                    <div class="card-body">
                        <p><strong>Nome:</strong> {{ $usuario->nome ?? '-' }}</p>
                        <p><strong>Email:</strong> {{ $usuario->email ?? '-' }}</p>
                        <p><strong>CPF:</strong> {{ $usuario->cpf ?? '-' }}</p>
                        <p><strong>Data de nascimento:</strong> {{ $usuario->data_nascimento ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Botão central -->
            <div class="col-lg-4 col-md-12 d-flex justify-content-center py-4">
                <div class="btn-wrapper">
                    <button type="button" class="btn btn-acionar" disabled>
                        ACIONAR
                    </button>
                </div>
            </div>

            <!-- Card de Sala -->
            <div class="col-lg-4 col-md-12">
                <div class="card card-info">
                    <div class="card-header">🏫 Sala Cadastrada</div>
                    <div class="card-body">
                        @if ($local)
                            <p><strong>Nome:</strong> {{ $local->nome }}</p>
                            <p><strong>Bloco:</strong> {{ $local->bloco->nome ?? '-' }}</p>
                            <p><strong>Tipo:</strong> {{ $local->tipoLocal->nome ?? '-' }}</p>
                            <p><strong>Identificador:</strong> {{ $local->identificador ?? '-' }}</p>
                        @else
                            <p class="text-muted">Nenhuma sala cadastrada ainda.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================
             SEÇÃO HERO - DESTAQUE DO PROJETO
             ========================================= -->
        <div class="hero-section anim-fade-in">
            <div class="row align-items-center">
                <div class="col-lg-7">
                    <h2>⚡ Tecnologia a Serviço da Segurança</h2>
                    <p>
                        Este sistema foi desenvolvido para <strong style="color: #fff;">salvar tempo e vidas</strong>. 
                        Ao pressionar o botão físico conectado ao <strong style="color: #ff1a1a;">Arduino</strong>, um sinal é enviado 
                        instantaneamente via <strong style="color: #ff1a1a;">Bluetooth</strong> para este painel, acionando o 
                        <strong style="color: #ff1a1a;">buzzer e o LED</strong> de alerta.
                    </p>
                    <p>
                        Em situações de emergência, cada segundo conta. Este projeto une o melhor do 
                        <strong style="color: #fff;">desenvolvimento web</strong> com a 
                        <strong style="color: #fff;">automação embarcada</strong>, criando uma ponte direta entre quem precisa de ajuda 
                        e quem pode ajudar.
                    </p>
                </div>
                <div class="col-lg-5 mt-4 mt-lg-0">
                    <!-- IMAGEM DO PROJETO (CLICÁVEL) -->
                    <div class="img-container" data-bs-toggle="modal" data-bs-target="#modalImagem">
                        <img src="{{ asset('imgs/macaco.img.png') }}" alt="Projeto Arduino Montado" class="img-projeto">
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================
             DIAGRAMA DE FUNCIONAMENTO
             ========================================= -->
        <div class="mt-5 anim-fade-in">
            <h3 class="text-center mb-4">Como o Sistema Funciona</h3>
            <div class="arduino-diagram">
                <div class="arduino-node">
                    <span class="node-icon">🔘</span>
                    <span>Botão Físico</span>
                </div>
                <div class="arduino-arrow">➜</div>
                <div class="arduino-node">
                    <span class="node-icon">📡</span>
                    <span>Bluetooth</span>
                </div>
                <div class="arduino-arrow">➜</div>
                <div class="arduino-node">
                    <span class="node-icon">💻</span>
                    <span>Sistema Web</span>
                </div>
                <div class="arduino-arrow">➜</div>
                <div class="arduino-node">
                    <span class="node-icon">🔊</span>
                    <span>Buzzer + LED</span>
                </div>
            </div>
        </div>

        <!-- =========================================
             CARDS DE RECURSOS
             ========================================= -->
        <div class="mt-5 anim-fade-in">
            <h3 class="secao-titulo">Por que este sistema é essencial?</h3>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <span class="feature-icon anim-float">⚡</span>
                        <h5>Resposta Imediata</h5>
                        <p>O tempo entre o acionamento do botão e o alerta no painel é de menos de 2 segundos. Em emergências, isso faz toda a diferença.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <span class="feature-icon anim-float" style="animation-delay: 0.5s;">🛡️</span>
                        <h5>Segurança Garantida</h5>
                        <p>O buzzer e o LED garantem que o alerta não passe despercebido, mesmo em ambientes com muito ruído ou movimento.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <span class="feature-icon anim-float" style="animation-delay: 1s;">💡</span>
                        <h5>Tecnologia Acessível</h5>
                        <p>Utilizando Arduino e tecnologias web de código aberto, o sistema é de baixo custo e fácil de replicar em qualquer instituição.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- =========================================
             GALERIA DE IMAGENS (CLICÁVEIS)
             ========================================= -->
        <div class="mt-5 anim-fade-in">
            <h3 class="secao-titulo">Galeria do Projeto</h3>
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="img-container-sm" data-bs-toggle="modal" data-bs-target="#modalImagem">
                        <img src="{{ asset('imgs/macaco.img.png') }}" alt="Montagem do Arduino" class="img-projeto">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="img-container-sm" data-bs-toggle="modal" data-bs-target="#modalImagem">
                        <img src="{{ asset('imgs/macaco.img.png') }}" alt="Interface do Sistema" class="img-projeto">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="img-container-sm" data-bs-toggle="modal" data-bs-target="#modalImagem">
                        <img src="{{ asset('imgs/macaco.img.png') }}" alt="Testes Bluetooth" class="img-projeto">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- =========================================
         MODAL DE IMAGEM AMPLIADA
         ========================================= -->
    <div class="modal fade modal-img" id="modalImagem" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    <img src="{{ asset('imgs/macaco.img.png') }}" alt="Imagem Ampliada">
                </div>
            </div>
        </div>
    </div>

    <!-- Script do Bootstrap (necessário para o modal) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>