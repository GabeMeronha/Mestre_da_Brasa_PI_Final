<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="/img/imglogo.webp" type="image/x-icon">
    <title><?= $title ?? 'Mestre da Brasa' ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            background-color: #121212;
            background-image: radial-gradient(circle at top right, #1f1f1f 0%, #121212 100%);
            color: #e0e0e0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: 'Poppins', sans-serif;
        }

        /* Navbar Premium */
        .navbar {
            background-color: #1a1a1a !important;
            border-bottom: 1px solid #333;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        .navbar-brand img {
            filter: drop-shadow(0 0 5px rgba(255, 152, 0, 0.5));
        }

        /* Estilos Gerais de Cards */
        .card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 12px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            color: #fff;
        }

        .card-body {
            padding: 2rem;
        }

        /* Estilos de Formulários Globais */
        .form-control, .form-select {
            background-color: #2c2c2c !important;
            border: 1px solid #444 !important;
            color: #fff !important;
        }

        .form-control:focus, .form-select:focus {
            background-color: #333 !important;
            border-color: #ff9800 !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 152, 0, 0.25) !important;
            color: #fff !important;
        }

        label {
            color: #ccc;
            margin-bottom: 5px;
        }

        /* Estilos de Tabelas Globais */
        .table {
            --bs-table-bg: #1e1e1e;
            --bs-table-color: #e0e0e0;
            border-color: #333;
        }
        
        .table-hover tbody tr:hover {
            color: #fff;
            background-color: #2a2a2a;
        }

        .table thead th {
            background-color: #1a1a1a;
            color: #ff9800;
            border-bottom: 2px solid #ff9800;
        }

        /* Botões */
        .btn-primary {
            background-color: #ff9800;
            border: none;
            color: #000;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background-color: #e68900;
            color: #000;
        }

        .btn-outline-light:hover {
            background-color: #ff9800;
            border-color: #ff9800;
            color: #000;
        }

        .btn-danger {
            background-color: #dc3545;
        }

        /* Títulos */
        h2 {
            color: #ff9800;
            font-weight: 600;
            margin-bottom: 1.5rem;
            text-shadow: 0 0 10px rgba(255, 69, 0, 0.3);
        }

        .content {
            flex: 1;
            padding-bottom: 60px;
        }

        footer {
            background-color: #1a1a1a !important;
            border-top: 1px solid #333;
            color: #888;
            text-align: center;
            padding: 20px 0;
            margin-top: auto;
            width: 100%;
        }
        
        /* Links */
        a {
            text-decoration: none;
        }

        @media print {
            .btn, .d-flex, nav, header, footer { display: none !important; }
        }



        
        
        
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand d-flex align-items-center" href="/">
    <img src="/img/logo_sem_fundo.png" width="43" height="55" alt="Logo Mestre da Brasa" class="d-inline-block align-text-top">
    <span class="ms-2 fw-bold" style="color: #ff9800;">Mestre da Brasa</span>
</a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <div class="buttoncontato">
                        <a href="/sobre"> <button type="button" class="btn btn-outline-light ms-3">Sobre Nós</button>
                    </div>

                    <div class="buttoncontato">
                        <a href="/contato"> <button type="button" class="btn btn-danger ms-3">Contato</button>
                    </div>
                    
                    <div class="buttoncontato">
                        <a href="/dashboard"> <button type="button" class="btn btn-outline-warning ms-3">Dashboard</button>
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
        © 2025 Pedro Prado e Gabriel Meronha - Mestre da Brasa
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>