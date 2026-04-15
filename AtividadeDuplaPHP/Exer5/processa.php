<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $celsius = $_POST['celsius'];

    $F = ($celsius * 1.8 + 32);

    echo "$F";
}
