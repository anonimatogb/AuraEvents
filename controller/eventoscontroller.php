<?php
require_once "../Model/EventosModel.php";

class EventosController
{
    private $EventosModel;
private $pdo;   
    public function __construct($pdo)
    {

    $this->EventosModel = new EventosModel($pdo);
    $this->pdo = $pdo;

    }

     public function buscareventos($id)
    {
        $eventos = $this->EventosModel->buscareventos($id);
        return $eventos;
    }
 public function listar()
    {
        $eventos = $this->EventosModel->buscarTodos();
        include_once "../listagem/listarevent.php";
        return $eventos;
    }
  public function alistar()
    {
        $eventos = $this->EventosModel->buscarTodos();
        $pdo = $this->pdo; // ✅ agora existe
        include_once __DIR__ . "/../listagem/nada.php";
        return $eventos;
    }
    public function cadastrarevento($nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes)
    {
        return $this->EventosModel->cadastrarevento($nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes);
    }
  


    public function deletar($id)
    {
        $evento = $this->EventosModel->deletar($id);
        return $evento;
    }
        public function atualizar($id, $nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes){
    return $this->EventosModel->atualizar($id, $nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes);
}
}