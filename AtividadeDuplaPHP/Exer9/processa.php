<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $base = $_POST['b1'];
    $altura = $_POST['a1'];
    $area = $base * $altura;

    echo "$area ² é sua área eba que legal ta bão vai la vai";
}
