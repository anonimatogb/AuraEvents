<?php
class UsuarioModel
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function buscarTodos(): array
    {
        $stmt = $this->pdo->query('SELECT * FROM usuarios');
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function buscarUsuario($id): array
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios WHERE id = $id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function cadastrar($nome, $descricao, $data_evento,$horario,$local_evento,$max_participantes)
    {
        try {

            $sql = "INSERT INTO usuarios (nome, descricao, data_evento, horario, local_evento, max_participantes) VALUES (:nome, :descricao, :data_evento, :horario, :local_evento, :max_participantes)";
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
                return "duplicado";
            }
            throw $e;
        }
    }


    public function editar($nome, $email, $senha, $id)
    {
        $sql = "UPDATE usuarios SET nome=?, email=?, senha=? WHERE id=?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$nome, $email, $senha, $id]);
    }



    public function deletar($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $id
        ]);
    }
}
