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
</head>

<body>
  <form method="post" action="">
    <label>Nome</label>
    <input type="text" name="nome" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Telefone</label>
    <input type="text" name="telefone" maxlength="11" required>
    <label>CNPJ</label>
    <input type="text" name="cnpj" maxlength="14" required>
    <label>Ativo</label>
    <input type="checkbox" name="ativo" value="1">
    <button type="submit">Salvar</button>
    <a href="index.php">Voltar</a>
  </form>
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
</body>

</html>