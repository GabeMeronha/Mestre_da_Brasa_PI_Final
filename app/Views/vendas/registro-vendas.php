<?php
$usuarios = $usuarios ?? [];
$produtos = $produtos ?? [];
?>
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
                <h2 class="mb-4"><?= isset($dados['id_venda']) ? 'Editar Venda' : 'Registro de Vendas' ?></h2>
            </div>
            <form action="<?= isset($dados['id_venda']) ? "/vendas/{$dados['id_venda']}/atualizar" : "/vendas/salvar" ?>" method="POST" class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_usuario" class="form-label">Cliente</label>
                        <select class="form-select form-select-sm bg-dark text-white border-secondary" id="usuario_id" name="usuario_id" required onchange="atualizarCPF()">
                            <option value="" selected disabled>Selecione o cliente</option>
                            <?php foreach ($usuarios as $usuario): ?>
                                <option value="<?= $usuario['id_usuario'] ?>" data-cpf="<?= $usuario['cpf'] ?>" <?= (isset($dados['id_usuario']) && $dados['id_usuario'] == $usuario['id_usuario']) ? 'selected' : '' ?>>
                                    <?= $usuario['nome'] ?> (<?= $usuario['email'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="data_venda" class="form-label">Data da Venda</label>
                        <input type="date" class="form-control form-control-sm bg-dark text-white border-secondary" id="data_venda" name="data_venda" required value="<?= isset($dados['data_venda']) ? $dados['data_venda'] : '' ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="id_produto" class="form-label">Produto</label>
                        <select class="form-select form-select-sm bg-dark text-white border-secondary" id="produto_id" name="produto_id" required>
                            <option value="" selected disabled>Selecione o produto</option>
                            <?php foreach ($produtos as $produto): ?>
                                <option value="<?= $produto['id_produto'] ?>" <?= (isset($dados['id_produto']) && $dados['id_produto'] == $produto['id_produto']) ? 'selected' : '' ?>>
                                    <?= $produto['nome'] ?> (R$ <?= $produto['preco'] ?>)
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantidade" class="form-label">Quantidade</label>
                        <input type="number" class="form-control form-control-sm bg-dark text-white border-secondary" id="quantidade" name="quantidade" min="1" required value="<?= isset($dados['quantidade']) ? htmlspecialchars($dados['quantidade']) : '' ?>">
                    </div>
                    <div class="mb-3">
                        <label for="forma_pagamento" class="form-label">Forma de Pagamento</label>
                        <select class="form-select form-select-sm bg-dark text-white border-secondary" id="forma_pagamento" name="forma_pagamento" required>
                            <option value="" selected disabled>Selecione</option>
                            <option value="Dinheiro" <?= (isset($dados['forma_pagamento']) && $dados['forma_pagamento'] == 'Dinheiro') ? 'selected' : '' ?>>Dinheiro</option>
                            <option value="Cartão" <?= (isset($dados['forma_pagamento']) && $dados['forma_pagamento'] == 'Cartão') ? 'selected' : '' ?>>Cartão</option>
                            <option value="PIX" <?= (isset($dados['forma_pagamento']) && $dados['forma_pagamento'] == 'PIX') ? 'selected' : '' ?>>PIX</option>
                        </select>
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success btn-sm w-100 mb-2">
                        <?= isset($dados['id_venda']) ? 'Editar' : 'Salvar' ?>
                    </button>
                    <a href="/vendas" class="btn btn-secondary btn-sm w-100 mb-2">Voltar</a>
                    <button type="reset" class="btn btn-outline-light btn-sm w-100">Limpar</button>
                </div>
            </form>
            <input type="hidden" id="cpf" name="cpf" value="<?= isset($dados['cpf']) ? htmlspecialchars($dados['cpf']) : '' ?>">
        </div>
    </div>
</div>

<script>
    function atualizarCPF() {
        var select = document.getElementById('usuario_id');
        var cpfInput = document.getElementById('cpf');
        var selected = select.options[select.selectedIndex];
        cpfInput.value = selected.getAttribute('data-cpf') || '';
    }
    // Preenche o CPF ao carregar a página se já houver valor selecionado
    window.onload = function() {
        atualizarCPF();
    };
</script>

</html>