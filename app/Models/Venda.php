<?php
// Inform em qual área da memória vai ficar alocado
namespace App\Models;

// Importa o Arquivo de BD para ser utilizado nesta classe
use App\Core\Database;

// Importa a classe de BD do PHP
use PDO;
use PDOException;

class Venda
{

    // Busca todos os usuários
    public static function buscarTodos()
    {
        // Inicia a conexão do BD 
        $pdo = Database::conectar();

        // Monta o Script SQL de consulta
        $sql = "SELECT vendas.*, produtos.nome AS nome_produto, usuarios.nome AS nome_usuario, usuarios.cpf FROM vendas ";
        $sql .= "INNER JOIN usuarios ON vendas.id_usuario = usuarios.id_usuario ";
        $sql .= "INNER JOIN produtos ON vendas.id_produto = produtos.id_produto ";
        $sql .= "WHERE vendas.deleted_at IS NULL ";

        // Retorna o resultado do scripit SQL
        return $pdo->query($sql)->fetchAll();
    }

    // Busca apenas 3 vendas mais recentes para o dashboard
    public static function buscarVendasRecentes()
    {
        // Inicia a conexão do BD 
        $pdo = Database::conectar();

        // Monta o Script SQL de consulta
        $sql = "SELECT vendas.*, produtos.nome AS nome_produto, usuarios.nome AS nome_usuario, usuarios.cpf FROM vendas ";
        $sql .= "INNER JOIN usuarios ON vendas.id_usuario = usuarios.id_usuario ";
        $sql .= "INNER JOIN produtos ON vendas.id_produto = produtos.id_produto ";
        $sql .= "WHERE vendas.deleted_at IS NULL ";
        $sql .= "ORDER BY vendas.id_venda DESC LIMIT 3";

        // Retorna o resultado do scripit SQL
        return $pdo->query($sql)->fetchAll();
    }

    // Salva um usuario no BD com os dados da View
    public static function salvar($dados)
    {
        try {
            $pdo = Database::conectar();

            $sql = "INSERT INTO vendas (id_usuario, cpf, id_produto, quantidade, data_venda, forma_pagamento) ";
            $sql .= "VALUES (:id_usuario, :cpf, :id_produto, :quantidade, :data_venda, :forma_pagamento)";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id_usuario', $dados['id_usuario'], PDO::PARAM_INT);
            $stmt->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
            $stmt->bindParam(':id_produto', $dados['id_produto'], PDO::PARAM_INT);
            $stmt->bindParam(':quantidade', $dados['quantidade'], PDO::PARAM_STR);
            $stmt->bindParam(':data_venda', $dados['data_venda'], PDO::PARAM_STR);
            $stmt->bindParam(':forma_pagamento', $dados['forma_pagamento'], PDO::PARAM_STR);

            $stmt->execute();
            return (int) $pdo->lastInsertId();
        } catch (PDOException $e) {
            echo "Erro ao Inserir: " . $e->getMessage();
            exit;
        }
    }

    public static function buscarUm($id)
    {
        $pdo = Database::conectar();
        $sql = "SELECT vendas.*, produtos.nome AS nome_produto, usuarios.nome AS nome_usuario FROM vendas ";
        $sql .= "INNER JOIN usuarios ON vendas.id_usuario = usuarios.id_usuario ";
        $sql .= "INNER JOIN produtos ON vendas.id_produto = produtos.id_produto ";
        $sql .= "WHERE vendas.id_venda = :id LIMIT 1";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function atualizar($dados)
    {
        $pdo = Database::conectar();
        $sql = "UPDATE vendas SET id_usuario = :id_usuario, cpf = :cpf, id_produto = :id_produto, quantidade = :quantidade, data_venda = :data_venda, forma_pagamento = :forma_pagamento WHERE id_venda = :id_venda";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id_usuario', $dados['id_usuario'], PDO::PARAM_INT);
        $stmt->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
        $stmt->bindParam(':id_produto', $dados['id_produto'], PDO::PARAM_INT);
        $stmt->bindParam(':quantidade', $dados['quantidade'], PDO::PARAM_STR);
        $stmt->bindParam(':data_venda', $dados['data_venda'], PDO::PARAM_STR);
        $stmt->bindParam(':forma_pagamento', $dados['forma_pagamento'], PDO::PARAM_STR);
        $stmt->bindParam(':id_venda', $dados['id_venda'], PDO::PARAM_INT);
        return $stmt->execute();
    }

    public static function deletarLogico($id)
    {
        $pdo = Database::conectar();
        $sql = "UPDATE vendas SET deleted_at = NOW() WHERE id_venda = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
