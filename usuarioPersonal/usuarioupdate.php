<?php

    session_start();

    include_once __DIR__.'/../auth/restrito.php';

    header('Content-Type: text/html; charset=utf-8;');
    
    include_once __DIR__.'/../src/conexao.php';
    include_once __DIR__.'/../src/dao/crefdao.php';

    $dadosUsuario = $_SESSION['dadosUsuario'];

    $autenticado = new CREF();

    //verifica se o usuário não é personal autenticado
    if(!isPersonal($dadosUsuario['perfil'], $autenticado->getAuthCREF($dadosUsuario['id']))){
        header('Location: ../index.php?error=Voce não tem permissão para Editar treinos.');
    }


    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sexo = $_POST['sexo'];
    $descricao = $_POST['descricao'];
    $numero_CREFS = $_POST['numero'];
    $CPF = $_POST['cpf'];
    $natureza = $_POST['natureza'];
    $UF_registro = $_POST['UF_registro'];
    $fotoAtributos = $_FILES['foto'];
    $id = $_POST['id'];
    $fotoAnterior = $_POST['fotoAnterior'];


    $dbh = Conexao::getConexao();

    if($fotoAtributos['size'] > 0){
        //query de adiocinar com o foto
        $query = "UPDATE olimpo.usuarios SET nome = :nome, email = :email, password = :password, sexo = :sexo, descricao = :descricao, CPF = :CPF, foto = :foto WHERE id = :id; ";
        $addFoto = true;
    }else{
        //query de adicionar sem foto
        $query = "UPDATE olimpo.usuarios SET nome = :nome, email = :email, password = :password, sexo = :sexo, descricao = :descricao, CPF = :CPF WHERE id = :id; ";
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
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':CPF', $CPF);
    if($addFoto){
        $stmt->bindParam(':foto', $foto);
        unlink('../assets/img/usuarios/'.$fotoAnterior);
        move_uploaded_file($fotoAtributos['tmp_name'], $caminhoFoto);
    }
    $usuario = $stmt->execute();

    
    $dbhCREFS = Conexao::getConexao();

    $queryCREFS = "UPDATE olimpo.crefs SET numero = :numero, natureza = :natureza, UF_registro = :UF_registro WHERE idUsuarios = :idUsuarios; ";
    
    $stmtCREFS = $dbhCREFS->prepare($queryCREFS);
    $stmtCREFS->bindParam(":numero", $numero_CREFS);
    $stmtCREFS->bindParam(":natureza", $natureza);
    $stmtCREFS->bindParam(":UF_registro", $UF_registro);
    $stmtCREFS->bindParam(":idUsuarios", $id);
    $CREF = $stmtCREFS->execute();


    $dbh = null;
    $dbhCREFS = null;

    if ($usuario && $CREF)
    {
        if(isset($_POST['redirect'])){

            header('location: '.$_POST['redirect'].'?success=Usuario editado com êxito!&filtro=PERSONAL-TRAINER');

        }else{
            header('location: ../views/index.php?success=Conta atualizada com sucesso.');
        }
    } else {
        header("location: index.php?error=Não foi possível atualizar o usuário com ID: $id");
    }