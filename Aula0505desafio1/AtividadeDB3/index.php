<?php

$host = "localhost";
$porta = "5432";
$database = "webDB";
$usuario = "postgres";
$senha = "postgres";

$dsn = "pgsql:host=$host;port=$porta;dbname=$database";
$conexao = new PDO($dsn, $usuario, $senha);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $funcDtNascimento = $_POST['dtNascimento'];
    $funcNome = $_POST['nome'];
    $funcSalario = $_POST['salario'];
    
    $sql = "INSERT INTO funcionarios(dtNascimento, nome, salario) VALUES (?, ?, ?)";
    $smtm = $conexao->prepare($sql);
    $smtm->execute([$funcDtNascimento, $funcNome, $funcSalario]);
}
$sqlListagem = "SELECT * FROM funcionarios";
$resultado = $conexao->query($sqlListagem);
$funcionarios = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Funcionarios moles</title>
</head>
<body>
    <form method="post" action="">
        <label>Data de Nascimento:</label>
        <input type="date" name="dtNascimento"><br>
        <label>Nome:</label>
        <input type="text" name="nome"><br>
        <label>Salario: </label>
        <input type="number" name="salario"><br>
        <button type="submit" >Salvar</button>
    </form>
      <table>
        <tr>
            <th>dtNascimento: </th>
            <th>Nome: </th>
            <th>Salario: </th>
            
        </tr>
        <?php foreach ($funcionarios as $funcionario): ?>
        <tr>
          
            <td><?= $funcionario['dtnascimento'] ?></td>
            <td><?= $funcionario['nome'] ?></td>
            <td><?= $funcionario['salario'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>