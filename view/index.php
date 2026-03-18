<?php
session_start();

require_once "../controller/usuariocontroller.php";
require_once "../controller/eventoscontroller.php";
require_once "../db/database.php";

$coisa = $_SESSION['usuario_nome'] ;

if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] == "admin" ){
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Início</title>
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav>
        <h2>Bem vindo, <?= $coisa ?>!</h2>
        <a href="index.php">Início</a>
        <a href="#eventos">Eventos</a>
        <a href="logout.php">Sair</a>
    </nav>

    
<?php
$EventosController = new EventosController($pdo);


$eventos = $EventosController->alistar();



?>

</body>
</html>

