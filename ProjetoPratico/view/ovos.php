<?php require_once __DIR__ . '/../controllers/Ovos.controller.php';
$controller = new OvosController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $controller->salvar();
}
$ovos = $controller->listar();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ovos</title>
</head>

<body>
  <form method="post" action="">
    <label>Tipo de Criação</label>
    <input type="text" name="tipo_criacao" required>
    <label>Cor da Casca</label>
    <input type="text" name="cor_casca" required>
    <label>Tamanho</label>
    <input type="text" name="tamanho" required>
    <label>Preço Unitário</label>
    <input type="number" name="preco_unitario" step="0.01" required>
    <button type="submit">Salvar</button>
    <a href="index.php">Voltar</a>
  </form>
  <table>
    <tr>
      <th>ID</th>
      <th>Tipo de Criação</th>
      <th>Cor da Casca</th>
      <th>Tamanho</th>
      <th>Preço Unitário</th>
    </tr>
    <?php foreach ($ovos as $ovo): ?>
      <tr>
        <td><?= $ovo->getId() ?></td>
        <td><?= $ovo->getTipoCriacao() ?></td>
        <td><?= $ovo->getCorCasca() ?></td>
        <td><?= $ovo->getTamanho() ?></td>
        <td><?= $ovo->getPrecoUnitario() ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>