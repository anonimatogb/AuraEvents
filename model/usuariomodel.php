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
    public function atualizar($id, $nome, $email, $senha, $cargo, $telefone)
    {
        $sql = "UPDATE usuarios 
            SET nome = :nome,
                email = :email,
                senha = :senha,
                cargo = :cargo,
                telefone = :telefone
            WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            ':id' => $id,
            ':nome' => $nome,
            ':email' => $email,
            ':senha' => $senha,
            ':cargo' => $cargo,
            ':telefone' => $telefone,
        ]);
    }


    public function buscarUsuario($id): array
    {
        $stmt = $this->pdo->query("SELECT * FROM usuarios WHERE id = $id");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function login($email, $senha)
    {
        $sql = "SELECT * FROM usuarios WHERE email = ? AND senha = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$email, $senha]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function cadastrar($nome, $email, $senha, $cargo, $telefone)
    {
        try {

            $sql = "INSERT INTO usuarios (nome, email, senha, cargo, telefone) VALUES (:nome, :email, :senha, :cargo, :telefone)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':nome' => $nome,
                ':email' => $email,
                ':senha' => $senha,
                ':cargo' => $cargo,
                ':telefone' => $telefone,

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
