<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $metros = $_POST['n1'];

    $resultado = $metros * 100;

    echo "$resultado Centimetros.";
}
