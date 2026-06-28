<?php

require_once __DIR__ . '/../controllers/ItemController.php';
require_once __DIR__ . '/../controllers/PersonagemController.php'; //para id


$controller = new ItemController();

$personagemController = new PersonagemController();
$personagens = $personagemController->listar();

$itens = $controller->listar();

// Processa formulários
$itemEdicao = null;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['acao'])) {
    if ($_POST['acao'] == 'atualizar') {
      $controller->atualizar();
    } elseif ($_POST['acao'] == 'deletar') {
      $controller->deletar();
    }
  } else {

    $controller->salvar();
  }
}

// Se vier pela URL
if (isset($_GET['id'])) {
  $itemEdicao = $controller->buscarPorId($_GET['id']);
}

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Itens</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body class="itens">
  <form method="post" action="" class="form">
    <?php if ($itemEdicao): ?>
      <input type="hidden" name="id" value="<?= $itemEdicao->getId() ?>">
      <input type="hidden" name="acao" value="atualizar">
    <?php endif; ?>
    <div>
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" maxlength="100" value="<?= $itemEdicao ? $itemEdicao->getNome() : '' ?>"
        required>

      <label for="tipo">Tipo:</label>
      <input type="text" name="tipo" id="tipo" maxlength="50" value="<?= $itemEdicao ? $itemEdicao->getTipo() : '' ?>"
        required>

      <label for="raridade">Raridade:</label>
      <input type="text" name="raridade" id="raridade" maxlength="50"
        value="<?= $itemEdicao ? $itemEdicao->getRaridade() : '' ?>" required>

      <label for="valor">Valor:</label>
      <input type="number" name="valor" id="valor" maxlength="10" min="0" step="0.01"
        value="<?= $itemEdicao ? $itemEdicao->getValor() : '' ?>" required>

      <label for="personagem_id">Personagem:</label>
      <select name="personagem_id" id="personagem_id" required>

        <option value=""> Selecione um personagem</option>
        <?php foreach ($personagens as $personagem): ?>
          <option value="<?= $personagem->getId() ?>" <?= $itemEdicao && $itemEdicao->getPersonagemId() == $personagem->getId() ? 'selected' : '' ?>>
            <?= $personagem->getNome() ?>
          </option>
        <?php endforeach; ?>
      </select>
      <div>
        <?php if ($itemEdicao): ?>
          <button type="submit" class="botaoSalvar">Atualizar</button>
        <?php else: ?>
          <button type="submit" class="botaoSalvar">Salvar</button>
        <?php endif; ?>
        <button type="button" class="botaoSalvar" onclick="window.location.href='index.php'">Voltar</button>
      </div>
    </div>
  </form>
  <div class="lista">
    <h3>Lista de Itens</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Tipo</th>
        <th>Raridade</th>
        <th>Valor</th>
        <th>Personagem</th>
      </tr>

      <?php foreach ($itens as $item): ?>
        <tr>
          <td><?= $item->getId() ?></td>
          <td><?= $item->getNome() ?></td>
          <td><?= $item->getTipo() ?></td>
          <td><?= $item->getRaridade() ?></td>
          <td><?= $item->getValor() ?></td>
          <td><?= $item->getPersonagemNome() ?></td>
          <td>
            <button type="button" class="botaoEditar" onclick="window.location.href='itens.php?id=<?= $item->getId()
              ?>'">Editar
            </button>
            <form method="POST" style="display:inline">
              <input type="hidden" name="acao" value="deletar">
              <input type="hidden" name="id" value="<?= $item->getId() ?>">

              <button type="submit" class="botaoExcluir" onclick="return confirm('Deseja realmente excluir este item?')">
                Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>