<?php
require_once "../Model/UsuarioModel.php";

class UsuarioController
{
    private $usuarioModel;

    public function __construct($pdo)
    {
        $this->usuarioModel = new UsuarioModel($pdo);
    }

    public function listar()
    {
        $usuarios = $this->usuarioModel->buscarTodos();
        include_once "../listagem/listaruser.php";
        return $usuarios;
    }
   
    public function buscarUsuario($id)
    {
        $usuario = $this->usuarioModel->buscarUsuario($id);
        return $usuario;
    }

    public function cadastrar($nome, $email, $senha, $cargo, $telefone)
    {
        return $this->usuarioModel->cadastrar($nome, $email, $senha, $cargo,$telefone);
    }
 

    public function login($email, $senha)
    {

        $usuario = $this->usuarioModel->login($email, $senha);

        if ($usuario) {

            session_start();
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['usuario_nome'] = $usuario['nome'];
            $_SESSION['cargo'] = $usuario['cargo'];


            if ($usuario['cargo'] == 'admin') {

                header('Location: admin.php');
                exit();

            } else {

                header("Location: index.php");
                exit;
            }

        } else {

            echo "<script>alert('Erro: Senha ou email errado!');</script>";
        }
    }

    public function deletar($id)
    {
        $usuario = $this->usuarioModel->deletar($id);
        return $usuario;
    }

    public function atualizar($id, $nome, $email, $senha, $cargo, $telefone){
    return $this->usuarioModel->atualizar($id, $nome, $email, $senha, $cargo, $telefone);
}
}
