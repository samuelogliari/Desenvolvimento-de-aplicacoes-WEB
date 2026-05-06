<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $totalConta = $_POST['valorConta'];
    $numeroPessoas = $_POST['NumeroPessoas'];

    $total = ($totalConta / $numeroPessoas);
    echo "$total é o valor que $numeroPessoas deve pagar";

}