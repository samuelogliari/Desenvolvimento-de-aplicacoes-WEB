<?php

$host = "localhost";
$porta = "4777";
$database = "webDB";
$usuario = "postgres";
$senha = "postgres";

$dsn = "pgsql:host=$host;port=$porta;dbname=$database";
$conexao = new PDO($dsn, $usuario, $senha);
// "Nome do Evento", "Data" e "Local"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $evenNome = $_POST['nome'];
  $evenData = $_POST['dt'];
  $evenLocal = $_POST['lc'];

  $sql = "INSERT INTO eventos(nome, dt, lc) VALUES (?, ?, ?)";
  $smtm = $conexao->prepare($sql);
  $smtm->execute([$evenNome, $evenData, $evenLocal]);
}
$sqlListagem = "SELECT * FROM eventos ORDER BY dt ASC";
$resultado = $conexao->query($sqlListagem);
$eventos = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Eventos</title>
</head>

<body>
  <form method="post" action="">
    <label>Nome do Evento</label>
    <input type="text" name="nome"><br>
    <label>Data</label>
    <input type="date" name="dt"><br>
    <label>Local</label>
    <input type="text" name="lc"><br>
    <button type="submit">Salvar</button>
  </form>
  <table>
    <tr>
      <th>Nome</th>
      <th>Data</th>
      <th>Local</th>
    </tr>
    <?php foreach ($eventos as $evento): ?>
      <tr>

        <td><?= $evento['nome'] ?></td>
        <td><?= $evento['dt'] ?></td>
        <td><?= $evento['lc'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>