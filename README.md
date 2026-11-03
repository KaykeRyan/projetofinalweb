# Sistema de Alerta Inteligente

Aplicação web para cadastrar usuários e salas e acionar um alerta conectado a um ESP32. A interface e as mensagens do sistema estão principalmente em português.

> **Estado da implementação:** o acionamento do ESP32 feito pela aplicação usa uma requisição HTTP do Laravel para o dispositivo. Existe também um cliente MQTT experimental no frontend, mas ele não é o caminho usado pelo botão **ACIONAR**.

## Funcionalidades

- Cadastro de usuário com nome, e-mail, senha, data de nascimento e CPF.
- Autenticação por token próprio, com validade de sete dias; no navegador o token é guardado na sessão, e clientes de API o enviam no cabeçalho de autorização HTTP.
- Cadastro, edição e exclusão de salas associadas ao usuário, a um bloco e a um tipo de local.
- Painel inicial com dados do usuário e da sala corrente.
- Envio dos comandos `ACIONAR` e `DESLIGAR` do backend para o ESP32.
- Endpoints JSON para autenticação, perfil, salas, blocos e tipos de local.

## Tecnologias

- PHP `^8.3` e Laravel `^13.17`.
- SQLite por padrão (também há configuração para MySQL/MariaDB, PostgreSQL e SQL Server).
- Laravel Sanctum está instalado; a maioria das rotas autenticadas, porém, usa o middleware próprio `token.usuario`.
- Vite `^8`, Tailwind CSS `^4` e JavaScript.
- Biblioteca JavaScript MQTT `^5.16` e cliente PHP MQTT `^2.3`.
- A interface usa Bootstrap por CDN em várias telas; algumas páginas também carregam jQuery e SweetAlert2 por CDN.

## Estrutura principal

```text
app/
  Http/Controllers/       Controladores de usuário, login, salas, home e acionamento
  Http/Middleware/        Validação do token próprio
  Models/                 Usuario, TokenUsuario, Local, Bloco e TipoLocal
  Services/Esp32Service.php
config/esp32.php           Configuração da conexão HTTP com o ESP32
database/migrations/       Esquema e alterações do banco
database/seeders/          Dados de blocos e tipos de local
resources/views/           Telas Blade
resources/js/               JavaScript do frontend e experimento MQTT
routes/web.php              Rotas da interface web
routes/api.php              Rotas JSON (prefixo /api)
tests/                      Testes PHPUnit
```

## Requisitos

- PHP 8.3 ou superior, com extensões requeridas pelo Laravel e pelo driver de banco escolhido.
- Composer.
- Node.js e npm.
- Um banco de dados configurado.
- Para acionar o hardware: ESP32 ligado e acessível por HTTP a partir da máquina que executa o Laravel.

## Instalação local

Na raiz do projeto:

```bash
composer install
npm install
```

**Este repositório não contém `.env.example`.** Crie um arquivo `.env` localmente com, no mínimo, `APP_KEY=`, `APP_URL`, `DB_CONNECTION` e as configurações necessárias para o ambiente. Para SQLite, a conexão padrão aponta para `database/database.sqlite`; o arquivo já existe no repositório, mas pode ser criado se estiver ausente.

Depois de criar o `.env`:

```bash
php artisan key:generate
php artisan migrate --seed
npm run build
```

Para desenvolvimento frontend com recompilação automática, use `npm run dev`. No Laravel Herd, o projeto é servido pelo próprio Herd; não é necessário iniciar outro servidor Laravel.

O seeder principal (`DatabaseSeeder`) chama `EstruturaEscolaSeeder`, que cadastra blocos e tipos de local iniciais, e cria também um usuário de demonstração da tabela padrão `users`. Não use dados de demonstração em produção. `BlocoTipoSeeder` existe, mas não é chamado pelo seeder principal.

## Configuração do ESP32

Defina estas variáveis no `.env`:

```dotenv
ESP32_HOST=192.168.0.50
ESP32_PORT=80
ESP32_TOKEN=
ESP32_TIMEOUT=3
```

Os valores de exemplo são padrões definidos em `config/esp32.php`, não credenciais ou endereços garantidos para a sua instalação. Configure um endereço alcançável pelo servidor Laravel e mantenha qualquer token real apenas no `.env`, nunca no código versionado.

O serviço `Esp32Service` envia uma requisição HTTP `POST` com o cabeçalho `X-Token`:

- `ACIONAR` → `http://<ESP32_HOST>:<ESP32_PORT>/acionar`
- `DESLIGAR` → `http://<ESP32_HOST>:<ESP32_PORT>/desligar`

O botão da home envia `ACIONAR` para a rota web `/acionar`. O comando `DESLIGAR` é aceito pelo endpoint, embora a interface atual não apresente um botão para ele. O ESP32 precisa implementar essas rotas HTTP e validar o cabeçalho conforme a configuração do dispositivo.

## MQTT: experimento separado

`resources/js/app.js` conecta o navegador ao broker público `broker.emqx.io` por WebSocket (`ws://broker.emqx.io:8083/mqtt`) e assina o tópico `monitoramento/teste/laravel`. Mensagens recebidas são registradas no console e exibidas em um `alert`.

Esse cliente não envia o comando do botão de acionamento e não está integrado ao `Esp32Service`. `mosquitto_local.conf` configura outro broker, local em `127.0.0.1:1883`, com acesso anônimo habilitado; trate-o como configuração de desenvolvimento, não como configuração segura para produção. Os scripts `teste_mqtt.php` e `teste_tls*.php` são arquivos auxiliares de experimentação.

## Banco de dados e domínio

- `usuario`: nome, e-mail único, senha com hash, data de nascimento e CPF único.
- `token_usuario`: token único e data de validade; tokens são removidos no logout e quando expiram.
- `bloco`: blocos físicos ou áreas da escola.
- `tipo_local`: categorias de local, como sala de aula, laboratório e cantina.
- `local`: sala/local, relacionado a bloco, tipo e usuário; contém nome, identificador opcional e indicador `ativo`.

Os nomes das tabelas e campos são predominantemente em português e usam nomes não convencionais do Laravel; os modelos definem explicitamente as tabelas. A tabela `local` recebe `usuario_id` em uma migração posterior e essa coluna foi criada como nullable. A exclusão do usuário remove seus tokens e locais relacionados por cascata.

## Rotas principais

### Interface web

| Método | Caminho | Uso | Acesso |
|---|---|---|---|
| `GET` | `/` | Página inicial pública | Público |
| `GET`, `POST` | `/cadastro_usuario` | Tela e envio do cadastro | Público |
| `GET`, `POST` | `/cadastro_local` | Tela e envio do cadastro de sala | Token |
| `GET` | `/home` | Painel do usuário e sala corrente | Token |
| `POST` | `/acionar` | Envio de `ACIONAR` ou `DESLIGAR` | Token |
| `GET` | `/usuario/editar` | Editar perfil | Token |
| `PUT`, `DELETE` | `/usuario/atualizar`, `/usuario/excluir` | Alterar ou excluir perfil | Token |
| `GET` | `/local/{id}/editar` | Editar sala | Token e proprietário |
| `PUT`, `DELETE` | `/local/{id}/atualizar`, `/local/{id}/excluir` | Alterar ou excluir sala | Token e proprietário |

### API

As rotas definidas em `routes/api.php` usam o prefixo `/api`.

| Método | Caminho | Uso | Acesso |
|---|---|---|---|
| `POST` | `/api/cadastro_usuario` | Cadastro/retomada de usuário e emissão de token | Público |
| `POST` | `/api/login` | Login por e-mail e senha | Público |
| `POST` | `/api/logout` | Revogar o token atual | Token próprio |
| `GET` | `/api/usuarios` | Listar usuários | Token próprio; retorna todos |
| `PUT`, `DELETE` | `/api/usuarios/{id}` | Alterar ou excluir a própria conta | Token próprio |
| `GET` | `/api/minhas_salas` | Listar salas do usuário | Token próprio |
| `PUT`, `DELETE` | `/api/minhas_salas/{id}` | Alterar ou excluir sala própria | Token próprio |
| `GET` | `/api/blocos` | Listar blocos | Token próprio |
| `GET` | `/api/tipos_local` | Listar tipos de local | Token próprio |
| `GET` | `/api/user` | Usuário autenticado pelo Sanctum | Sanctum |

Para as rotas protegidas pelo middleware próprio, envie o token emitido pelo login no cabeçalho de autorização HTTP. As respostas JSON usam, em geral, o campo `erro` com `n` para sucesso e `s` para erro, além de `mensagem` quando aplicável.

Não há rota `GET /login` registrada; o login implementado é o endpoint JSON `/api/login`.

## Testes e comandos úteis

```bash
php artisan test
npm run build
```

O conjunto atual de testes contém apenas testes de exemplo do Laravel: um teste básico para `GET /` e um teste unitário trivial. Ainda não há cobertura automatizada específica para login, autorização, CRUD de salas, banco de dados ou comunicação com o ESP32.

## Observações para manutenção

- Ao alterar autenticação, considere que o middleware próprio busca o token primeiro no cabeçalho de autorização HTTP e depois na sessão web; ele coloca o usuário em `usuario_autenticado` nos atributos da requisição.
- No cadastro, um e-mail já existente combinado com a senha correta reutiliza a conta e emite um novo token; um e-mail existente com outra senha retorna uma mensagem de erro.
- O cadastro web usa AJAX e grava o token na sessão, depois redireciona para `/home`.
- A home carrega a sala cujo ID está na sessão (`local_id`). O cadastro de uma sala define essa sala corrente.
- A listagem `GET /api/usuarios` exige autenticação, mas o código atual retorna os dados de todos os usuários; considere isso ao revisar autorização e privacidade.
- Antes de publicar, revise autorização e exposição de dados pessoais nas rotas de API, segurança do broker MQTT, proteção das credenciais do ESP32 e a configuração de produção.
