<?php if (!isset($vendas) || !is_array($vendas)) $vendas = []; ?>
<h2>Lista de Vendas</h2>
<input type="text" id="search" placeholder="Pesquisar cliente...">
<button><a href="/vendas/registrar">Adicionar Nova Venda</a></button>
<pre></pre>
<div class="table-responsive">
    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>Data</th>
                <th>Cliente</th>
                <th>CPF</th>
                <th>Produto</th>
                <th>Quantidade</th>
                <th>Forma de Pagamento</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody id="tabela-vendas">
            <?php foreach ($vendas as $venda): ?>
                <tr>
                    <td><?= date('d/m/Y', strtotime($venda['data_venda'])) ?></td>
                    <td><?= $venda['nome_usuario'] ?></td>
                    <td><?= htmlspecialchars($venda['cpf'] ?? '') ?></td>
                    <td><?= $venda['nome_produto'] ?></td>
                    <td><?= $venda['quantidade'] ?></td>
                    <td><?= $venda['forma_pagamento'] ?></td>
                    <td class="d-flex gap-2">
                        <a href="/vendas/<?= $venda['id_venda'] ?>/editar" class="btn btn-warning btn-sm w-100">Editar</a>
                        <button class="btn btn-danger btn-sm w-100" onclick="deletarLogico(<?= $venda['id_venda'] ?>)">Excluir</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    function deletarLogico(id) {
        if (confirm('Deseja excluir logicamente esta venda?')) {
            window.location.href = `/vendas/${id}/del-logico`;
        }
    }
</script>

</html>