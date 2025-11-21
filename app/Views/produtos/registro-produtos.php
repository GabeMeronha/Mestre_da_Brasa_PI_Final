<?php
$dados = $dados ?? [];
$rota = isset($dados['id_produto']) ? "/produtos/{$dados['id_produto']}/atualizar" : "/produtos/salvar";
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
                <h2 class="mb-4"><?= isset($dados['id_produto']) ? 'Editar Produto' : 'Cadastro de Produtos' ?></h2>
            </div>
            <form action="<?= $rota ?>" method="POST" class="row g-3">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="nome" class="form-label">Nome do Produto</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="nome" name="nome" placeholder="Digite o nome do produto" required value="<?= htmlspecialchars($dados['nome'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="descricao" name="descricao" placeholder="Descrição do produto" required value="<?= htmlspecialchars($dados['descricao'] ?? '') ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="preco" class="form-label">Preço</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="preco" name="preco" placeholder="Digite o preço" required value="<?= htmlspecialchars($dados['preco'] ?? '') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="quantidade_estoque" class="form-label">Quantidade em Estoque</label>
                        <input type="text" class="form-control form-control-sm bg-dark text-white border-secondary" id="quantidade_estoque" name="quantidade_estoque" placeholder="Quantidade em estoque" required value="<?= htmlspecialchars($dados['quantidade_estoque'] ?? '') ?>">
                    </div>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-success btn-sm w-100 mb-2">Salvar</button>
                    <a href="/produtos" class="btn btn-secondary btn-sm w-100 mb-2">Voltar</a>
                    <button type="reset" class="btn btn-outline-light btn-sm w-100">Limpar</button>
                </div>
            </form>
        </div>
    </div>
</div>

</html>