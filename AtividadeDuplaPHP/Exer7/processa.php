<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['n1'];
    $resultado = $numero * 3;

    echo "$resultado";
}
