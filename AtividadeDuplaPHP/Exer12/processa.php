<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $sobrenome = $_POST['sobrenome'];

    $nomeCompleto = "$nome $sobrenome";
    
    echo "Boas vindas!, $nomeCompleto";
}