<?php
session_start();
require_once "../db/database.php";

$usuario_id = $_SESSION['usuario_id'] ?? null;
$evento_id = $_GET['id'] ?? null;

if (!$usuario_id || !$evento_id) {
    die("Dados inválidos");
}

// Verifica se realmente está inscrito
$sql = "SELECT * FROM inscricoes WHERE id_usuario = ? AND id_evento = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id, $evento_id]);

if ($stmt->rowCount() === 0) {
    echo "Você não está inscrito nesse evento!";
    exit;
}

// Remove inscrição
$sql = "DELETE FROM inscricoes WHERE id_usuario = ? AND id_evento = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id, $evento_id]);

header("Location: index.php");
exit;