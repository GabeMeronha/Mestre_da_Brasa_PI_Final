<?php

namespace App\Controllers;

//importar o model
use App\Models\Venda;
use App\Models\Usuario;
use App\Models\Produto;

class VendaController
{
    //exibe a lista de vendas

    public function listar()
    {
        $vendas = Venda::buscarTodos();
        render('vendas/listagem-vendas.php', [
            'title' => 'Listar Vendas',
            'vendas' => $vendas
        ]);
    }

    // Abre o formulario para criar uma venda
    public function novo()
    {
        $usuarios = Usuario::buscarTodos();
        $produtos = Produto::buscarTodos();
        render('vendas/registro-vendas.php', [
            'title' => 'Registrar venda',
            'usuarios' => $usuarios,
            'produtos' => $produtos
        ]);
    }

    // Salva um nova venda no BD
    public function salvar()
    {
        $dados = [
            'id_usuario' => $_POST['usuario_id'] ?? null,
            'id_produto' => $_POST['produto_id'] ?? null,
            'quantidade' => $_POST['quantidade'] ?? '',
            'data_venda' => $_POST['data_venda'] ?? '',
            'forma_pagamento' => $_POST['forma_pagamento'] ?? '',
            'cpf' => $_POST['cpf'] ?? ''
        ];
        if (empty($dados['id_usuario']) || empty($dados['id_produto'])) {
            // Redireciona de volta com erro
            $_SESSION['erro'] = 'Selecione um usuário e um produto.';
            header('Location: /vendas/registrar');
            exit;
        }
        Venda::salvar($dados);
        header('Location: /vendas');
    }

    public function editar($id)
    {
        $venda = Venda::buscarUm($id);
        $usuarios = Usuario::buscarTodos();
        $produtos = Produto::buscarTodos();
        render('vendas/registro-vendas.php', [
            'title' => 'Editar Venda',
            'dados' => $venda,
            'usuarios' => $usuarios,
            'produtos' => $produtos
        ]);
    }

    public function atualizar($id)
    {
        $dados = [
            'id_venda' => $id,
            'id_usuario' => $_POST['usuario_id'] ?? null,
            'id_produto' => $_POST['produto_id'] ?? null,
            'quantidade' => $_POST['quantidade'] ?? '',
            'data_venda' => $_POST['data_venda'] ?? '',
            'forma_pagamento' => $_POST['forma_pagamento'] ?? '',
            'cpf' => $_POST['cpf'] ?? ''
        ];
        Venda::atualizar($dados);
        header('Location: /vendas');
    }

    public function deleteLogico($id)
    {
        Venda::deletarLogico($id);
        header('Location: /vendas');
    }
}
