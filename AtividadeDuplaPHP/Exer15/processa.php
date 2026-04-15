<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['n1'];

    if ($numero > 0) {
        echo "Seu número $numero é positivo.";
    } else if ($numero < 0) {
        echo "Seu número $numero é negativo.";
    } else {
        echo "Seu número é $numero";
    }
}
