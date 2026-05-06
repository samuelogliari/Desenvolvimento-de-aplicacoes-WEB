<?php

$host = "localhost";
$porta = "5432";
$database = "webDB";
$usuario = "postgres";
$senha = "postgres";

$dsn = "pgsql:host=$host;port=$porta;dbname=$database";
$conexao = new PDO($dsn, $usuario, $senha);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $visNome = $_POST['nome'];
    $visCpf = $_POST['cpf'];
    
    $sql = "INSERT INTO visitantes(nome, cpf) VALUES (?, ?)";
    $smtm = $conexao->prepare($sql);
    $smtm->execute([$visNome, $visCpf]);
}
$sqlListagem = "SELECT * FROM visitantes";
$resultado = $conexao->query($sqlListagem);
$visitantes = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitantes moles</title>
</head>
<body>
    <form method="post" action="">
        <label>Nome</label>
        <input type="text" name="nome"><br>
        <label>cpf</label>
        <input type="number" name="cpf"><br>
        <button type="submit">Salvar</button>
    </form>
      <table>
        <tr>
            <th>Nome</th>
            <th>Cpf</th>
            
        </tr>
        <?php foreach ($visitantes as $visitante): ?>
        <tr>
          
            <td><?= $visitante['nome'] ?></td>
            <td><?= $visitante['cpf'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>