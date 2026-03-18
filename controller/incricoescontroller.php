<?php
require_once "../Model/InscricoesModel.php";

class InscricoesController
{
    private $InscricoesModel;

    public function __construct($pdo)
    {
        $this->InscricoesModel = new InscricoesModel($pdo);
    }


 public function listar()
    {
        $inscricoes = $this->InscricoesModel->buscarTodos();
        include_once "../listagem/listarinscricoes.php";
        return $inscricoes;
    }


    public function deletar($id)
    {
        $evento = $this->InscricoesModel->deletar($id);
        return $evento;
    }
        public function atualizar($id, $id_usuario, $id_evento){
    return $this->InscricoesModel->atualizar($id, $id_usuario, $id_evento);

}

public function contarInscritos($id_evento)
{
    return $this->InscricoesModel->contarInscritos($id_evento);
}
}