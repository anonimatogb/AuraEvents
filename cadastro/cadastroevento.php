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
<style>

    form input {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    outline: none;
    transition: 0.3s;
    font-size: 14px;
}

/* Efeito ao focar */
form input:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0,123,255,0.3);
}

/* Botão */
form button {
    width: 100%;
    padding: 12px;
    margin-top: 10px;
    background: #007bff;
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 16px;
    cursor: pointer;
    transition: 0.3s;
}

/* Hover botão */
form button:hover {
    background: #0056b3;
}

/* Link */
form a {
    display: block;
    margin-top: 15px;
    color: #007bff;
    text-decoration: none;
}

form a:hover {
    text-decoration: underline;
}
h2{
-webkit-text-fill-color: black;}
</style>

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
