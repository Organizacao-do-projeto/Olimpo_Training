<?php
    header('Content-Type: text/html; charset=utf-8;');
    
    require_once '../src/conexao.php';

    # recebe os valores enviados do formulário via método post.
    $id = $_GET['id'];
    $autenticado = 1;

    # solicita a conexão com o banco de dados e guarda na váriavel dbh.
    $dbh = Conexao::getConexao();

    # cria uma instrução SQL para inserir dados na tabela usuarios.
    $query = "UPDATE olimpo.CREFs SET autenticado = :autenticado WHERE idUsuarios = :idUsuarios;";
    
    # prepara a execução da query e retorna para uma variável chamada stmt.
    $stmt = $dbh->prepare($query);

    # com a variável stmt, usada bindParam para associar a cada um dos parâmetro
    # e seu tipo (opcional).
    $stmt->bindParam(':autenticado', $autenticado);
    $stmt->bindParam(':idUsuarios', $id);
    
    # executa a instrução contida em stmt e se tudo der certo retorna uma valor maior que zero.
    $result= $stmt->execute();
    $dbh = null;
    if ($result)
    {
        header('location: index.php?msg=CREF autenticado com sucesso!');  
    } else {
        header('location: index.php?msg=Não foi possível autenticar o usuário com ID: {$id}');
    }
