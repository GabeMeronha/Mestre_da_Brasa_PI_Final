<?php
// Inform em qual área da memória vai ficar alocado
namespace App\Models;

// Importa o Arquivo de BD para ser utilizado nesta classe
use App\Core\Database;

// Importa a classe de BD do PHP
use PDO;
use PDOException;

class Produto
{

    // Busca todos os usuários
    public static function buscarTodos()
    {
        // Inicia a conexão do BD 
        $pdo = Database::conectar();

        // Monta o Script SQL de consulta
        $sql = "SELECT * FROM produtos WHERE deleted_at IS NULL";

        // Retorna o resultado do scripit SQL
        return $pdo->query($sql)->fetchAll();
    }

    // Pra ser sincero, perguntei para a IA como fazer isso e tentei implantar, talvez nao funcione kkkk
    // Busca apenas 3 produtos mais recentes para o dashboard
    public static function buscarProdutosRecentes()
    {
        // Inicia a conexão do BD 
        $pdo = Database::conectar();

        // Monta o Script SQL de consulta
        $sql = "SELECT * FROM produtos WHERE deleted_at IS NULL ORDER BY id_produto DESC LIMIT 3";

        // Retorna o resultado do scripit SQL
        return $pdo->query($sql)->fetchAll();
    }

    // Salva um usuario no BD com os dados da View
    public static function salvar($dados)
    {
        try {
            $pdo = Database::conectar();

            $sql = "INSERT INTO produtos (nome, descricao, preco, quantidade_estoque) ";
            $sql .= "VALUES (:nome, :descricao, :preco, :quantidade_estoque)";

            // Prepara o SQL para ser inserido no BD limpando códigos maliciosos
            $stmt = $pdo->prepare($sql);

            // Passa os dados das variaveis para o INSERT do SQL
            $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
            $stmt->bindParam(':preco', $dados['preco'], PDO::PARAM_STR);
            $stmt->bindParam(':quantidade_estoque', $dados['quantidade_estoque'], PDO::PARAM_STR);
            // demais campos

            // Executa o SQL no Banco de Dados
            $stmt->execute();

            // Retorna o ID do registro no BD
            return (int) $pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao Inserir: " . $e->getMessage();
            exit;
        }
    }

    public static function atualizar($dados)
    {
        try {
            $pdo = Database::conectar();
            $sql = "UPDATE produtos SET nome = :nome, descricao = :descricao, preco = :preco, quantidade_estoque = :quantidade_estoque WHERE id_produto = :id_produto";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $stmt->bindParam(':descricao', $dados['descricao'], PDO::PARAM_STR);
            $stmt->bindParam(':preco', $dados['preco'], PDO::PARAM_STR);
            $stmt->bindParam(':quantidade_estoque', $dados['quantidade_estoque'], PDO::PARAM_STR);
            $stmt->bindParam(':id_produto', $dados['id_produto'], PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erro ao atualizar: " . $e->getMessage();
            exit;
        }
    }

    public static function deletarLogico($id)
    {
        $pdo = Database::conectar();
        $sql = "UPDATE produtos SET deleted_at = NOW() WHERE id_produto = :id_produto";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_produto', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function buscarUm($id)
    {
        $pdo = Database::conectar();
        $sql = "SELECT * FROM produtos WHERE deleted_at IS NULL AND id_produto = :id_produto";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_produto', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    }
}
