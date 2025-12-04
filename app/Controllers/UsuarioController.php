<?php

//não prescisa iniciar a session

namespace App\Controllers;

//importar o model
use App\Models\Usuario;
use PDOException;

class UsuarioController
{
    //exibe a lista de usuarios

    public function listar()
    {

        // chama a model de usuarios e executa a busca no bd
        $usuarios = Usuario::buscarTodos();


        render("usuarios/listagem-usuarios.php", ['title' => 'Usuários - MestredaBrasa', "usuarios" => $usuarios]);
    }

    // exibe a lista de clientes
    public function listarClientes()
    {
        // chama a model de usuarios e executa a busca no bd
        $todos = Usuario::buscarTodos();
        $clientes = array_filter($todos, function ($u) {
            return isset($u['tipo']) && $u['tipo'] === 'Cliente';
        });
        render("usuarios/clientes.php", ['title' => 'Clientes - MestredaBrasa', "clientes" => $clientes]);
    }

    // Abre o formulario para criar um usuario
    public function novo()
    {
        render('usuarios/cadastro-usuarios.php', [
            'title' => 'Registrar Usuário - MestredaBrasa',
            'acao_botao' => 'Criar'
        ]);
    }

    // Salva um novo usuario no BD
    public function salvar()
    {
        // Sanatização (Remove tudo que não for texto puro, evita golpes)
        $dados = [
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'data_nascimento' => $_POST['data_nascimento'] ?? '',
            'celular' => filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS),
            'rua' => filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS),
            'numero' => filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS),
            'complemento' => filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS),
            'bairro' => filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS),
            'cidade' => filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS),
            'cep' => filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS),
            'estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'tipo' => filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS),
            'senha' => $_POST['senha'] ?? null,
            'confirmar_senha' => $_POST['confirmar_senha'] ?? null

        ];

        // print_r($_POST);exit();
        // Aqui vamos fazer as validações
        $erros = $this->validar($dados);


        //validações
        if (!empty($erros)) {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;

            header('Location: /usuarios/novo');
        } else {
            // Chama o Model passando os dados
            Usuario::salvar($dados);
            $_SESSION['mensagem'] = 'Usuario cadastrado com sucesso!';
            $_SESSION['tipo_mensagem'] = 'success';
            header('Location: /clientes');
        }
    }


    public function editar($id)
    {

        $dados = Usuario::buscarUm($id);

        render("usuarios/cadastro-usuarios.php", [
            'title' => 'Alterar Usuário - NãoSeiLanches',
            "dados" => $dados
        ]);
    }

    public function atualizar($id)
    {
        // Sanatização (Remove tudo que não for texto puro, evita golpes)
        $dados = [
            'id_usuario' => $id,
            'nome' => filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS),
            'cpf' => filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_SPECIAL_CHARS),
            'data_nascimento' => $_POST['data_nascimento'] ?? '',
            'celular' => filter_input(INPUT_POST, 'celular', FILTER_SANITIZE_SPECIAL_CHARS),
            'rua' => filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_SPECIAL_CHARS),
            'numero' => filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_SPECIAL_CHARS),
            'complemento' => filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_SPECIAL_CHARS),
            'bairro' => filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_SPECIAL_CHARS),
            'cidade' => filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_SPECIAL_CHARS),
            'cep' => filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_SPECIAL_CHARS),
            'estado' => filter_input(INPUT_POST, 'estado', FILTER_SANITIZE_SPECIAL_CHARS),
            'email' => filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL),
            'tipo' => filter_input(INPUT_POST, 'tipo', FILTER_SANITIZE_SPECIAL_CHARS),
            'senha' => $_POST['senha'] ?? null,
            'confirmar_senha' => $_POST['confirmar_senha'] ?? null,

        ];

        // print_r($_POST);exit();
        // Aqui vamos fazer as validações
        $erros = $this->validar($dados);


        //validações
        if (!empty($erros)) {
            $_SESSION['erros'] = $erros;
            $_SESSION['dados'] = $dados;

            header('Location: /usuarios/' . $id . '/editar');
        } else {
            // Chama o Model passando os dados
            Usuario::atualizar($dados);
            $_SESSION['mensagem'] = "Usuario: " . $dados;
            $_SESSION['tipo_mensagem'] = 'success';
            header('Location: /clientes');
        }
    }
    // Apenas coloca a data de excluisão no BD
    public function deleteLogico($id)
    {
        Usuario::deletarLogico($id);
        header('Location: /clientes');
    }

    // Exclui definitivamente o registro da tabela
    public function deleteFisico($id)
    {
        Usuario::deletarFisico($id);
        header('Location: /usuarios');
    }


    //Implementa a validação e sanitização dos dados do form(limpeza segura)
    public function validar($dados)
    {
        $erros = [];

        // validação do nome
        if (empty($dados['nome'])) {
            $erros[] = "O nome é obrigatório!";
        } else if (strlen($dados['nome']) < 3) {
            $erros[] = "O nome deve ter pelo menos 3 caracteres";
        }

        // validação do senha
        if (empty($dados['senha'])) {
            $erros[] = "A senha é obrigatório!";
        } else if (strlen($dados['senha']) < 6) {
            $erros[] = "O senha deve ter pelo menos 6 caracteres";
        }

        // validação do email
        if (empty($dados['email'])) {
            $erros[] = "O email é obrigatório!";
        } else if (!filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $erros[] = "E-mail informado é invalido!";
        }

        // validação do tipo
        if (empty($dados['tipo'])) {
            $erros[] = "O tipo do usuário é obrigatório!";
        } else if (!in_array($dados['tipo'], ['Administrador', 'Funcionário', 'Cliente'])) {
            $erros[] = "O tipo de usuário é invalido!";
        }

        //outras validações
        //validar o cpf
        //validar se o cpf ja foi cadastrado
        //validar se o email ja foi cadastrado

        //validação da confirmação de senha
        if (empty($dados['senha']) || empty($dados['confirmar_senha'])) {
            $erros[] = "A senha e confirmação de senha são obrigatório!";
        } else if ($dados['senha'] != $dados['confirmar_senha']) {
            $erros[] = "A senha e confirmação de senha deve ser iguais!";
        }

        return $erros;
    }
}
