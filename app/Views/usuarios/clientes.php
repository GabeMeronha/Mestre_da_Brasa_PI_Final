<?php if (!isset($clientes) || !is_array($clientes)) $clientes = []; ?>
<h2>Lista de Clientes</h2>
<input type="text" id="search" placeholder="Pesquisar cliente...">
<button><a href="/usuarios/registrar">Adicionar Novo Cliente</a></button>
<pre></pre>
<div class="table-responsive">
  <table class="table table-bordered table-hover">
    <thead class="table-dark">
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>CPF</th>
        <th>Data de Nascimento</th>
        <th>Telefone</th>
        <th>Email</th>
        <th>Ações</th>
      </tr>
    </thead>
    <tbody id="tabela-clientes">
      <?php foreach ($clientes as $cliente): ?>
        <?php if ($cliente['tipo'] === 'Cliente'): ?>
          <tr>
            <td><?= $cliente['id_usuario'] ?></td>
            <td><?= $cliente['nome'] ?></td>
            <td><?= $cliente['cpf'] ?></td>
            <td><?= $cliente['data_nascimento'] ?></td>
            <td><?= $cliente['celular'] ?></td>
            <td><?= $cliente['email'] ?></td>
            <td class="d-flex gap-2">
              <a href="/usuarios/<?= $cliente['id_usuario'] ?>/editar" class="btn btn-warning btn-sm w-100">Editar</a>
              <button class="btn btn-danger btn-sm w-100" onclick="deletarLogico(<?= $cliente['id_usuario'] ?>)">Excluir</button>
            </td>
          </tr>
        <?php endif; ?>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>

<script>
  function deletarLogico(id) {
    if (confirm('Deseja excluir logicamente este cliente?')) {
      window.location.href = `/usuarios/${id}/del-logico`;
    }
  }
</script>

</html>