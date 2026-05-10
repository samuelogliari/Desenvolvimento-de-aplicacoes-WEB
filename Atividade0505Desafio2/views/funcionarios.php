<?php require_once __DIR__ . '/../controllers/Funcionarios.controller.php';
$controller = new FuncionariosController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $controller->salvar();
}
$funcionarios = $controller->listar();
?>
<?php require_once './components/header.php'; ?>
<title>Funcionários</title>
</head>

<body>
  <form method="post" action="">
    <label>Data de Nascimento</label>
    <input type="date" name="dtNascimento" required>
    <label>Nome</label>
    <input type="text" name="nome" required>
    <label>Salário</label>
    <input type="number" name="salario" step="0.01" required>
    <button type="submit">Salvar</button>
    <a href="index.php">Voltar</a>
  </form>
  <table>
    <tr>
      <th>ID</th>
      <th>Data de Nascimento</th>
      <th>Nome</th>
      <th>Salário</th>
    </tr>
    <?php foreach ($funcionarios as $funcionario): ?>
      <tr>
        <td><?= $funcionario->getId() ?></td>
        <td><?= $funcionario->getDtNascimento() ?></td>
        <td><?= $funcionario->getNome() ?></td>
        <td><?= $funcionario->getSalario() ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
<?php require_once './components/footer.php'; ?>