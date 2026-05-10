<?php

$host = "localhost";
$porta = "4777";
$database = "webDB";
$usuario = "postgres";
$senha = "postgres";

$dsn = "pgsql:host=$host;port=$porta;dbname=$database";
$conexao = new PDO($dsn, $usuario, $senha);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $livTitulo = $_POST['titulo'];
    $livAutor = $_POST['autor'];
    $livIsbn = $_POST['isbn'];

    $sql = "INSERT INTO livros(titulo, autor, isbn) VALUES (?, ?, ?)";
    $smtm = $conexao->prepare($sql);
    $smtm->execute([$livTitulo, $livAutor, $livIsbn]);
}
$sqlListagem = "SELECT * FROM livros";
$resultado = $conexao->query($sqlListagem);
$livros = $resultado->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Livros</title>
</head>
<body>
    <form method="post" action="">
        <label>titulo</label>
        <input type="text" name="titulo"><br>
        <label>autor</label>
        <input type="text" name="autor"><br>
        <label>isbn</label>
        <input type="text" name="isbn" maxlength="13"><br>
        <button type="submit">Salvar</button>
    </form>
      <table>
        <tr>
            <th>Titulo</th>
            <th>Autor</th>
            <th>Isbn</th>
        </tr>
        <?php foreach ($livros as $livro): ?>
        <tr>
          
            <td><?= $livro['titulo'] ?></td>
            <td><?= $livro['autor'] ?></td>
            <td><?= $livro['isbn'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>