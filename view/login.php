<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
     <link rel="stylesheet" href="../style.css">
     <style>    
     a{
margin-left:18vh;
}
        </style>
</head>
<body>
    <form method="post">

         <label for="email">Email:</label>
        <input type="email" name="email" required><br>

         <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <input type="submit">

        <a href="cadastro.php">Cadastrar-se</a>
    </form>
</body>
</html>

<?php
require_once "../controller/usuariocontroller.php";
require_once "../db/database.php";

$UsuarioController = new UsuarioController($pdo);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $UsuarioController->login($email, $senha);
}
?>