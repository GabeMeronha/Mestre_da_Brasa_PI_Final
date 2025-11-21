<?php
// Inform em qual área da memória vai ficar alocado
namespace App\Models;

// Importa o Arquivo de BD para ser utilizado nesta classe
use App\Core\Database;

// Importa a classe de BD do PHP
use PDO;
use PDOException;

class Auth
{
    public static function login($usuario, $senha)
    {
        // Inicia a conexão com o BD
        $pdo = Database::conectar();

        $sql = "SELECT * FROM usuarios WHERE deleted_at IS NULL AND email = :email LIMIT 1";

        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(":email", $usuario, PDO::PARAM_STR);
        $stmt->execute();
        $usuario = $stmt->fetch();

        if ($usuario && password_verify($senha, $usuario['senha'])) {
            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION['usuario_id'] = $usuario['id_usuario'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['usuario_email'] = $usuario['email'];
            $_SESSION['usuario_tipo'] = $usuario['tipo'];
            return true;
        }
        return false;
    }
}
