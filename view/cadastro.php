<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="../style.css">
    <style>
    a{
margin-left:16vh;
}
        </style>
</head>
<body>
    <form method="post">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" required><br>

         <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="telefone">Telefone</label>
        <input type="tel" name="telefone" maxlength="15" required><br>

         <label for="senha">Senha:</label>
        <input type="password" name="senha" required><br>

        <input type="submit">

        <a href="login.php">Já tenho cadastro</a>
    </form>
</body>
</html>

<?php

require_once "../Controller/UsuarioController.php";
require_once "../DB/DataBase.php";

$UsuarioController = new UsuarioController($pdo);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $cargo = "cliente";
    
        
if($resultado = $UsuarioController -> cadastrar($nome,$email,$senha,$cargo,$telefone) === "duplicado")
    {            echo "<script>alert('Já existe um usuário com esse email ou telefone!');</script>";

            } else {
                
                $UsuarioController -> cadastrar($nome,$email,$senha,$cargo,$telefone);
        header("Location: login.php");
        exit;
    }
    
}

?>