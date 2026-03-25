<?php
require_once "../model/inscricaomodel.php";

class InscricaoController
{
    private $inscricaoModel;
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
        $this->inscricaoModel = new InscricaoModel($pdo);
    }

    public function inscrever()
    {
        session_start();
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $evento_id = $_GET['id'] ?? null;

        if (!$usuario_id || !$evento_id) {
            $_SESSION['error'] = "Usuário ou evento inválido.";
            header("Location: ../view/index.php");
            exit;
        }

        if ($this->inscricaoModel->cadastrarInscricao($usuario_id, $evento_id)) {
            $_SESSION['success'] = "Inscrição realizada com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao se inscrever ou já está inscrito neste evento.";
        }
        
        header("Location: ../view/index.php");
        exit;
    }

    public function desinscrever()
    {
        session_start();
        $usuario_id = $_SESSION['usuario_id'] ?? null;
        $evento_id = $_GET['id'] ?? null;

        if (!$usuario_id || !$evento_id) {
            $_SESSION['error'] = "Usuário ou evento inválido.";
            header("Location: ../view/index.php");
            exit;
        }

        if ($this->inscricaoModel->desinscreverInscricao($usuario_id, $evento_id)) {
            $_SESSION['success'] = "Desinscrição realizada com sucesso!";
        } else {
            $_SESSION['error'] = "Erro ao cancelar inscrição ou não estava inscrito.";
        }
        
        header("Location: ../view/index.php");
        exit;
    }

    public function listar()
    {
        return $this->inscricaoModel->listarComNomes();
    }
}
?>

