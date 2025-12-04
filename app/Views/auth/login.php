<?php
// Removido o redirecionamento automático para a dashboard
?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Mestre da Brasa</title>
    <link rel="icon" href="/img/imglogo.webp" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap');

        body {
            background-color: #121212;
            background-image: radial-gradient(circle at center, #1f1f1f 0%, #000000 100%);
            color: #fff;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Poppins', sans-serif;
        }

        .login-card {
            background-color: #1e1e1e;
            border: 1px solid #333;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
            text-align: center;
        }

        .login-card img {
            filter: drop-shadow(0 0 8px rgba(255, 152, 0, 0.6));
            margin-bottom: 20px;
        }

        .form-control {
            background-color: #2c2c2c !important;
            border: 1px solid #444 !important;
            color: #fff !important;
            height: 50px;
        }

        .form-control:focus {
            border-color: #ff9800 !important;
            box-shadow: 0 0 0 0.25rem rgba(255, 152, 0, 0.25) !important;
        }

        .form-floating label {
            color: #aaa;
        }

        .btn-primary {
            background-color: #ff9800;
            border: none;
            font-weight: 600;
            color: #000;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            background-color: #e68900;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(230, 137, 0, 0.4);
        }

        a {
            color: #ff9800;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
            color: #e68900;
        }
    </style>
</head>

<body>
    <main class="login-card">
        <?php if (isset($_SESSION['erros'])): $erros = $_SESSION['erros']; ?>
            <div class="alert alert-danger text-start" role="alert">
                <small>
                    <ul class="mb-0 ps-3">
                        <?php foreach ($erros as $e): ?>
                            <li><?= $e ?></li>
                        <?php endforeach; ?>
                    </ul>
                </small>
            </div>
            <?php unset($_SESSION['erros']); ?>
        <?php endif; ?>

        <img src="/img/imglogo.webp" height="80" alt="Logo">

        <h1 class="h4 mb-4 fw-bold">Acesse sua Conta</h1>

        <form action="/login" method="POST">
            <div class="form-floating mb-3">
                <input type="email" class="form-control" id="email" name="email" placeholder="nome@exemplo.com">
                <label for="email">E-mail</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" id="senha" name="senha" placeholder="Senha">
                <label for="senha">Senha</label>
            </div>
            
            <div class="form-check text-start my-3">
                <input type="checkbox" class="form-check-input" id="flexCheckDefault">
                <label class="form-check-label text-secondary" for="flexCheckDefault">Lembrar de mim</label>
            </div>

            <button type="submit" class="btn btn-primary w-100 py-3 mb-3">ENTRAR</button>
            
            <p class="text-secondary small">Não tem conta? <a href="/usuarios/novo">Cadastre-se</a></p>
        </form>
    </main>
</body>

<footer class="fixed-bottom text-center py-3 text-secondary small bg-dark">
    © 2025 Pedro Prado e Gabriel Meronha
</footer>

</html>