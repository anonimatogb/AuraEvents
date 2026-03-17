<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
</head>
<body>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

         <label for="email">Email:</label>
        <input type="email" name="email" required><br>

         <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <input type="submit">
    </form>
</body>
</html>

<?php

require_once "C:/xampp/htdocs/AuraEvents/Controller/UsuarioController.php";
require_once "C:/xampp/htdocs/AuraEvents/DB/DataBase.php";

$UsuarioController = new UsuarioController($pdo);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cargo = "cliente";
    
        
if($resultado = $UsuarioController -> cadastrar($nome,$email,$senha,$cargo) === "duplicado")
    {            echo "<script>alert('Já existe um usuário com esse email!');</script>";

            } else {
                
                $UsuarioController -> cadastrar($nome,$email,$senha,$cargo);
        header("Location: login.php");
        exit;
    }
    
}

?>