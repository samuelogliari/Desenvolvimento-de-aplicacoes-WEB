<?php

require_once __DIR__ . '/../controllers/Ovos.controller.php';

$controller = new OvosController();

$ovoEdicao = null;

// Processa formulários
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
  $ovoEdicao = $controller->buscarPorId($_GET['id']);
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
    <?php if ($ovoEdicao): ?>
      <input type="hidden" name="id" value="<?= $ovoEdicao->getId() ?>">
      <input type="hidden" name="acao" value="atualizar">
    <?php endif; ?>
    <label>Tipo de Criação</label>
    <select type="text" name="tipo_criacao" required>
      <option value=""></option>
      <option value="Orgânico" <?= ($ovoEdicao && $ovoEdicao->getTipoCriacao() == 'Orgânico') ? 'selected' : '' ?>>Orgânico
      </option>
      <option value="Convencional" <?= ($ovoEdicao && $ovoEdicao->getTipoCriacao() == 'Convencional') ? 'selected' : '' ?>>
        Convencional</option>
      <option value="Caipira" <?= ($ovoEdicao && $ovoEdicao->getTipoCriacao() == 'Caipira') ? 'selected' : '' ?>>Caipira
      </option>
      <option value="Granja" <?= ($ovoEdicao && $ovoEdicao->getTipoCriacao() == 'Granja') ? 'selected' : '' ?>>Granja
      </option>
      <option value="Livre de Gaiola" <?= ($ovoEdicao && $ovoEdicao->getTipoCriacao() == 'Livre de Gaiola') ? 'selected' : '' ?>>Livre de Gaiola</option>
    </select>
    <label>Cor da Casca</label>
    <select type="text" name="cor_casca" required>
      <option value=""></option>
      <option value="Branca" <?= ($ovoEdicao && $ovoEdicao->getCorCasca() == 'Branca') ? 'selected' : '' ?>>Branca</option>
      <option value="Marrom" <?= ($ovoEdicao && $ovoEdicao->getCorCasca() == 'Marrom') ? 'selected' : '' ?>>Marrom</option>
      <option value="Parda" <?= ($ovoEdicao && $ovoEdicao->getCorCasca() == 'Parda') ? 'selected' : '' ?>>Parda</option>
    </select>
    <label>Tamanho</label>
    <select type="text" name="tamanho" required>
      <option value=""></option>
      <option value="Pequeno" <?= ($ovoEdicao && $ovoEdicao->getTamanho() == 'Pequeno') ? 'selected' : '' ?>>Pequeno
      </option>
      <option value="Médio" <?= ($ovoEdicao && $ovoEdicao->getTamanho() == 'Médio') ? 'selected' : '' ?>>Médio</option>
      <option value="Grande" <?= ($ovoEdicao && $ovoEdicao->getTamanho() == 'Grande') ? 'selected' : '' ?>>Grande</option>
      <option value="Extra Grande" <?= ($ovoEdicao && $ovoEdicao->getTamanho() == 'Extra Grande') ? 'selected' : '' ?>>
        Extra Grande</option>
      <option value="Jumbo" <?= ($ovoEdicao && $ovoEdicao->getTamanho() == 'Jumbo') ? 'selected' : '' ?>>Jumbo</option>
      <option value="Giga" <?= ($ovoEdicao && $ovoEdicao->getTamanho() == 'Giga') ? 'selected' : '' ?>>Giga</option>
    </select>
    <label>Preço Unitário</label>
    <input type="number" min="0" name="preco_unitario" step="0.01" required
      value="<?= $ovoEdicao ? $ovoEdicao->getPrecoUnitario() : '' ?>">
    <div>
      <?php if ($ovoEdicao): ?>
        <button type="submit" class="botaoSalvar">Atualizar</button>
      <?php else: ?><button type="submit" class="botaoSalvar">Salvar</button>
      <?php endif; ?><button type="button" class="botaoSalvar"
        onclick="window.location.href='index.php'">Voltar</button>
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
        <th>Ações</th>
      </tr>

      <?php foreach ($ovos as $ovo): ?>
        <tr>
          <td><?= $ovo->getId() ?></td>
          <td><?= $ovo->getTipoCriacao() ?></td>
          <td><?= $ovo->getCorCasca() ?></td>
          <td><?= $ovo->getTamanho() ?></td>
          <td><?= $ovo->getPrecoUnitario() ?></td>
          <td>
            <button type="button" class="botaoEditar" 
            onclick="window.location.href='ovos.php?id=<?= $ovo->getId() 
            ?>'">Editar
            </button>
            <form method="POST" style="display:inline">
              <input type="hidden" name="acao" value="deletar">
              <input type="hidden" name="id" value="<?= $ovo->getId() ?>">

              <button type="submit" class="botaoExcluir">Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>