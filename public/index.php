<?php
// Inicia a sessão para o site lembrar de você (login, carrinho, etc)
session_start();

// Carrega todas as ferramentas do projeto automaticamente
require __DIR__ . '/../vendor/autoload.php';

// --- Preparando os Controladores (Quem manda em tudo) ---

use App\Controllers\UsuarioController;
$usuarioCtrl = new UsuarioController(); // Liga o controlador de Usuários

use App\Controllers\ProdutoController;
$produtoCtrl = new ProdutoController(); // Liga o controlador de Produtos

use App\Controllers\VendaController;
$vendaCtrl = new VendaController(); // Liga o controlador de Vendas

use App\Controllers\AuthController;
$authCtrl = new AuthController(); // Liga o controlador de Login


// --- Funções para Mostrar as Telas ---

// Mostra uma página dentro do visual padrão (com menu e rodapé)
function render($view, $data = [])
{
    extract($data); // Pega os dados e deixa prontos para usar na tela
    ob_start();     // Começa a guardar o conteúdo na memória
    
    // Carrega o "miolo" da página que a gente quer ver
    require __DIR__ . '/../app/Views/' . $view;
    
    $content = ob_get_clean(); // Pega tudo que guardou e coloca na variável $content
    
    // Carrega o esqueleto do site (base) e coloca o conteúdo lá dentro
    require __DIR__ . '/../app/Views/layouts/base.php';
}

// Mostra uma página "limpa", sem o menu padrão (usado no Login)
function render_sem_login($view, $data = [])
{
    extract($data);
    ob_start();
    $content = ob_get_clean();
    require __DIR__ . '/../app/Views/' . $view;
}

// Mostra as telas da área administrativa (Dashboard)
function render_dashboard($view, $data = [])
{
    extract($data);
    ob_start();
    $content = ob_get_clean();
    require __DIR__ . '/../app/Views/' . $view;
}

// --- Sistema de Rotas (O GPS do Site) ---

// Vê qual endereço (link) o usuário digitou no navegador
$url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Se for a página inicial "/"
if ($url == "/") {
    render('home.php', ['title' => 'Home MestredaBrasa']);

} else if ($url == '/sobre') {
    render('sobre.php', ['title' => 'Sobre MestredaBrasa']);

} else if ($url == '/contato') {
    render('contato.php', ['title' => 'Contato MestredaBrasa']);

// Se tentou entrar no sistema (clicou no botão "Logar")
} else if ($url == '/login' && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $authCtrl->login(); 

// Se só acessou a tela de login
} else if ($url == '/login') {
    render_sem_login('auth/login.php', ['title' => 'Login MestredaBrasa']);

} else if ($url == '/logout') {
    $authCtrl->logout(); // Sai da conta

// Se tentou acessar o painel administrativo
} else if ($url == "/dashboard") {
    // Se não tiver logado, manda pra tela de login
    if (!isset($_SESSION['usuario_email'])) {
        header('Location: /login');
        exit;
    }

    // Busca as informações mais recentes para mostrar na tela
    $clientesRecentes = \App\Models\Usuario::buscarClientesRecentes();
    $vendasRecentes = \App\Models\Venda::buscarVendasRecentes();
    $produtosRecentes = \App\Models\Produto::buscarProdutosRecentes();

    render_dashboard('dashboard.php', [
        'title' => 'Dashboard MestredaBrasa',
        'clientesRecentes' => $clientesRecentes,
        'vendasRecentes' => $vendasRecentes,
        'produtosRecentes' => $produtosRecentes
    ]);

// Rotas de Usuários
} else if ($url == "/usuarios/novo") {
    render('usuarios/cadastro-usuarios.php', ['title' => 'Cadastro MestredaBrasa']);

} else if ($url == "/usuarios/registrar") {
    $usuarioCtrl->novo();

} else if ($url == "/clientes") {
    $clientes = $usuarioCtrl->listarClientes();

// Rotas de Produtos
} else if ($url == "/produtos/registrar") {
    render('produtos/registro-produtos.php', ['title' => 'Registro Produto']);

} else if ($url == "/produtos") {
    $produtos = $produtoCtrl->listar();

// Rotas de Vendas
} else if ($url == "/vendas/registrar") {
    $vendaCtrl->novo();

} else if ($url == "/vendas") {
    $vendas = $vendaCtrl->listar();

// Quando clica em "Salvar" nos formulários
} else if ($url == "/usuarios/salvar" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarios = $usuarioCtrl->salvar();

} else if ($url == "/vendas/salvar" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendaCtrl->salvar();
}

// --- Rotas com Números (IDs) ---
// Usa um código especial para pegar o número do ID na URL

// Ações de Usuário (Editar, Salvar Edição, Apagar)
else if (preg_match('#^/usuarios/(\d+)/editar$#', $url, $num)) {
    $usuarioCtrl->editar($num[1]); // Pega o ID e abre a edição

} else if (preg_match('#^/usuarios/(\d+)/atualizar$#', $url, $num) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $usuarioCtrl->atualizar($num[1]);

} else if (preg_match('#^/usuarios/(\d+)/del-fisico$#', $url, $num)) {
    $usuarioCtrl->deleteFisico($num[1]); // Apaga pra sempre

} else if (preg_match('#^/usuarios/(\d+)/del-logico$#', $url, $num)) {
    $usuarioCtrl->deleteLogico($num[1]); // Só esconde o usuário

// Ações de Produto
} else if ($url == "/produtos/novo") {
    $produtoCtrl->novo();

} else if ($url == "/produtos/salvar" && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $produtoCtrl->salvar();

} else if (preg_match('#^/produtos/(\\d+)/editar$#', $url, $num)) {
    $produtoCtrl->editar($num[1]);

} else if (preg_match('#^/produtos/(\\d+)/atualizar$#', $url, $num) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $produtoCtrl->atualizar($num[1]);

} else if (preg_match('#^/produtos/(\\d+)/del-logico$#', $url, $num)) {
    $produtoCtrl->deleteLogico($num[1]);

// Ações de Venda
} else if (preg_match('#^/vendas/(\d+)/editar$#', $url, $num)) {
    $vendaCtrl->editar($num[1]);

} else if (preg_match('#^/vendas/(\d+)/atualizar$#', $url, $num) && $_SERVER['REQUEST_METHOD'] == 'POST') {
    $vendaCtrl->atualizar($num[1]);

} else if (preg_match('#^/vendas/(\d+)/del-logico$#', $url, $num)) {
    $vendaCtrl->deleteLogico($num[1]);

// Se não achou nenhuma página (Erro 404)
} else {
    http_response_code(404);
    echo '<h1>404 - Página não encontrada</h1>';
}