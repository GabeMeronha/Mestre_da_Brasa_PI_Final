<?php
session_start();
// Importa o autoload do Composer para carregar as rotas
require __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UsuarioController;

$usuarioCtrl = new UsuarioController();

use App\Controllers\ProdutoController;

$produtoCtrl = new ProdutoController();

use App\Controllers\VendaController;

$vendaCtrl = new VendaController();

use App\Controllers\AuthController;

$authCtrl = new AuthController();


// Injeta o conteudo das páginas de rota dentro do template base.php
function render($view, $data = [])
{
    extract($data);
    ob_start();
    // Carrega a página da rota
    require __DIR__ . '/../app/Views/' . $view;
    $content = ob_get_clean();
    // Carrega o template base.php
    require __DIR__ . '/../app/Views/layouts/base.php';
}

function render_sem_login($view, $data = [])
{
    extract($data);
    ob_start();
    $content = ob_get_clean();
    // Carrega a página da rota
    require __DIR__ . '/../app/Views/' . $view;
}

function render_dashboard($view, $data = [])
{
    extract($data);
    ob_start();
    $content = ob_get_clean();
    // Carrega a página da rota
    require __DIR__ . '/../app/Views/' . $view;
}
// Obtém a URL da requisição da navegação
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

if ($url == "/") {
    render('home.php', ['title' => 'Home NSeiLanches']);
} else if ($url == '/sobre') {
    render('sobre.php', ['title' => 'Sobre NSeiLanches']);
} else if ($url == '/contato') {
    render('contato.php', ['title' => 'Contato NSeiLanches']);
} else if ($url == '/login' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $authCtrl->login();
} else if ($url == '/login') {
    render_sem_login('auth/login.php', ['title' => 'Login NSeiLanches']);
} else if ($url == '/logout') {
    $authCtrl->logout();
} else if ($url == "/dashboard") {
    if (!isset($_SESSION['usuario_email'])) {
        header('Location: /login');
        exit;
    }

    // IA ajudou a criar o código abaixo para entender como funciona o dashboard e como buscar os dados recentes
    // Busca dados recentes para o dashboard
    $clientesRecentes = \App\Models\Usuario::buscarClientesRecentes();
    $vendasRecentes = \App\Models\Venda::buscarVendasRecentes();
    $produtosRecentes = \App\Models\Produto::buscarProdutosRecentes();

    render_dashboard('dashboard.php', [
        'title' => 'Dashboard NSeiLanches',
        'clientesRecentes' => $clientesRecentes,
        'vendasRecentes' => $vendasRecentes,
        'produtosRecentes' => $produtosRecentes
    ]);

    
} else if ($url == "/usuarios/novo") {
    render('usuarios/cadastro-usuarios.php', ['title' => 'Cadastro NSeiLanches']);
} else if ($url == "/usuarios/registrar") {
    $usuarioCtrl->novo();
} else if ($url == "/clientes") {
    $clientes = $usuarioCtrl->listarClientes();
} else if ($url == "/produtos/registrar") {
    render('produtos/registro-produtos.php', ['title' => 'Registro Produto']);
} else if ($url == "/produtos") {
    $produtos = $produtoCtrl->listar();
} else if ($url == "/vendas/registrar") {
    $vendaCtrl->novo();
} else if ($url == "/vendas") {
    $vendas = $vendaCtrl->listar();
}
//Verifica se também veio por POST a rota
else if ($url == "/usuarios/salvar" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarios = $usuarioCtrl->salvar();
} else if ($url == "/vendas/salvar" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendaCtrl->salvar();
}

// preg_match utiliza uma expressão regular para extrair um valorde uma string
else if (preg_match('#^/usuarios/(\d+)/editar$#', $url, $num)) {
    $usuarioCtrl->editar($num[1]);
} else if (preg_match('#^/usuarios/(\d+)/atualizar$#', $url, $num) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarioCtrl->atualizar($num[1]);
} else if (preg_match('#^/usuarios/(\d+)/del-fisico$#', $url, $num)) {
    $usuarioCtrl->deleteFisico($num[1]);
} else if (preg_match('#^/usuarios/(\d+)/del-logico$#', $url, $num)) {
    $usuarioCtrl->deleteLogico($num[1]);
}

// Rotas de produtos
else if ($url == "/produtos/novo") {
    $produtoCtrl->novo();
} else if ($url == "/produtos/salvar" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $produtoCtrl->salvar();
} else if (preg_match('#^/produtos/(\\d+)/editar$#', $url, $num)) {
    $produtoCtrl->editar($num[1]);
} else if (preg_match('#^/produtos/(\\d+)/atualizar$#', $url, $num) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $produtoCtrl->atualizar($num[1]);
} else if (preg_match('#^/produtos/(\\d+)/del-logico$#', $url, $num)) {
    $produtoCtrl->deleteLogico($num[1]);
}

// Outras rotas entram aqui...
else if (preg_match('#^/vendas/(\d+)/editar$#', $url, $num)) {
    $vendaCtrl->editar($num[1]);
} else if (preg_match('#^/vendas/(\d+)/atualizar$#', $url, $num) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendaCtrl->atualizar($num[1]);
} else if (preg_match('#^/vendas/(\d+)/del-logico$#', $url, $num)) {
    $vendaCtrl->deleteLogico($num[1]);
} else {
    http_response_code(404);
    echo '<h1>404 - Página não encontrada</h1>';
    // render('404.php', ['title' => 'Página nao Encontrada. - Vendas']);
}
