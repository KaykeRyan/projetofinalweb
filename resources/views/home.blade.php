<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Sistema de Alerta Inteligente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

    @vite(['resources/js/app.js'])

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

        @keyframes mortal {
            0%   { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .anim-fade-in { animation: fadeInUp 0.8s ease-out forwards; }
        .anim-float { animation: floatIcon 3s ease-in-out infinite; }

        .dando-mortal {
            animation: mortal 1s ease-in-out;
            transform-origin: center center;
        }

        /* =========================================
           ESCORREGAR PARA BAIXO + ABISMO
           ========================================= */
        .escorregando {
            animation: escorregarBaixo 2s ease-in-out forwards;
        }

        @keyframes escorregarBaixo {
            0%   { transform: translateY(0); opacity: 1; }
            100% { transform: translateY(120vh); opacity: 0; }
        }

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
            cursor: pointer;
        }

        .btn-voltar:hover {
            transform: scale(1.08);
            box-shadow: 0 0 35px rgba(255, 26, 26, 0.9);
        }

        /* =========================================
           MACACOS CORRENDO
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
            will-change: transform, left;
        }

        @keyframes correrMacaco {
            0% {
                left: -80px;
                transform: translateY(0) rotate(0deg);
            }
            25% {
                transform: translateY(-25px) rotate(-10deg);
            }
            50% {
                transform: translateY(0) rotate(0deg);
            }
            75% {
                transform: translateY(-25px) rotate(10deg);
            }
            100% {
                left: 110vw;
                transform: translateY(0) rotate(0deg);
            }
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
           BOTÕES DE AÇÃO NOS CARDS
           ========================================= */
        .card-info .btn-outline-light {
            border-color: #555;
            color: #e0e0e0;
        }

        .card-info .btn-outline-light:hover {
            background-color: #333;
            border-color: #777;
            color: #fff;
        }

        .card-info .btn-outline-danger {
            border-color: #ff1a1a;
            color: #ff6a6a;
        }

        .card-info .btn-outline-danger:hover {
            background-color: #ff1a1a;
            border-color: #ff1a1a;
            color: #fff;
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
           BOTÕES DE BRINCADEIRA
           ========================================= */
        .btn-mortal,
        .btn-mortal-escorregar,
        .btn-macacos,
        .btn-macaco-xinga {
            border-radius: 50px !important;
            padding: 12px 24px !important;
            font-weight: 900 !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #fff !important;
            border: 3px solid #ff4d4d !important;
            transition: all 0.3s ease;
            font-size: 0.8rem;
            cursor: pointer;
        }

        .btn-mortal {
            background: linear-gradient(135deg, #ff1a1a 0%, #990000 100%);
            box-shadow: 0 0 20px rgba(255, 26, 26, 0.6);
        }

        .btn-mortal:hover {
            transform: scale(1.05);
            box-shadow: 0 0 35px rgba(255, 26, 26, 0.9);
        }

        .btn-mortal-escorregar {
            background: linear-gradient(135deg, #ff1a1a 0%, #990000 100%);
            box-shadow: 0 0 20px rgba(255, 26, 26, 0.6);
        }

        .btn-mortal-escorregar:hover {
            transform: scale(1.05);
            box-shadow: 0 0 35px rgba(255, 26, 26, 0.9);
        }

        .btn-macacos {
            background: linear-gradient(135deg, #8B5A2B 0%, #4a2c0a 100%);
            border-color: #c98a3c !important;
            box-shadow: 0 0 20px rgba(201, 138, 60, 0.5);
        }

        .btn-macacos:hover {
            transform: scale(1.05);
            box-shadow: 0 0 35px rgba(201, 138, 60, 0.9);
        }

        .btn-macaco-xinga {
            background: linear-gradient(135deg, #8B5A2B 0%, #4a2c0a 100%);
            border-color: #c98a3c !important;
            box-shadow: 0 0 20px rgba(201, 138, 60, 0.5);
        }

        .btn-macaco-xinga:hover {
            transform: scale(1.05);
            box-shadow: 0 0 35px rgba(201, 138, 60, 0.9);
        }

        .btn-mortal:active,
        .btn-mortal-escorregar:active,
        .btn-macacos:active,
        .btn-macaco-xinga:active {
            transform: scale(0.95);
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
            cursor: pointer;
        }

        .img-projeto:hover {
            transform: scale(1.03);
            box-shadow: 0 0 40px rgba(255, 26, 26, 0.6);
            border-color: #ff4d4d;
        }

        .logo-wrapper {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid #ff1a1a;
            box-shadow: 0 0 25px rgba(255, 26, 26, 0.6);
            margin: 0 auto;
            transition: all 0.3s ease;
            cursor: pointer;
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

    @if (session('sucesso'))
        <div class="alert alert-success position-relative" style="z-index: 2; margin: 20px auto 0; max-width: 800px;">
            {{ session('sucesso') }}
        </div>
    @endif

    <div class="container py-5 position-relative" style="z-index: 1;" id="conteudoPrincipal">
        
        <!-- CABEÇALHO COM LOGO -->
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

        <!-- CARDS DE INFO + BOTÕES -->
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

                        @if ($usuario)
                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('usuario.editar') }}" class="btn btn-sm btn-outline-light">Editar</a>
                                <form action="{{ route('usuario.excluir') }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir sua conta? Essa ação não pode ser desfeita.');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Botão central + BOTÕES DE BRINCADEIRA -->
            <div class="col-lg-4 col-md-12 d-flex flex-column justify-content-center align-items-center py-4">
                <div class="btn-wrapper mb-4">
                    <button type="button" class="btn btn-acionar" disabled>
                        ACIONAR
                    </button>
                </div>

                <div class="d-flex flex-column gap-2 align-items-center" style="width: 100%; max-width: 250px;">
                    <button type="button" class="btn-mortal w-100" id="btnMortal">🤸 DAR UM MORTAL</button>
                    <button type="button" class="btn-mortal-escorregar w-100" id="btnMortalEscorregar">🕳️ MORTAL + ESCORREGAR</button>
                    <button type="button" class="btn-macacos w-100" id="btnMacacos">🐒 CHUVA DE MACACOS</button>
                    <button type="button" class="btn-macaco-xinga w-100" id="btnMacacoXinga">🐵 MACACO XINGANDO</button>
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

                            <div class="d-flex gap-2 mt-3">
                                <a href="{{ route('local.editar', $local->id) }}" class="btn btn-sm btn-outline-light">Editar</a>
                                <form action="{{ route('local.excluir', $local->id) }}" method="POST" class="d-inline"
                                      onsubmit="return confirm('Tem certeza que deseja excluir esta sala?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger">Excluir</button>
                                </form>
                            </div>
                        @else
                            <p class="text-muted">Nenhuma sala cadastrada ainda.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- SEÇÃO HERO -->
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
                    <div class="img-container" data-bs-toggle="modal" data-bs-target="#modalImagem">
                        <img src="{{ asset('imgs/macaco.img.png') }}" alt="Projeto Arduino Montado" class="img-projeto">
                    </div>
                </div>
            </div>
        </div>

        <!-- DIAGRAMA DE FUNCIONAMENTO -->
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

        <!-- CARDS DE RECURSOS -->
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

        <!-- GALERIA DE IMAGENS -->
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

    <!-- ABISMO (aparece após escorregar) -->
    <div class="abismo" id="abismo">
        <h2>🕳️ Você caiu no abismo!</h2>
        <p>Brincadeira 😄 — clique abaixo para voltar.</p>
        <button type="button" class="btn-voltar" id="btnVoltar">Voltar</button>
    </div>

    <!-- MACACO XINGANDO -->
    <div class="macaco-xingao-wrapper" id="macacoXingao">
        <div class="balao-fala">
            <button type="button" class="fechar-xinga" id="fecharXinga" aria-label="Fechar">×</button>
            <p id="textoXinga">Seu macaco!</p>
        </div>
        <div class="macaco-emoji">🐒</div>
    </div>

    <!-- MODAL DE IMAGEM AMPLIADA -->
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

    <!-- Script do Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SCRIPTS DAS BRINCADEIRAS -->
    <script>
        (function () {
            /* ============================================
               1) MORTAL SIMPLES
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
               2) MORTAL + ESCORREGAR
               ============================================ */
            const btnMortalEscorregar = document.getElementById('btnMortalEscorregar');
            const conteudoPrincipal = document.getElementById('conteudoPrincipal');
            const abismo = document.getElementById('abismo');
            const btnVoltar = document.getElementById('btnVoltar');
            let animando = false;

            btnMortalEscorregar.addEventListener('click', function () {
                if (animando) return;
                animando = true;

                document.body.classList.add('dando-mortal');

                setTimeout(function () {
                    document.body.classList.remove('dando-mortal');
                    conteudoPrincipal.classList.add('escorregando');
                }, 1000);

                setTimeout(function () {
                    abismo.classList.add('visivel');
                }, 3000);
            });

            btnVoltar.addEventListener('click', function () {
                abismo.classList.remove('visivel');
                conteudoPrincipal.classList.remove('escorregando');
                setTimeout(function () {
                    animando = false;
                }, 500);
            });

            /* ============================================
               3) CHUVA DE MACACOS (20 segundos)
               ============================================ */
            const btnMacacos = document.getElementById('btnMacacos');
            const EMOJIS = ['🐒', '🐵', '🙈', '🙉', '🙊', '🦧'];
            let macacosAtivos = false;

            function criarMacaco() {
                const macaco = document.createElement('div');
                macaco.classList.add('macaco-corredor');
                macaco.textContent = EMOJIS[Math.floor(Math.random() * EMOJIS.length)];

                const bottomOffset = 5 + Math.random() * 60;
                macaco.style.bottom = bottomOffset + 'px';

                const tamanho = 2 + Math.random() * 2.5;
                macaco.style.fontSize = tamanho + 'rem';

                const duracao = 4 + Math.random() * 4;
                macaco.style.animationDuration = duracao + 's';
                macaco.style.animationDelay = (Math.random() * 1.5) + 's';

                document.body.appendChild(macaco);

                setTimeout(function () {
                    if (macaco.parentNode) macaco.parentNode.removeChild(macaco);
                }, (duracao + 2) * 1000);
            }

            btnMacacos.addEventListener('click', function () {
                if (macacosAtivos) return;
                macacosAtivos = true;
                btnMacacos.disabled = true;

                const DURACAO_TOTAL = 20000;
                const inicio = Date.now();

                const intervalo = setInterval(function () {
                    if (Date.now() - inicio >= DURACAO_TOTAL) {
                        clearInterval(intervalo);
                        return;
                    }
                    criarMacaco();
                    if (Math.random() > 0.5) criarMacaco();
                }, 350);

                setTimeout(function () {
                    macacosAtivos = false;
                    btnMacacos.disabled = false;
                }, DURACAO_TOTAL);
            });

            /* ============================================
               4) MACACO XINGANDO
               ============================================ */
            const btnMacacoXinga = document.getElementById('btnMacacoXinga');
            const macacoXingao = document.getElementById('macacoXingao');
            const textoXinga = document.getElementById('textoXinga');
            const fecharXinga = document.getElementById('fecharXinga');

            const XINGAMENTOS = [
                'Palmeiras não tem mundial! 🙉',
                
            ];

            let escondendoTimeout = null;

            btnMacacoXinga.addEventListener('click', function () {
                const frase = XINGAMENTOS[Math.floor(Math.random() * XINGAMENTOS.length)];
                textoXinga.textContent = frase;

                macacoXingao.classList.add('visivel');

                if (escondendoTimeout) clearTimeout(escondendoTimeout);
                escondendoTimeout = setTimeout(function () {
                    macacoXingao.classList.remove('visivel');
                }, 6000);
            });

            fecharXinga.addEventListener('click', function () {
                macacoXingao.classList.remove('visivel');
                if (escondendoTimeout) clearTimeout(escondendoTimeout);
            });
        })();
    </script>
</body>
</html>