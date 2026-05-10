<?php

$host = "localhost";
$porta = "4777";
$database = "webDB";
$usuario = "postgres";
$senha = "postgres";

$dsn = "pgsql:host=$host;port=$porta;dbname=$database";
$conexao = new PDO($dsn, $usuario, $senha);
//  "Nome do Curso", "Carga Horária" (em horas) e "Categoria" (ex: Programação, Design, Negócios)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $cursoNome = $_POST['nome'];
  $cursoCargaHoraria = $_POST['carga_horaria'];
  $cursoCategoria = $_POST['categoria'];

  $sql = "INSERT INTO cursos(nome, carga_horaria, categoria) VALUES (?, ?, ?)";
  $smtm = $conexao->prepare($sql);
  $smtm->execute([$cursoNome, $cursoCargaHoraria, $cursoCategoria]);
}
$sqlListagem = "SELECT * FROM cursos";
$resultado = $conexao->query($sqlListagem);
$cursos = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cursos</title>
</head>

<body>
  <form method="post" action="">
    <label>Nome do Curso</label>
    <input type="text" name="nome"><br>
    <label>Carga Horária (em horas)</label>
    <input type="number" name="carga_horaria" min="0"><br>
    <label>Categoria</label>
    <input type="text" name="categoria"><br>
    <button type="submit">Salvar</button>
  </form>
  <table>
    <tr>
      <th>Nome</th>
      <th>Carga Horária</th>
      <th>Categoria</th>
    </tr>
    <?php foreach ($cursos as $curso): ?>
      <tr>

        <td><?= $curso['nome'] ?></td>
        <td><?= $curso['carga_horaria'] ?></td>
        <td><?= $curso['categoria'] ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
</body>

</html>