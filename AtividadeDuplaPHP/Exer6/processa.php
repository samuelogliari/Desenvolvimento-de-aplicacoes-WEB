<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nome = $_POST['nomeProduto'];
    $preco = $_POST['precoProduto'];

    echo "Nome: $nome <br>";
    echo "Preco: R$$preco <br>";

}