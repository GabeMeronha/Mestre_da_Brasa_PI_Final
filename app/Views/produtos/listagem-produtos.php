<?php if (!isset($produtos) || !is_array($produtos)) $produtos = []; ?>
<h2>Lista de Produtos</h2>
<input type="text" id="search" placeholder="Pesquisar produto...">
<button><a href="/produtos/registrar">Adicionar Novo Produto</a></button>
<pre></pre>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Preço</th>
                <th>Estoque</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabela-produtos">
            <?php foreach ($produtos as $produto): ?>
                <tr>
                    <td><?= $produto['id_produto'] ?></td>
                    <td><?= $produto['nome'] ?></td>
                    <td>R$ <?= $produto['preco'] ?></td>
                    <td><?= $produto['quantidade_estoque'] ?></td>
                    <td class="d-flex gap-2">
                        <a href="/produtos/<?= $produto['id_produto'] ?>/editar" class="btn btn-warning btn-sm w-100">Editar</a>
                        <button class="btn btn-danger btn-sm w-100" onclick="deletarLogico(<?= $produto['id_produto'] ?>)">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function deletarLogico(id) {
        if (confirm('Deseja excluir logicamente este produto?')) {
            window.location.href = `/produtos/${id}/del-logico`;
        }
    }
</script>

</html>