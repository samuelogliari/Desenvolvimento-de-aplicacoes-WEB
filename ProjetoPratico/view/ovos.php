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
  <link rel="stylesheet" href="../style.css">
</head>

<body class="ovos">
  <form method="post" action="" class="form">
    <label>Tipo de Criação</label>
    <select type="text" name="tipo_criacao" required>
      <option value=""></option>
      <option value="Orgânico">Orgânico</option>
      <option value="Convencional">Convencional</option>
      <option value="Caipira">Caipira</option>
      <option value="Granja">Granja</option>
      <option value="Livre de Gaiola">Livre de Gaiola</option>
    </select>
    <label>Cor da Casca</label>
    <select type="text" name="cor_casca" required>
      <option value=""></option>
      <option value="Branca">Branca</option>
      <option value="Marrom">Marrom</option>
      <option value="Parda">Parda</option>
    </select>
    <label>Tamanho</label>
    <select type="text" name="tamanho" required>
      <option value=""></option>
      <option value="Pequeno">Pequeno</option>
      <option value="Médio">Médio</option>
      <option value="Grande">Grande</option>
      <option value="Extra Grande">Extra Grande</option>
      <option value="Jumbo">Jumbo</option>
      <option value="Giga">Giga</option>
    </select>
    <label>Preço Unitário</label>
    <input type="number" min="0" name="preco_unitario" step="0.01" required>
    <div>
      <button type="submit" class="botaoSalvar">Salvar</button>
      <button class="botaoSalvar" onclick="window.location.href='index.php'">Voltar</button>
    </div>

  </form>
  <div class="lista">
    <h3>Lista de Ovos</h3>
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
  </div>
</body>

</html>