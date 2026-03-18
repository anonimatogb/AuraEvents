<?php
class InscricoesModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarTodos(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM inscricoes');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscarinscricoes($id): array
    {
        $stmt = $this->pdo->query("SELECT * FROM inscricoes WHERE id = $id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

public function contarInscritos($id_evento)
{
    $sql = "SELECT COUNT(*) as total FROM inscricoes WHERE id_evento = ?";
    $stmt = $this->pdo->prepare($sql);
    $stmt->execute([$id_evento]);
    return $stmt->fetch()['total'];
}

 public function atualizar($id, $id_usuario, $id_evento)
    {
        $sql = "UPDATE inscricoes 
            SET id_usuario = :id_usuario,
                id_evento = :id_evento
            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':id_usuario' => $id_usuario,
            ':id_evento' => $id_evento
        ]);
    
    }
    public function deletar($id)
    {
        $sql = "DELETE FROM inscricoes WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $id
        ]);
    
        }




    }
