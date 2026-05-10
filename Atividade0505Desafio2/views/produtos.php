<?php require_once __DIR__ . '/../controllers/Produtos.controller.php';
$controller = new ProdutosController();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $controller->salvar();
}
$produtos = $controller->listar();
?>
<?php require_once './components/header.php'; ?>
<title>Produtos</title>
</head>

<body>
  <form method="post" action="">
    <label>Código de Barras</label>
    <input type="text" name="idbarras" maxlength="13" required>
    <label>Descrição</label>
    <input type="text" name="descricao" required>
    <label>Preço</label>
    <input type="number" name="preco" step="0.01" required>
    <button type="submit">Salvar</button>
    <a href="index.php">Voltar</a>
  </form>
  <table>
    <tr>
      <th>ID</th>
      <th>Código de Barras</th>
      <th>Descrição</th>
      <th>Preço</th>
    </tr>
    <?php foreach ($produtos as $produto): ?>
      <tr>
        <td><?= $produto->getId() ?></td>
        <td><?= $produto->getIdBarras() ?></td>
        <td><?= $produto->getDescricao() ?></td>
        <td><?= $produto->getPreco() ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>
<?php require_once './components/footer.php'; ?>