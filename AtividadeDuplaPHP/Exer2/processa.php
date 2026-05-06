<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $numeroParOuImpar = $_POST['n1'];

    if ($numeroParOuImpar % 2 == 0){
        echo "$numeroParOuImpar é par";
    } else{
        echo "$numeroParOuImpar é impar";
    }

}
