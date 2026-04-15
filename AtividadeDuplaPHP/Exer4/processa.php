<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $numeroParOuImpar = $_POST['n1'];

    $total =  $numeroParOuImpar / 4.98;

    echo "Você pode comprar $total dolares";

}