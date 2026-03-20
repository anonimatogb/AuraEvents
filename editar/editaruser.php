<?php
session_start();
require_once "../db/database.php";
require_once "../controller/UsuarioController.php";

if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== "admin" ){
    header("Location: login.php");
    exit();
}

$usuarioController = new UsuarioController($pdo);


$id = $_GET['id'] ?? null;

if (!$id) {
    die("ID inválido");
}

$usuario = $usuarioController->buscarusuario($id);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuarioController->atualizar(
        $id,
        $_POST['nome'],
        $_POST['email'],
        $_POST['senha'],
        $_POST['cargo'],
        $_POST['telefone']
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
    <title>Editar Usuário</title>
    <link rel="stylesheet" href="../style.css">
</head>
<style>
    form select {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #cbd5f5;
    border-radius: 6px;
    font-size: 14px;
    outline: none;
    transition: 0.3s;
    cursor: pointer;
}

/* Focus */
form select:focus {
    border-color: var(--cor-principal);
    box-shadow: 0 0 5px rgba(0,123,255,0.3);
}
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
    Nome: <input type="text" name="nome" value="<?= $usuario['nome'] ?>"><br><br>
    Email: <input type="email" name="email" value="<?= $usuario['email'] ?>"><br><br>
    Senha: <input type="text" name="senha" value="<?= $usuario['senha'] ?>"><br><br>
    

    <label for="selecao">Cargo:</label>

    <select name="cargo" required>
        <option value="" selected>Selecione</option>
        <option value="cliente">Cliente</option>
        <option value="admin">Admin</option>
    </select>
    <br><br>
    Telefone: <input type="text" name="telefone" value="<?= $usuario['telefone'] ?>"><br><br>

    <button type="submit">Atualizar</button>
    <a href="../view/admin.php" class="btn-voltar">Voltar</a>
</form>

</body>
</html>