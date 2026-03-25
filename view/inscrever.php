<?php
session_start();
require_once "../db/database.php";
require_once "../controller/inscricaocontroller.php";

$controller = new InscricaoController($pdo);
$controller->inscrever();
?>

