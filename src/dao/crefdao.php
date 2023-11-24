<?php

require_once __DIR__ . '/../databases/conexao.php';

class CREF 
{

    private $dbh;

    public function __construct()
    {
        $this->dbh =  Conexao::getConexao();
    }

    public function getAuthCREF(int $id){

        $query = "SELECT * FROM olimpo.crefs WHERE idUsuarios = :idUsuarios AND autenticado = 1 ";

        $stmt = $this->dbh->prepare($query);
        $stmt->bindParam('idUsuarios', $id);
        $stmt->execute();
        $result = $stmt->fetch();
        $qnt = $stmt->rowCount();

        return $qnt;

    }
}