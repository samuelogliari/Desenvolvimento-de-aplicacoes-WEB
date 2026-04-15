<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $numero = $_POST['n1'];

    $total = ($numero * 4);
    echo "$total é o quadruplo de $numero";

}