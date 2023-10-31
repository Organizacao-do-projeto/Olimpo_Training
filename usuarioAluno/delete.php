<?php
    include_once '../src/conexao.php';

    $dbh = Conexao::getConexao();

    # usando funcionalidade nova do PHP 8 chamada null coalescing operatior
    $id = $_GET['id'] ?? 0;

    # cria o comando DELETE filtrado pelo campo id e valor = $id
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