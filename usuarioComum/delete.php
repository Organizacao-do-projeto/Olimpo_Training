<?php
    session_start();

    include_once __DIR__.'/../auth/restrito.php';

    include_once '../src/conexao.php';

    $dbh = Conexao::getConexao();

    # usando funcionalidade nova do PHP 8 chamada null coalescing operatior
    $id = $_GET['id'] ?? 0;
    $foto = $_GET['foto'] ?? 0;

    # cria o comando DELETE filtrado pelo campo id e valor = $id
    $query = "DELETE FROM olimpo.usuarios WHERE id = :id;";

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id);
    $result = $stmt->execute();

    // QUERY PERFIS
    $dbhPerfis = Conexao::getConexao();

    $queryPerfis = "DELETE FROM olimpo.perfis WHERE id = :id;";
    
    $stmtPerfis = $dbhPerfis->prepare($queryPerfis);
    $stmtPerfis->bindParam(":id",$id);
    $resultPerfis= $stmtPerfis->execute();


    if(isset($_GET['foto'])){
        unlink('../assets/img/usuarios/'.$foto);
    }

    if($stmt->rowCount() > 0 && $stmtPerfis->rowCount() > 0 )
    {
        if(isset($_GET['redirect'])){

            header('location: '.$_GET['redirect'].'?success=Usuario excluido com êxito!');
            exit;
            }else{
            header('location: ../index.php?success=Conta excluída com sucesso.');
            exit;
            }
    } else {
        header("Location: ../index.php?error=Não existe usuário cadastrado com id = $id");
    }

    $dbh = null;
    $dbhPerfis = null;
    echo "<p><a href='index.php'>Voltar</a></p>";