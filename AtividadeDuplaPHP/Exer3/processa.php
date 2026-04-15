<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nota1 = $_POST['n1'];

    for ($i = 1; $i <= 10; $i++) {
        $resultado = $nota1 * $i;
        echo "$resultado";
        echo "";
        echo "<br>";
    }
}
