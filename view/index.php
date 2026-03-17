<?php
session_start();

require_once "../controller/usuariocontroller.php";
require_once "../db/database.php";

$coisa = $_SESSION['cargo'] 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
</head>
<body>
    <p><?= $coisa ?></p>
</body>
</html>

