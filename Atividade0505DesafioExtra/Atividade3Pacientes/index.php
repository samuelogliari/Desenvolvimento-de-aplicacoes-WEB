<?php

$host = "localhost";
$porta = "4777";
$database = "webDB";
$usuario = "postgres";
$senha = "postgres";

$dsn = "pgsql:host=$host;port=$porta;dbname=$database";
$conexao = new PDO($dsn, $usuario, $senha);
// Nome Completo", "Número do Prontuário" e "Tipo Sanguíneo".
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $paciNome = $_POST['nome'];
  $paciProntuario = $_POST['numero_prontuario'];
  $paciTipoSanguineo = $_POST['tipo_sanguineo'];

  $sql = "INSERT INTO pacientes(nome, numero_prontuario, tipo_sanguineo) VALUES (?, ?, ?)";
  $smtm = $conexao->prepare($sql);
  $smtm->execute([$paciNome, $paciProntuario, $paciTipoSanguineo]);
}
$sqlListagem = "SELECT * FROM pacientes";
$resultado = $conexao->query($sqlListagem);
$pacientes = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pacientes</title>
</head>

<body>
  <form method="post" action="">
    <label>Nome Completo</label>
    <input type="text" name="nome"><br>
    <label>Número do Prontuário</label>
    <input type="text" name="numero_prontuario" maxlength="7"><br>
    <label>Tipo Sanguíneo (coloque se é positivo/negativo)</label>
    <input type="text" name="tipo_sanguineo" maxlength="2"><br>
    <button type="submit">Salvar</button>
  </form>
  <table>
    <tr>
      <th>Nome</th>
      <th>Prontuário</th>
      <th>Tipo Sanguíneo</th>
    </tr>
    <?php foreach ($pacientes as $paciente): ?>
      <tr>

        <td><?= $paciente['nome'] ?></td>
        <td><?= $paciente['numero_prontuario'] ?></td>
        <td><?= $paciente['tipo_sanguineo'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>