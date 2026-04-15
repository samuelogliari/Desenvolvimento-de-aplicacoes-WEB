<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nota1 = $_POST['n1'];
    $nota2 = $_POST['n2'];
    $resultado = ($nota1 + $nota2) / 2;

    echo "$resultado é sua média.";
}
