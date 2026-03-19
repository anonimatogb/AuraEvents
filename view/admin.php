<?php
session_start();


require_once "../controller/usuariocontroller.php";
require_once "../db/database.php";

if(!isset($_SESSION['cargo']) || $_SESSION['cargo'] !== "admin" ){
    header("Location: login.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    
    <style>/* RESET */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Segoe UI", Arial, sans-serif;
}

/* BODY */
body {
  background: #0f172a;
  color: #e2e8f0;
  min-height: 100vh;
  padding: 40px;
}

/* CONTAINER CENTRAL */
body::before {
  content: "";
  position: fixed;
  inset: 0;
  background: linear-gradient(120deg, #0f172a, #1e293b);
  z-index: -1;
}

/* TÍTULO */
h1 {
  font-size: 28px;
  margin-bottom: 20px;
  color: #38bdf8;
}

/* LINK (LOGOUT) */
a {
  display: inline-block;
  margin-bottom: 30px;
  padding: 10px 16px;
  background: #ef4444;
  color: white;
  text-decoration: none;
  border-radius: 6px;
  font-weight: bold;
  transition: 0.3s;
}

a:hover {
  background: #dc2626;
  transform: translateY(-2px);
}

/* CARD (PARA FUTURO CONTEÚDO) */
.container {
  background: #1e293b;
  padding: 25px;
  border-radius: 12px;
  box-shadow: 0 10px 25px rgba(0,0,0,0.3);
  margin-top: 20px;
}

/* TABELAS (CASO VOCÊ MOSTRE USUÁRIOS/EVENTOS) */
table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
  background: #0f172a;
  border-radius: 8px;
  overflow: hidden;
}

thead {
  background: #38bdf8;
  color: #0f172a;
}

th, td {
  padding: 12px;
  text-align: left;
}

tbody tr {
  border-bottom: 1px solid #334155;
  transition: 0.2s;
}

tbody tr:hover {
  background: #1e293b;
}

/* BOTÕES PADRÃO */
button {
  padding: 8px 12px;
  border: none;
  border-radius: 6px;
  background: #38bdf8;
  color: #0f172a;
  cursor: pointer;
  font-weight: bold;
  transition: 0.3s;
}

button:hover {
  background: #0ea5e9;
}

/* RESPONSIVO */
@media (max-width: 600px) {
  body {
    padding: 20px;
  }

  h1 {
    font-size: 22px;
  }

  a {
    width: 100%;
    text-align: center;
  }
}</style>
</head>
<body>
    <h1>Bem-vindo, <?php echo $_SESSION['usuario_nome']; ?>!</h1>
    <a href="logout.php">Sair</a>





</body>
</html>
<?php


require_once "../Controller/EventosController.php";

$EventosController = new EventosController($pdo);
$UsuarioController = new UsuarioController($pdo);

$usuarios = $UsuarioController->listar();
$eventos = $EventosController->listar();


?>
