<?php

    session_start();

    include_once __DIR__.'/../auth/restrito.php';


    include_once '../src/conexao.php';

    $dbh = Conexao::getConexao();
    
    $id = $_GET['id'] ?? 0;
    $foto = $_GET['foto'] ?? 0;
    
    $query = "DELETE FROM olimpo.usuarios WHERE id = :id;";
    
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    
    $dbhPerfis = Conexao::getConexao();


    
    $queryPerfis = "DELETE FROM olimpo.perfis WHERE id = :id;";
    
    $stmtPerfis = $dbh->prepare($queryPerfis);
    $stmtPerfis->bindParam(':id', $id);
    $stmtPerfis->execute();



    $dbhCREFS = Conexao::getConexao();
    
    $queryCREFS = "DELETE FROM olimpo.crefs WHERE idUsuarios = :idUsuarios;";
    
    $stmtCREFS = $dbhCREFS->prepare($queryCREFS);
    $stmtCREFS->bindParam(':idUsuarios', $id);
    $stmtCREFS->execute();

    if(isset($_GET['foto'])){
        unlink('../assets/img/usuarios/'.$foto);
    }

    if ($stmt->rowCount() > 0)
    {
        if(isset($_GET['redirect'])){

        header('location: '.$_GET['redirect'].'?success=Usuario excluido com êxito!&filtro=PERSONAL-TRAINER');
        exit;
        }else{
        header('location: ../index.php?success=Conta excluída com sucesso.');
        exit;
        }
    } else {
        header("Location: ../index.php?error=Não existe usuário cadastrado com id = $id");
    }
    $dbh = null;
    echo "<p><a href='index.php'>Voltar</a></p>";