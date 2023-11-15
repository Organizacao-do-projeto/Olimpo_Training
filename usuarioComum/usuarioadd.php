<?php
    header('Content-Type: text/html; charset=utf-8;');
    
    require_once '../src/conexao.php';

    # recebe os valores enviados do formulário via método post.
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sexo = $_POST['sexo'];
    $altura = $_POST['altura'];
    $peso = $_POST['peso'];
    $objetivo = $_POST['objetivo'];
    $fotoAtributos = $_FILES['foto'];



    $dbh = Conexao::getConexao();

    if($fotoAtributos['size'] > 0){
        //query de adiocinar com o foto
        $query = "INSERT INTO olimpo.usuarios ( nome , email , password ,  sexo , altura, peso , objetivo , foto, idPerfis )
        VALUES( :nome , :email , :password , :sexo , :altura, :peso , :objetivo , :foto, 2 ); ";
        $addFoto = true;
    }else{
        //query de adicionar sem foto
        $query = "INSERT INTO olimpo.usuarios ( nome , email , password ,  sexo , altura, peso , objetivo, idPerfis )
        VALUES( :nome , :email , :password , :sexo , :altura, :peso , :objetivo , 2); ";
        $addFoto = false;
    }

    $foto = $fotoAtributos['name'];
    $caminhoFoto = "../assets/img/usuarios/".$foto;
    $extensaoArquivo = pathinfo($fotoAtributos['name'], PATHINFO_EXTENSION);
    $tamanhoPermitido = 150000000;  
    
    $stmt = $dbh->prepare($query);   

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':altura', $altura);
    $stmt->bindParam(':peso', $peso);
    $stmt->bindParam(':objetivo', $objetivo);
    $stmt->bindParam(':foto', $fotoAtributos['name']);
    if($addFoto){
        $stmt->bindParam(':foto', $foto);
        move_uploaded_file($fotoAtributos['tmp_name'], $caminhoFoto);
    }

    
    $result= $stmt->execute();

    $ultimoID = $dbh->lastInsertId();


    // QUERY PERFIS
    $dbhPerfis = Conexao::getConexao();

    $queryPerfis = "INSERT INTO olimpo.perfis (id ,nome) VALUES (:id,'COMUM');";
    
    $stmtPerfis = $dbhPerfis->prepare($queryPerfis);
    $stmtPerfis->bindParam(":id",$ultimoID);
    $resultPerfis= $stmtPerfis->execute();


    if ($result AND $resultPerfis)
    {
        header('location: ../index.php?success=Cadastro realizado com sucesso.');
        exit;
    } else {
        echo '<p>Não foi fossível inserir Usuário!</p>';
        # método da classe conexao que informa o error ocorrido na execução da query.
        $error = $dbh->errorInfo();
        print_r($error);
    }
    $dbh = null;
    echo "<p><a href='index.php'>Voltar</a></p>";