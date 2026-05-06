<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['n1'];

    $total = ($numero * 0.15) + $numero;
    echo "$total é o resultado";

}