<?php

require_once __DIR__ . '/../controllers/JogadorController.php';

$controller = new JogadorController();

$jogadorEdicao = null;

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
  $jogadorEdicao = $controller->buscarPorId($_GET['id']);
}

$jogadores = $controller->listar();

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Jogadores</title>
  <link rel="stylesheet" href="../style.css">
</head>

<body class="jogadores">
  <form method="post" action="" class="form">
    <?php if ($jogadorEdicao): ?>
      <input type="hidden" name="id" value="<?= $jogadorEdicao->getId() ?>">
      <input type="hidden" name="acao" value="atualizar">
    <?php endif; ?>
    <div>
      <label for="nome">Nome:</label>
      <input type="text" name="nome" id="nome" maxlength="100"
        value="<?= $jogadorEdicao ? $jogadorEdicao->getNome() : '' ?>" required>
      <label for="email">Email:</label>
      <input type="email" name="email" id="email" maxlength="100"
        value="<?= $jogadorEdicao ? $jogadorEdicao->getEmail() : '' ?>" required>
      <label for="cep">CEP:</label>
      <input type="text" name="cep" id="cep" maxlength="10" pattern="[0-9]{5}-?[0-9]{3}" /* Validação de CEP no formato
        00000-000 ou 00000000 */ value="<?= $jogadorEdicao ? $jogadorEdicao->getCep() : '' ?>" required>
      <label for="rua">Rua:</label>
      <input type="text" name="rua" id="rua" maxlength="100"
        value="<?= $jogadorEdicao ? $jogadorEdicao->getRua() : '' ?>" required>
      <label for="bairro">Bairro:</label>
      <input type="text" name="bairro" id="bairro" maxlength="100"
        value="<?= $jogadorEdicao ? $jogadorEdicao->getBairro() : '' ?>">
      <label for="cidade">Cidade:</label>
      <input type="text" name="cidade" id="cidade" maxlength="100"
        value="<?= $jogadorEdicao ? $jogadorEdicao->getCidade() : '' ?>">
      <div>
        <?php if ($jogadorEdicao): ?>
          <button type="submit" class="botaoSalvar">Atualizar</button>
        <?php else: ?><button type="submit" class="botaoSalvar">Salvar</button>
        <?php endif; ?><button type="button" class="botaoSalvar"
          onclick="window.location.href='index.php'">Voltar</button>
      </div>

  </form>
  <div class="lista">
    <h3>Lista de Jogadores</h3>
    <table>
      <tr>
        <th>ID</th>
        <th>Nome</th>
        <th>Email</th>
        <th>CEP</th>
        <th>Rua</th>
        <th>Bairro</th>
        <th>Cidade</th>
        <th>Ações</th>
      </tr>

      <?php foreach ($jogadores as $jogador): ?>
        <tr>
          <td><?= $jogador->getId() ?></td>
          <td><?= $jogador->getNome() ?></td>
          <td><?= $jogador->getEmail() ?></td>
          <td><?= $jogador->getCep() ?></td>
          <td><?= $jogador->getRua() ?></td>
          <td><?= $jogador->getBairro() ?></td>
          <td><?= $jogador->getCidade() ?></td>
          <td>
            <button type="button" class="botaoEditar" onclick="window.location.href='jogadores.php?id=<?= $jogador->getId()
              ?>'">Editar
            </button>
            <form method="POST" style="display:inline">
              <input type="hidden" name="acao" value="deletar">
              <input type="hidden" name="id" value="<?= $jogador->getId() ?>">

              <button type="submit" class="botaoExcluir">Excluir</button>
            </form>
          </td>
        </tr>
      <?php endforeach; ?>
    </table>
  </div>
</body>

</html>