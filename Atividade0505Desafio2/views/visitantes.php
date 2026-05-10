<?php require_once __DIR__ . '/../controllers/Visitantes.controller.php';
$controller = new VisitantesController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $controller->salvar();
}
$visitantes = $controller->listar();

?>
<?php require_once './components/header.php'; ?>

<title>Visitantes moles</title>
</head>

<body>
  <form method="POST" action="">
    <label>Nome</label>
    <input type="text" name="nome">
    <label>CPF</label>
    <input type="text" name="cpf" maxlength="11">
    <button type="submit">Salvar</button>
    <a href="index.php">Voltar</a>
  </form>

  <table>
    <tr>
      <br>
      <th>ID</th>
      <th>Nome</th>
      <th>CPF</th>
    </tr>
    <?php foreach ($visitantes as $visitante): ?>

      <tr>
        <td><?= $visitante->getId() ?></td>
        <td><?= $visitante->getNome() ?></td>
        <td><?= $visitante->getCpf() ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
<?php require_once './components/footer.php'; ?>