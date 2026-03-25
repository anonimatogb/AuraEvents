<?php
class InscricaoModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarTodos()
    {
        $stmt = $this->pdo->query('SELECT * FROM inscricoes');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrarInscricao( $id_usuario,  $id_evento)
    {
        try {
            // Verifica se já está inscrito
            $sql = "SELECT * FROM inscricoes WHERE id_usuario = ? AND id_evento = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$id_usuario, $id_evento]);

            if ($stmt->rowCount() > 0) {
                return false; // Já inscrito
            }

            // Insere inscrição
            $sql = "INSERT INTO inscricoes (id_usuario, id_evento) VALUES (?, ?)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([$id_usuario, $id_evento]);
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                return false;
            }
            throw $e;
        }
    }

    public function desinscreverInscricao( $id_usuario,  $id_evento)
    {
        // Verifica se está inscrito
        $sql = "SELECT * FROM inscricoes WHERE id_usuario = ? AND id_evento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario, $id_evento]);

        if ($stmt->rowCount() === 0) {
            return false;
        }

        // Remove inscrição
        $sql = "DELETE FROM inscricoes WHERE id_usuario = ? AND id_evento = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id_usuario, $id_evento]);
    }

    public function isInscrito( $id_usuario,  $id_evento)
    {
        $sql = "SELECT 1 FROM inscricoes WHERE id_usuario = ? AND id_evento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_usuario, $id_evento]);
        return $stmt->rowCount() > 0;
    }

    public function getCountInscritos( $id_evento)
    {
        $sql = "SELECT COUNT(*) as total FROM inscricoes WHERE id_evento = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id_evento]);
        return $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    }

    public function listarComNomes()
    {
        $sql = "
            SELECT i.*, u.nome as usuario_nome, e.nome as evento_nome 
            FROM inscricoes i 
            JOIN usuarios u ON i.id_usuario = u.id 
            JOIN eventos e ON i.id_evento = e.id
            ORDER BY e.nome, u.nome
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

