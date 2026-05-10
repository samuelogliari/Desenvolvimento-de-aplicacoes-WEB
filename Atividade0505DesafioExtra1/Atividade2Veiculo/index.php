<?php

$host = "localhost";
$porta = "4777";
$database = "webDB";
$usuario = "postgres";
$senha = "postgres";

$dsn = "pgsql:host=$host;port=$porta;dbname=$database";
$conexao = new PDO($dsn, $usuario, $senha);
//"Placa", "Modelo" e "Marca"
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $veicPlaca = $_POST['placa'];
  $veicModelo = $_POST['modelo'];
  $veicMarca = $_POST['marca'];

  $sql = "INSERT INTO veiculos(placa, modelo, marca) VALUES (?, ?, ?)";
  $smtm = $conexao->prepare($sql);
  $smtm->execute([$veicPlaca, $veicModelo, $veicMarca]);
}
$sqlListagem = "SELECT * FROM veiculos";
$resultado = $conexao->query($sqlListagem);
$veiculos = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Veículos</title>
</head>

<body>
  <form method="post" action="">
    <label>Placa (Coloque sem -)</label>
    <input type="text" name="placa" maxlength="8"><br>
    <label>Modelo</label>
    <input type="text" name="modelo"><br>
    <label>Marca</label>
    <input type="text" name="marca"><br>
    <button type="submit">Salvar</button>
  </form>
  <table>
    <tr>
      <th> Placa</th>
      <th>Modelo</th>
      <th>Marca</th>
    </tr>
    <?php foreach ($veiculos as $veiculo): ?>
      <tr>

        <td><?= $veiculo['placa'] ?></td>
        <td><?= $veiculo['modelo'] ?></td>
        <td><?= $veiculo['marca'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>