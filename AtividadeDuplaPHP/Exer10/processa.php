<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $data = $_POST['nascimento'];
    $anoAtual = 2026;

    $idade = $anoAtual - $data;

    if ($idade) {
        echo "Sua idade é $idade <br>";
    }
    
    if ($idade >= 18) {
        echo "Você é maior de idade";
    } else {
        echo "Você é menor de idade";
    }
}
