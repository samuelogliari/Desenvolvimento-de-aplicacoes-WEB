<?php

require_once __DIR__ . '/../controllers/ClaController.php';

$controller = new ClaController();

$claEdicao = null;

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
  $claEdicao = $controller->buscarPorId($_GET['id']);
}

$clas = $controller->listar();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Clas</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="clas">
  <form method="post" action="" class="form">
    <?php if ($claEdicao): ?>
      <input type="hidden" name="id" value="<?= $claEdicao->getId() ?>">
      <input type="hidden" name="acao" value="atualizar">
    <?php endif; ?>

    <label for="nome">Nome: *</label>

    <input type="text" name="nome" id="nome" maxlength="100" value="<?= $claEdicao ? $claEdicao->getNome() : '' ?>"
      required>

    <label for="lider">Lider: *</label>

    <input type="name" name="lider" id="lider" maxlength="100" value="<?= $claEdicao ? $claEdicao->getLider() : '' ?>"
      required>

    <label for="regiao">Região:</label>
    <input type="text" name="regiao" id="regiao" maxlength="100"
      value="<?= $claEdicao ? $claEdicao->getRegiao() : '' ?>">

    <label for="descricao">Descrição:</label>
    <input type="text" name="descricao" id="descricao" maxlength="255"
      value="<?= $claEdicao ? $claEdicao->getDescricao() : '' ?>">



    <div>
      <?php if ($claEdicao): ?>
        <button type="submit" class="botaoSalvar">Atualizar</button>
      <?php else: ?><button type="submit" class="botaoSalvar">Salvar</button>
      <?php endif; ?><button type="button" class="botaoSalvar"
        onclick="window.location.href='index.php'">Voltar</button>
    </div>

  </form>
  <div class="lista">
    <h3>Lista de Clãs</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Lider</th>
        <th>Região</th>
        <th>Descrição</th>
        <th>Ações</th>
      </tr>

      <?php foreach ($clas as $cla): ?>
        <tr>
          <td><?= $cla->getId() ?></td>
          <td><?= $cla->getNome() ?></td>
          <td><?= $cla->getLider() ?></td>
          <td><?= $cla->getRegiao() ?></td>
          <td><?= $cla->getDescricao() ?></td>
          <td>
            <button type="button" class="botaoEditar" onclick="window.location.href='clas.php?id=<?= $cla->getId()
              ?>'">Editar
            </button>
            <form method="POST" style="display:inline">
              <input type="hidden" name="acao" value="deletar">
              <input type="hidden" name="id" value="<?= $cla->getId() ?>">

              <button type="submit" class="botaoExcluir" onclick="return confirm('Deseja realmente excluir este clã?')">
                Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>