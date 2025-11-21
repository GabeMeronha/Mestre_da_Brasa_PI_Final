<?php
if (isset($_SESSION['dados'])) {
    $dados = $_SESSION['dados'];
    unset($_SESSION['dados']);
} elseif (!isset($dados)) {
    $dados = [];
}

// Define ação padrão
$acao = 'Cadastrar';
if (isset($acao_botao)) {
    $acao = $acao_botao;
} elseif (isset($dados['id_usuario'])) {
    $acao = 'Salvar';
}
// Definição correta da rota antes do HTML
if (isset($dados['id_usuario'])) {
    $rota = "/usuarios/{$dados['id_usuario']}/atualizar";
} else {
    $rota = "/usuarios/salvar";
}

if (isset($_SESSION['erros'])) {
    $erros = $_SESSION['erros'];
?>
    <div class="alert alert-danger" role="alert">
        <h4 class="alert-heading">Erro ao cadastrar!</h4>
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
<style>
    ::placeholder {
        color: grey !important;
        opacity: 1;
    }
</style>
<div class="container mt-4 mb-5">
    <div class="card shadow-lg bg-dark text-white mx-auto" style="max-width: 700px;">
        <div class="card-body">
            <div class="text-center">
                <img src="/img/logo_sem_fundo.png" alt="Logo" class="img-fluid d-block mb-3 mx-auto" style="max-width: 200px;">
                <h2 class="mb-4"><?= isset($dados['id_usuario']) ? 'Editar Cliente' : 'Cadastro de Clientes' ?></h2>
            </div>
            <form action="<?= $rota ?>" method="POST" class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="name" name="nome" placeholder="Digite seu nome" required value="<?= htmlspecialchars($dados['nome'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cpf" class="form-label">CPF</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="cpf" name="cpf" placeholder="Digite seu CPF" required value="<?= htmlspecialchars($dados['cpf'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="dataNascimento" class="form-label">Data de Nascimento</label>
                        <input type="date" class="form-control form-control-sm bg-dark text-white border-secondary" id="dataNascimento" name="data_nascimento" required value="<?= htmlspecialchars($dados['data_nascimento'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="telefone" class="form-label">Telefone</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" name="celular" id="telefone" placeholder="Digite seu telefone" required value="<?= htmlspecialchars($dados['celular'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="endereco" class="form-label">Rua</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="endereco" name="rua" placeholder="Rua" required value="<?= htmlspecialchars($dados['rua'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="numero" class="form-label">Número</label>
                        <input type="number" class="form-control form-control-sm bg-dark text-white border-secondary" id="numero" name="numero" placeholder="Número" required value="<?= htmlspecialchars($dados['numero'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="complemento" class="form-label">Complemento</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="complemento" name="complemento" placeholder="Complemento" required value="<?= htmlspecialchars($dados['complemento'] ?? '') ?>">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="bairro" name="bairro" placeholder="Bairro" required value="<?= htmlspecialchars($dados['bairro'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="cidade" name="cidade" placeholder="Cidade" required value="<?= htmlspecialchars($dados['cidade'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="estado" class="form-label">Estado</label>
                        <select class="form-select form-select-sm bg-dark text-white border-secondary" id="estado" name="estado" required>
                            <option selected disabled>Selecione o estado</option>
                            <?php
                            $estados = ["AC", "AL", "AP", "AM", "BA", "CE", "DF", "ES", "GO", "MA", "MT", "MS", "MG", "PA", "PB", "PR", "PE", "PI", "RJ", "RN", "RS", "RO", "RR", "SC", "SP", "SE", "TO"];
                            foreach ($estados as $uf): ?>
                                <option value="<?= $uf ?>" <?= (isset($dados['estado']) && $dados['estado'] == $uf) ? 'selected' : '' ?>><?= $uf ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="cep" name="cep" placeholder="Digite seu CEP" required value="<?= htmlspecialchars($dados['cep'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control form-control-sm bg-dark text-white border-secondary" name="email" id="email" placeholder="Digite seu email" required value="<?= htmlspecialchars($dados['email'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Senha</label>
                        <input type="password" class="form-control form-control-sm bg-dark text-white border-secondary" name="senha" id="password" placeholder="Crie uma senha" <?= isset($dados['id_usuario']) ? '' : 'required' ?>>
                    </div>
                    <div class="mb-3">
                        <label for="confirm-password" class="form-label">Confirme a Senha</label>
                        <input type="password" class="form-control form-control-sm bg-dark text-white border-secondary" name="confirmar_senha" id="confirm-password" placeholder="Confirme sua senha" required>
                    </div>
                </div>

                <div class="col-12">
                    <div class="mb-3">
                        <label class="form-label">Tipo de Usuário</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo" id="cliente" value="Cliente" <?= (isset($dados['tipo']) && $dados['tipo'] == 'Cliente') ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="cliente">Cliente</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo" id="administrador" value="Administrador" <?= (isset($dados['tipo']) && $dados['tipo'] == 'Administrador') ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="administrador">Administrador</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="tipo" id="funcionario" value="Funcionário" <?= (isset($dados['tipo']) && $dados['tipo'] == 'Funcionário') ? 'checked' : '' ?> required>
                            <label class="form-check-label" for="funcionario">Funcionário</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success btn-sm w-100 mb-2">
                        <?= $acao ?>
                    </button>
                    <a href="/clientes" class="btn btn-secondary btn-sm w-100 mb-2">Voltar</a>
                    <button type="reset" class="btn btn-outline-light btn-sm w-100">Limpar</button>
                </div>
            </form>
        </div>
    </div>
</div>