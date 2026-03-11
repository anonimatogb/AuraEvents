<?php
require_once "C:/Turma2/xampp/htdocs/auraevents/Model/UsuarioModel.php";

class UsuarioController {
    private $usuarioModel;

    public function __construct($pdo) {
        $this->usuarioModel = new UsuarioModel($pdo);
    }

    public function listar() {
        $usuarios = $this->usuarioModel->buscarTodos();
        include_once "C:/Turma1/xampp/htdocs/aula_18_09_2025/MVC/View/Usuario/listar.php";
        return $usuarios;
    }
     public function buscarUsuario($id) {
        $usuario = $this->usuarioModel->buscarUsuario($id);
        return $usuario;
    }
 
    public function cadastrar($nome,$email,$senha){
return $this-> usuarioModel->cadastrar($nome,$email,$senha);


    }
   public function editar($nome,$email,$senha,$id){
 $this-> usuarioModel->editar($nome,$email,$senha, $id);


    }

    

     public function deletar($id){
 $usuario = $this-> usuarioModel->deletar($id);
return $usuario;

    }
}
?>