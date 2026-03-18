<?php
class EventosModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarTodos(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM eventos');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscareventos($id): array
    {
        $stmt = $this->pdo->query("SELECT * FROM eventos WHERE id_evento = $id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrarevento($nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes)
    {
        try {

            $sql = "INSERT INTO eventos (nome, descricao, data_evento, horario, local_evento, max_participantes) VALUES (:nome, :descricao, :data_evento, :horario, :local_evento, :max_participantes)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':nome' => $nome,
                ':descricao' => $descricao,
                ':data_evento' => $data_evento,
                ':horario' => $horario,
                ':local_evento' => $local_evento,
                ':max_participantes' => $max_participantes

            ]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return "ERRO";
            }
            throw $e;
        }
    }





    public function deletar($id)
    {
        $sql = "DELETE FROM eventos WHERE id_evento = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $id
        ]);
    
        }


    public function atualizar($id, $nome, $descricao, $data_evento, $horario, $local_evento, $max_participantes)
    {
        $sql = "UPDATE eventos 
            SET nome = :nome,
                descricao = :descricao,
                data_evento = :data_evento,
                horario = :horario,
                local_evento = :local_evento,
                max_participantes = :max_participantes
               
            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':data_evento' => $data_evento,
            ':horario' => $horario,
            ':local_evento' => $local_evento,
            ':max_participantes' => $max_participantes,
        ]);
    }



    }
