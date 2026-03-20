<?php
session_start();

require_once "../db/database.php";
require_once "../controller/EventosController.php";
require_once "../controller/usuariocontroller.php";


if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== "admin" ){
    header("Location: login.php");
    exit();
}

$eventosController = new EventosController($pdo);


$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID inválido");
}

$evento = $eventosController->buscareventos($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $eventosController->atualizar(
        $id,
        $_POST['nome'],
        $_POST['descricao'],
        $_POST['data_evento'],
        $_POST['horario'],
        $_POST['local_evento'],
        $_POST['max_participantes']
    );

    header("Location: ../view/admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Evento</title>
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
    Nome: <input type="text" name="nome" value="<?= $evento['nome'] ?>"><br><br>
    Descrição: <input type="text" name="descricao" value="<?= $evento['descricao'] ?>"><br><br>
    Data do Evento: <input type="date" name="data_evento" value="<?= $evento['data_evento'] ?>"><br><br>
    Horário: <input type="time" name="horario" value="<?= $evento['horario'] ?>"><br><br>
    Local do Evento: <input type="text" name="local_evento" value="<?= $evento['local_evento'] ?>"><br><br>
    Máximo de Participantes: <input type="number" name="max_participantes" value="<?= $evento['max_participantes'] ?>"><br><br>

    <button type="submit">Atualizar</button>
    <a href="../view/admin.php" class="btn-voltar">Voltar</a>
</form>

</body>
</html>