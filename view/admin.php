<?php
session_start();


require_once "../controller/usuariocontroller.php";
require_once "../db/database.php";

if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== "admin" ){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
    <a href="logout.php">Sair</a>





</body>
</html>
<?php


require_once "../Controller/EventosController.php";

$EventosController = new EventosController($pdo);
$UsuarioController = new UsuarioController($pdo);

$usuarios = $UsuarioController->listar();
$eventos = $EventosController->listar();


?>
