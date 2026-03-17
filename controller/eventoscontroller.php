<?php
require_once "C:/xampp/htdocs/auraevents/Model/UsuarioModel.php";

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
        include_once "C:/Turma1/xampp/htdocs/aula_18_09_2025/MVC/View/Usuario/listar.php";
        return $usuarios;
    }
    public function buscarUsuario($id)
    {
        $usuario = $this->usuarioModel->buscarUsuario($id);
        return $usuario;
    }

    public function cadastrar($nome, $email, $senha, $cargo)
    {
      
        return $this->usuarioModel->cadastrar($nome, $email, $senha, $cargo);
    }
    public function editar($nome, $email, $senha, $id)
    {
        $this->usuarioModel->editar($nome, $email, $senha, $id);
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

            echo "Email ou senha inválidos";
        }
    }

    public function deletar($id)
    {
        $usuario = $this->usuarioModel->deletar($id);
        return $usuario;
    }
}
