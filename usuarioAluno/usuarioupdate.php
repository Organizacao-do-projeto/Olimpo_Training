<?php
    header('Content-Type: text/html; charset=utf-8;');
    
    require_once '../src/conexao.php';

    # recebe os valores enviados do formulário via método post.
    $id = $_POST['id'];
    $email = $_POST['email'];
    $CPF = $_POST['CPF'];
    $nome = $_POST['nome'];

    # solicita a conexão com o banco de dados e guarda na váriavel dbh.
    $dbh = Conexao::getConexao();

    # cria uma instrução SQL para inserir dados na tabela usuarios.
    $query = "UPDATE olimpo.usuarios SET email = :email, CPF = :CPF, nome = :nome 
                WHERE id = :id;"; 
    
    # prepara a execução da query e retorna para uma variável chamada stmt.
    $stmt = $dbh->prepare($query);

    # com a variável stmt, usada bindParam para associar a cada um dos parâmetro
    # e seu tipo (opcional).
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':CPF', $CPF);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':id', $id);
    
    # executa a instrução contida em stmt e se tudo der certo retorna uma valor maior que zero.
    $result = $stmt->execute(); 
    $dbh = null;
    if ($result)
    {
        header('location: index.php');
    } else {
        header('location: index.php?msg=Não foi possível atualizar o usuário com ID: {$id}');
    }