<?php

//não prescisa iniciar a session

namespace App\Controllers;

//importar o model
use App\Models\Usuario;
use App\Models\Auth;
use PDOException;

class AuthController
{
    public function login()
    {
        $usuario = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        $senha = $_POST['senha'];

        $erros = [];
        if (empty($usuario)) {
            $erros[] = "O Campo de E-mail é Obrigatório!";
        }
        if (empty($senha)) {
            $erros[] = "O Campo de Senha é Obrigatório!";
        }

        //Validações
        if (!empty($erros)) {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $usuario;
            header('Location: /login');
            exit;
        } else {
            if (Auth::login($usuario, $senha)) {
                $_SESSION['mensagem_sucesso'] = 'Login realizado com sucesso!';

                // Redirecionei baseado no tipo de usuário
                if ($_SESSION['usuario_tipo'] === 'Cliente') {
                    header('Location: /');
                } else {
                    // Administrador ou Funcionário
                    header('Location: /dashboard');
                }
                exit;
            } else {
                $_SESSION['erros'] = ['Usuário e/ou Senha Inválidos!'];
                header('Location: /login');
                exit;
            }
        }
    }

    public function logout()
    {
        unset($_SESSION['usuario_id']);
        unset($_SESSION['usuario_nome']);
        unset($_SESSION['usuario_email']);
        unset($_SESSION['usuario_tipo']);

        session_destroy(); // Apaga completamenet a sessão
        session_start();

        header('Location: /login');
        exit;
    }
}
