<?php
// Removido o redirecionamento automático para a dashboard

?>
<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="icon" href="img/imglogo.webp" type="image/x-icon">
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="d-flex align-items-center bg-body-tertiary py-5">
    <main class="w-100 m-auto form-container">
        <div class="login-container">
            <?php
            if (isset($_SESSION['erros'])) {
                $erros = $_SESSION['erros'];
            ?>
                <div class="alert alert-danger" role="alert">
                    <h4 class="alert-heading">Erro ao Entrar!</h4>
                    <p>Verifique os itens abaixo em seu formulário antes de tentar novamente!</p>
                    <ul>
                        <?php foreach ($erros as $e): ?>
                            <li><?= $e ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php
                unset($_SESSION['erros']);
            }   ?>
            <img src="img/imglogo.webp" class="mb-4" height="62" width="75" alt="Ícone de hambúrguer">

            <h1 class="h3 fw-normal">Faça seu Login</h1>

            <form action="/login" method="POST">
                <div class="form-floating mb-3">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Digite seu e-mail">
                    <label for="email">E-mail</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Digite sua senha">
                    <label for="senha">Senha</label>
                </div>
                <div class="form-check text-start my-3">
                    <input type="checkbox" class="form-check-input" id="flexCheckDefault">
                    <label for="flexCheckDefault">Lembrar Sempre</label>
                </div>
                <div class="buttondashboard">
                    <button type="submit" class="btn btn-primary w-100 py-2 btn-lg">Logar</button>
                </div>
            </form>

            <p class="mt-3">Não tem conta? <a href="/usuarios/novo">Cadastre-se</a> agora!</p>

        </div>

    </main>
</body>

<footer class="bg-dark text-light text-center py-3 position-absolute bottom-0 w-100">
    © 2025 Pedro Prado e Gabriel Meronha
</footer>

</html>