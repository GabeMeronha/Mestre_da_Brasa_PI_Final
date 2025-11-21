<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/imglogo.webp" type="image/x-icon">
    <title>Dashboard - Não Sei Lanches</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(22, 22, 22);
            color: white;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .card {
            border-radius: 10px;
            min-height: 300px;
        }

        .logo {
            max-width: 120px;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .card-content {
            flex-grow: 1;
        }

        .list-group-item {
            background-color: transparent;
            border: none;
            color: inherit;
            padding: 8px 0;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="img/logo_sem_fundo.png" width="43" height="55" alt="Logo Não Sei Lanches" class="d-inline-block align-text-top">
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <div class="buttoncontato">

                        <a href="/contato"> <button type="button" class="btn btn-danger ms-3">Contato</button>

                    </div>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Vendas
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/vendas">Listagem de vendas</a></li>
                            <li><a class="dropdown-item" href="/vendas/registrar">Registro de vendas</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Produtos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/produtos">Listagem de Produtos</a></li>
                            <li><a class="dropdown-item" href="/produtos/registrar">Cadastrar Produtos</a></li>
                        </ul>
                    </li>
                    <?php if (isset($_SESSION['usuario_id'])): ?>
                        <li class="nav-item">
                            <a href="/logout"><button type="button" class="btn btn-outline-danger ms-2">Logout</button></a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a href="/login"><button type="button" class="btn btn-outline-light ms-2">Login</button></a>
                        </li>
                        <li class="nav-item">
                            <a href="/usuarios/novo"><button type="button" class="btn btn-outline-light ms-2">Cadastro</button></a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if (isset($_SESSION['mensagem_sucesso'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Sucesso ao entrar!</strong> <?= $_SESSION['mensagem_sucesso'] ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['mensagem_sucesso']); ?>
        <?php endif; ?>
        <div class="d-flex justify-content-center align-items-center">
            <h2 class="text-light">Dashboard - Não Sei Lanches</h2>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="card text-white bg-dark mb-3">
                    <div class="card-body text-center">
                        <div class="card-content">
                            <h5 class="card-title">Clientes No Sistema</h5>
                            <?php if (isset($clientesRecentes) && !empty($clientesRecentes)): ?>
                                <div class="table-responsive">
                                    <table class="table table-secondary table-sm">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Email</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($clientesRecentes as $cliente): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($cliente['nome']) ?></td>
                                                    <td><?= htmlspecialchars($cliente['email']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-muted">Nenhum cliente cadastrado</p>
                            <?php endif; ?>
                        </div>
                        <a href="/clientes" class="btn btn-light mt-3">Ver Detalhes</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card text-white bg-secondary mb-3">
                    <div class="card-body text-center">
                        <div class="card-content">
                            <h5 class="card-title">Vendas No Sistema</h5>
                            <?php if (isset($vendasRecentes) && !empty($vendasRecentes)): ?>
                                <div class="table-responsive">
                                    <table class="table table-secondary table-sm">
                                        <thead>
                                            <tr>
                                                <th>Cliente</th>
                                                <th>Produto</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($vendasRecentes as $venda): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($venda['nome_usuario']) ?></td>
                                                    <td><?= htmlspecialchars($venda['nome_produto']) ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-muted">Nenhuma venda registrada</p>
                            <?php endif; ?>
                        </div>
                        <a href="/vendas" class="btn btn-light mt-3">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-6 mx-auto">
                <div class="card text-dark bg-warning mb-3">
                    <div class="card-body text-center">
                        <div class="card-content">
                            <h5 class="card-title">Produtos No Sistema</h5>
                            <?php if (isset($produtosRecentes) && !empty($produtosRecentes)): ?>
                                <div class="table-responsive">
                                    <table class="table table-warning table-sm">
                                        <thead>
                                            <tr>
                                                <th>Nome</th>
                                                <th>Preço</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($produtosRecentes as $produto): ?>
                                                <tr>
                                                    <td><?= htmlspecialchars($produto['nome']) ?></td>
                                                    <td>R$ <?= number_format($produto['preco'], 2, ',', '.') ?></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            <?php else: ?>
                                <p class="text-muted">Nenhum produto cadastrado</p>
                            <?php endif; ?>
                        </div>
                        <a href="/produtos" class="btn btn-light mt-3">Ver Detalhes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <footer class="bg-dark text-light text-center py-3 mt-auto w-100" style="position:relative;">
        © 2025 Pedro Prado e Gabriel Meronha
    </footer>
</body>

</html>