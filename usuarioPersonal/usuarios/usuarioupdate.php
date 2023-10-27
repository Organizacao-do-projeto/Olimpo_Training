<?php
    header('Content-Type: text/html; charset=utf-8;');
    
    require_once '../src/conexao.php';

    $id = $_POST['id'];
    $email = $_POST['email'];
    $nome = $_POST['nome'];

    $dbh = Conexao::getConexao();

    $query = "UPDATE olimpo.usuarios SET email = :email, nome = :nome 
                WHERE id = :id;"; 
    
    $stmt = $dbh->prepare($query);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':id', $id);
    
    $result= $stmt->execute();
    $dbh = null;
    if ($result)
    {
        header('location: index.php');
    } else {
        header('location: index.php?msg=Não foi possível atualizar o usuário com ID: {$id}');
    }