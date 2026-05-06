<?php

$host = "localhost";
$porta = "5432";
$database = "webDB";
$usuario = "postgres";
$senha = "postgres";

$dsn = "pgsql:host=$host;port=$porta;dbname=$database";
$conexao = new PDO($dsn, $usuario, $senha);

if ($_SERVER["REQUEST_METHOD"] == "POST"){
    $proCdBarras = $_POST["cdBarras"];
    $proDescricao = $_POST["descricao"];
    $proPreco = $_POST["preco"];

    $sql = "INSERT INTO produtos(cdBarras, descricao, preco) VALUES (?, ?, ?)";
    $smtm = $conexao->prepare($sql);
    $smtm->execute([$proCdBarras,$proDescricao, $proPreco]);
}
$sqlListagem = "SELECT * FROM produtos";
$resultado = $conexao->query($sqlListagem);
$produtos = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produto moles</title>
</head>
<body>
    <form method="post" action="">
        <label>Cód. de Barras</label>
        <input type="text" name="cdBarras"><br>
        <label>Descrição</label>
        <input type="text" name="descricao"><br>
           <label>Preço</label>
        <input type="number" name="preco">
        <button type="submit">Salvar</button>

    </form>
         <table>
        <tr>
            <th>Cód. de Barras: </th>
            <th>Descrição: </th>
            <th>Preço: </th>
            
        </tr>
        <?php foreach ($produtos as $produto): ?>
        <tr>
          
            <td><?= $produto['cdbarras'] ?></td>
            <td><?= $produto['descricao'] ?></td>
            <td><?= $produto['preco'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>