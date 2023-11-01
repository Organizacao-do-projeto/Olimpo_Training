<?php
require_once __DIR__ . '/../databases/conexao.php';

class UsuarioOl
{

    private $dbh;

    public function __construct()
    {
        $this->dbh =  Conexao::getConexao();
    }

    public function getAll()
    {
        $query = "SELECT * FROM olimpo.usuarios;";

        $stmt = $this->dbh->query($query);
        $rows = $stmt->fetchAll();
        $this->dbh = null;

        return $rows;
    }

    public function getById(int $id)
    {
        $query = "SELECT * FROM olimpo.usuarios WHERE id = :id;";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_BOTH);
        $this->dbh = null;

        return $row;
    }

    public function delete(int $id): int
    {
        $query = "DELETE FROM olimpo.usuarios WHERE id = :id;";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        $result = (int) $stmt->rowCount();
        $this->dbh = null;

        return $result;
    }

    public function new(string $nome, string $email, string $password, int $status, int $idPerfis): int
    {
        $query = "INSERT INTO olimpo.usuarios (nome, email, password, status, idPerfis) 
            VALUES (:nome, :email, :password, :status, :idPerfis);";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idPerfis', $idPerfis);

        $result = (int) $stmt->execute();
        $this->dbh = null;

        return $result;
    }

    public function update(int $id, string $nome, string $email, int $status, int $idPerfis): int
    {
        $query = "UPDATE olimpo.usuarios SET 
            nome = :nome,
            email = :email,
            `status` = :status,
            idPerfis = :idPerfis 
            WHERE id = :id;";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':idPerfis', $idPerfis);
        $stmt->bindParam(':id', $id);

        $result = $stmt->execute();
        $this->dbh = null;

        return $result;
    }

    public function login($email, $password)
    {
        try {
            $query = "SELECT * 
            FROM olimpo.usuarios 
            WHERE email = :email
            AND password = :password;";

            $stmt = $this->dbh->prepare($query);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $password);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_BOTH);
            $this->dbh = null;

            return $row;
        } catch (\PDOException $e) {
            return null;
        }
    }
}
