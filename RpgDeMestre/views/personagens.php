<?php

require_once __DIR__ . '/../controllers/PersonagemController.php';
require_once __DIR__ . '/../controllers/JogadorController.php'; //para id
require_once __DIR__ . '/../controllers/ClaController.php'; //para id

$controller = new PersonagemController();

$jogadorController = new JogadorController();
$claController = new ClaController();

$jogadores = $jogadorController->listar();
$clas = $claController->listar();

$personagemEdicao = null;

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
  $personagemEdicao = $controller->buscarPorId($_GET['id']);
}

$personagens = $controller->listar();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Personagens</title>
  <link rel="stylesheet" href="style.css">
</head>

<body class="personagens">
  <form method="post" action="" class="form">
    <?php if ($personagemEdicao): ?>
      <input type="hidden" name="id" value="<?= $personagemEdicao->getId() ?>">
      <input type="hidden" name="acao" value="atualizar">
    <?php endif; ?>
    <div>
      <label for="nome">Nome: *</label>
    </div>
    <div>
      <input type="text" name="nome" id="nome" maxlength="100"
        value="<?= $personagemEdicao ? $personagemEdicao->getNome() : '' ?>" required>
    </div>
    <div>
      <label for="classe">Classe: *</label>
    </div>
    <div>
      <input type="text" name="classe" id="classe" maxlength="50"
        value="<?= $personagemEdicao ? $personagemEdicao->getClasse() : '' ?>" required>
    </div>
    <div>
      <label for="nivel">Nível: *</label>
    </div>
    <div>
      <input type="number" name="nivel" id="nivel" maxlength="3" min="1" max="100"
        value="<?= $personagemEdicao ? $personagemEdicao->getNivel() : '' ?>" required>
    </div>
    <div>
      <label for="especialidade">Especialidade:</label>
    </div>
    <div>
      <input type="text" name="especialidade" id="especialidade" maxlength="100"
        value="<?= $personagemEdicao ? $personagemEdicao->getEspecialidade() : '' ?>">
    </div>
    <div>
      <label for="jogador_id">Jogador: *</label>
    </div>
    <div>
      <select name="jogador_id" id="jogador_id" required>
        <option value=""> Selecione um jogador</option>
        <?php foreach ($jogadores as $jogador): ?>
          <option value="<?= $jogador->getId() ?>" <?= $personagemEdicao && $personagemEdicao->getJogadorId() == $jogador->getId() ? 'selected' : '' ?>>
            <?= $jogador->getNome() ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <label for="cla_id">Clã: *</label>
    </div>
    <div>
      <select name="cla_id" id="cla_id" required>
        <option value=""> Selecione um clã</option>
        <?php foreach ($clas as $cla): ?>
          <option value="<?= $cla->getId() ?>" <?= $personagemEdicao && $personagemEdicao->getClaId() == $cla->getId() ? 'selected' : '' ?>>
            <?= $cla->getNome() ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div>
      <?php if ($personagemEdicao): ?>
        <button type="submit" class="botaoSalvar">Atualizar</button>
      <?php else: ?><button type="submit" class="botaoSalvar">Salvar</button>
      <?php endif; ?><button type="button" class="botaoSalvar"
        onclick="window.location.href='index.php'">Voltar</button>
    </div>

  </form>
  <div class="lista">
    <h3>Lista de Personagens</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Classe</th>
        <th>Nível</th>
        <th>Especialidade</th>
        <th>Jogador</th>
        <th>Clã</th>
        <th>Ações</th>
      </tr>

      <?php foreach ($personagens as $personagem): ?>
        <tr>
          <td><?= $personagem->getId() ?></td>
          <td><?= $personagem->getNome() ?></td>
          <td><?= $personagem->getClasse() ?></td>
          <td><?= $personagem->getNivel() ?></td>
          <td><?= $personagem->getEspecialidade() ?></td>
          <td><?= $personagem->getJogadorNome() ?></td>
          <td><?= $personagem->getClaNome() ?></td>
          <td>
            <button type="button" class="botaoEditar" onclick="window.location.href='personagens.php?id=<?= $personagem->getId()
              ?>'">Editar
            </button>
            <form method="POST" style="display:inline">
              <input type="hidden" name="acao" value="deletar">
              <input type="hidden" name="id" value="<?= $personagem->getId() ?>">

              <button type="submit" class="botaoExcluir"
                onclick="return confirm('Deseja realmente excluir este personagem?')">
                Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>