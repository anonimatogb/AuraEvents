<?php
session_start();
require_once "../db/database.php";

$usuario_id = $_SESSION['usuario_id'] ?? null;
$evento_id = $_GET['id'] ?? null;

if (!$usuario_id || !$evento_id) {
    die("Dados inválidos");
}

// Verifica se já está inscrito
$sql = "SELECT * FROM inscricoes WHERE id_usuario = ? AND id_evento = ?";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id, $evento_id]);

if ($stmt->rowCount() > 0) {
    echo "Você já está inscrito nesse evento!";
    exit;
}

// Insere inscrição
$sql = "INSERT INTO inscricoes (id_usuario, id_evento) VALUES (?, ?)";
$stmt = $pdo->prepare($sql);
$stmt->execute([$usuario_id, $evento_id]);

header("Location: index.php");
exit;