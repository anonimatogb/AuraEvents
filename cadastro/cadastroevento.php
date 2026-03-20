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

    <form method="POST">
<h2>Cadastrar Evento</h2>
<br>
<br>
<input type="text" name="nome" placeholder="Nome do evento" required>

<input type="text" name="descricao" placeholder="Descrição" required>

<input type="date" name="data_evento" required>

<input type="time" name="horario" required>

<input type="text" name="local_evento" placeholder="Local" required>

<input type="number" name="max_participantes" placeholder="Máx participantes" required>

<button type="submit">Cadastrar Evento</button>

<a href="../view/admin.php">Voltar</a>
</form>

</body>
</html>
<?php


require_once "../Controller/EventosController.php";

$EventosController = new EventosController($pdo);


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $data_evento = $_POST['data_evento'];
    $horario = $_POST['horario'];
    $local_evento = $_POST['local_evento'];
    $max_participantes = $_POST['max_participantes'];

    $resultado = $EventosController->cadastrarevento($nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes);

    if($resultado !== "ERRO"){
        echo "<script>alert('Evento cadastrado com sucesso!');</script>";
        header("Location: ../view/admin.php");
        exit;
    } else {
        echo "<script>alert('Erro ao cadastrar evento. Tente novamente.');</script>";
    }
}
?>
