<?php

namespace App\Controllers;

//importar o model
use App\Models\Produto;

class ProdutoController
{
    //exibe a lista de produto

    public function listar()
    {
        $produtos = Produto::buscarTodos();
        render('produtos/listagem-produtos.php', [
            'title' => 'Listagem de Produtos',
            'produtos' => $produtos
        ]);
    }

    // Abre o formulario para criar um produto
    public function novo()
    {
        render('produtos/registro-produtos.php', ['title' => 'Registrar Produtos']);
    }

    // Salva um novo produto no BD
    public function salvar()
    {

        if ($_POST['nome'] == '') {
            $erro = "Campo nome deve ser preenchido!";
            header('Location: /produtos/registrar');
        } else {
            // Chama o Model passando os dados
            Produto::salvar($_POST);
            header('Location: /produtos');
        }
    }

    public function editar($id)
    {
        $dados = Produto::buscarUm($id);
        render('produtos/registro-produtos.php', [
            'title' => 'Alterar Produto',
            'dados' => $dados
        ]);
    }

    public function atualizar($id)
    {
        $dados = [
            'id_produto' => $id,
            'nome' => $_POST['nome'] ?? '',
            'descricao' => $_POST['descricao'] ?? '',
            'preco' => $_POST['preco'] ?? '',
            'quantidade_estoque' => $_POST['quantidade_estoque'] ?? ''
        ];
        Produto::atualizar($dados);
        header('Location: /produtos');
    }

    public function deleteLogico($id)
    {
        Produto::deletarLogico($id);
        header('Location: /produtos');
    }
}
