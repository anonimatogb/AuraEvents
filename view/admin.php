<?php
session_start();

require_once "../controller/usuariocontroller.php";
require_once "../db/database.php";

if(isset($_SESSION['cargo']) || $_SESSION['cargo'] !== "admin" ){
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
</head>
<body>

    <form method="POST">

<input type="text" name="nome" placeholder="Nome do evento" required>

<textarea name="descricao" placeholder="Descrição"></textarea>

<input type="date" name="data_evento" required>

<input type="time" name="horario" required>

<input type="text" name="local_evento" placeholder="Local" required>

<input type="number" name="max_participantes" placeholder="Máx participantes">

<button type="submit">Cadastrar Evento</button>

</form>


</body>
</html>

