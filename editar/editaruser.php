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
<head>
    <title>Editar Usuário</title>
</head>




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