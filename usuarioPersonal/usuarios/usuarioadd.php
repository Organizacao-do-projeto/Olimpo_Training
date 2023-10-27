<?php
    header('Content-Type: text/html; charset=utf-8;');
    
    require_once '../src/conexao.php';

    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $nome = $_POST['nome'];
    $status = 1;

    $dbh = Conexao::getConexao();

    $query = "INSERT INTO olimpo.usuarios (email, password, nome) 
                VALUES (:email, :password, :nome);"; 
    
    $stmt = $dbh->prepare($query);

    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':nome', $nome);
    $result = $stmt->execute();
    
    $ultimoID = $dbh->lastInsertId();


    $dbhPerfis = Conexao::getConexao();

    $queryPerfis = "INSERT INTO olimpo.perfis (id ,nome) VALUES (:id,'PERSONAL-TRAINER');";
    
    $stmtPerfis = $dbhPerfis->prepare($queryPerfis);
    $stmtPerfis->bindParam(":id",$ultimoID);
    $resultPerfis= $stmtPerfis->execute();

    var_dump($ultimoID);

    if ($result AND $resultPerfis)
    {
        header('location: index.php');
        exit;
    } else {
        echo '<p>Não foi fossível inserir Usuário!</p>';
        $error = $dbh->errorInfo();
        print_r($error);
    }
    $dbh = null;
    echo "<p><a href='index.php'>Voltar</a></p>";