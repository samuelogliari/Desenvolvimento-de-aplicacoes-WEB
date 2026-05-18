<?php require_once __DIR__ . '/../controllers/ProdutoresOvos.controller.php';
$controller = new ProdutoresOvosController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $controller->salvar();
}
$produtores = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Produtores de Ovos</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body class="ovos">
  <form method="post" action="" class="form">
    <label>Nome</label>
    <input type="text" name="nome" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Telefone</label>
    <input type="text" name="telefone" maxlength="11" required>
    <label>CNPJ</label>
    <input type="text" name="cnpj" maxlength="14" required>
    <div class="checkbox">
      <label for="ativo">Ativo</label>
      <input id="ativo" type="checkbox" name="ativo" value="1">
    </div>

    <div>
      <button type="submit" class="botaoSalvar">Salvar</button>
      <button class="botaoSalvar" onclick="window.location.href='index.php'">Voltar</button>
    </div>
  </form>

  <div class="lista">
    <h3>Lista de Produtores</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Telefone</th>
        <th>CNPJ</th>
        <th>Ativo</th>
      </tr>
      <?php foreach ($produtores as $produtor): ?>
        <tr>
          <td><?= $produtor->getId() ?></td>
          <td><?= $produtor->getNome() ?></td>
          <td><?= $produtor->getEmail() ?></td>
          <td><?= $produtor->getTelefone() ?></td>
          <td><?= $produtor->getCnpj() ?></td>
          <td><?= $produtor->isAtivo() ? 'Sim' : 'Não' ?></td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>