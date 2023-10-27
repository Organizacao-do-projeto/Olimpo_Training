<?php
    include_once '../src/conexao.php';

    $dbh = Conexao::getConexao();

    $id = $_GET['id'] ?? 0;

    $query = "DELETE FROM olimpo.usuarios WHERE id = :id;";

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    if ($stmt->rowCount() > 0)
    {
        header('location: index.php');
        exit;
    } else {
        echo "Não existe usuário cadastrado com id = $id";
    }
    $dbh = null;
    echo "<p><a href='index.php'>Voltar</a></p>";