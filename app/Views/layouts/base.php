<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="img/imglogo.webp" type="image/x-icon">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: rgb(22, 22, 22);
            color: white;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .card {
            border-radius: 10px;
        }

        .logo {
            max-width: 120px;
        }

        .content {
            flex: 1;
            padding-bottom: 60px;
        }

        footer {
            background-color: #343a40;
            color: white;
            text-align: center;
            padding: 15px 0;
            margin-top: auto;
            width: 100%;
        }

        @media print {

            .btn,
            .d-flex,
            nav,
            header,
            footer {
                display: none !important;
                /* Oculta botões e outros elementos não essenciais */
            }
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
                    <div class="buttoncontato">
                        <a href="/dashboard"> <button type="button" class="btn btn-danger ms-3">Dashboard</button>
                    </div>
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

    <div class="container mt-4 content">
        <?php
        echo $content;
        ?>
    </div>

    <footer class="bg-dark text-light text-center py-3">
        © 2025 Pedro Prado e Gabriel Meronha
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>