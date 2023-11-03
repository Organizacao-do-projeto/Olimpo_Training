<?php
    header('Content-Type: text/html; charset=utf-8;');
    
    require_once '../src/conexao.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sexo = $_POST['sexo'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $objetivo = $_POST['objetivo'];
    $fotoAtributos = $_FILES['foto'];
    $id = $_POST['id'];
    $fotoAnterior = $_POST['fotoAnterior'];


    $dbh = Conexao::getConexao();

    if($fotoAtributos['size'] > 0){
        //query de adiocinar com o foto
        $query = "UPDATE olimpo.usuarios SET nome = :nome, email = :email, password = :password, sexo = :sexo, altura = :altura, peso = :peso,  objetivo = :objetivo, foto = :foto WHERE id = :id; ";
        $addFoto = true;
    }else{
        //query de adicionar sem foto
        $query = "UPDATE olimpo.usuarios SET nome = :nome, email = :email, password = :password, sexo = :sexo, altura = :altura, peso = :peso, objetivo = :objetivo WHERE id = :id; ";
        $addFoto = false;
    }

    $foto = $fotoAtributos['name'];
    $caminhoFoto = "../assets/img/usuarios/".$foto;
    $extensaoArquivo = pathinfo($fotoAtributos['name'], PATHINFO_EXTENSION);
    $tamanhoPermitido = 150000000;   
    
    $stmt = $dbh->prepare($query);   

    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':altura', $altura);
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':objetivo', $objetivo);
    if($addFoto){
        $stmt->bindParam(':foto', $foto);
        unlink('../assets/img/usuarios/'.$fotoAnterior);
        move_uploaded_file($fotoAtributos['tmp_name'], $caminhoFoto);
    }
    $usuario = $stmt->execute();


    $dbh = null;


    if ($usuario)
    {
        header('location: ../index.php?msg=Conta atualizada com sucesso.');
    } else {
        header('location: ../index.php?msg=Não foi possível atualizar o usuário com ID: {$id}');
    }