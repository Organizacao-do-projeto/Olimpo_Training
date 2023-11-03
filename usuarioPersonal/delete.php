<?php
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
        header('location: ../index.php?msg=Conta excluída com sucesso.');
        exit;
    } else {
        echo "Não existe usuário cadastrado com id = $id";
    }
    $dbh = null;
    echo "<p><a href='index.php'>Voltar</a></p>";