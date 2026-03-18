<?php
require_once "../db/database.php";
require_once "../controller/UsuarioController.php";

$usuarioController = new UsuarioController($pdo);

$id = $_GET['id'] ?? null;

if(!$id){
    die("ID inválido");
}

$usuarioController->deletar($id);

header("Location: ../view/admin.php");
exit;