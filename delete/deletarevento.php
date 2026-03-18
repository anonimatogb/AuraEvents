<?php
require_once "../db/database.php";
require_once "../controller/EventosController.php";

$eventosController = new EventosController($pdo);

$id = $_GET['id'] ?? null;

if(!$id){
    die("ID inválido");
}

$eventosController->deletar($id);

header("Location: ../view/admin.php");
exit;