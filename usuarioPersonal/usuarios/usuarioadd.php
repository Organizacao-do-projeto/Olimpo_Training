<?php
    header('Content-Type: text/html; charset=utf-8;');
    
    require_once '../src/conexao.php';

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);
    $sexo = $_POST['sexo'];
    $descricao = $_POST['descricao'];
    $numero_CREFS = $_POST['numero'];
    $natureza = $_POST['natureza'];
    $UF_registro = $_POST['UF_registro'];
    $fotoAtributos = $_FILES['seila'];
    $CPF = $_POST['cpf'];

    $idPerso_trainer = 1;


    var_dump($_POST['nome'],
    $_POST['email'],
    md5($_POST['password']),
    $_POST['sexo'],
    $_POST['descricao'],
    $_POST['numero'],
    $_POST['natureza'],
    $_POST['UF_registro'],
    $_FILES['foto'],
    $_POST['cpf']
);
        
        $foto = $fotoAtributos['name'];
        $caminhoFoto = "../assets/img/usuarios/".$foto;
        $extensaoArquivo = pathinfo($fotoAtributos['name'], PATHINFO_EXTENSION);
        $tamanhoPermitido = 150000000;


                


            if($fotoAtributos['size'] < $tamanhoPermitido){
                move_uploaded_file($fotoAtributos['tmp_name'], $caminhoFoto);
            }



    $dbh = Conexao::getConexao();

    $query = "INSERT INTO olimpo.usuarios (nome, email, password, sexo, cpf, descricao, foto, idPerso_trainer ) 
                VALUES (:nome, :email, :password, :sexo, :cpf, :descricao, :foto, :idPerso_trainer);"; 
    
    $stmt = $dbh->prepare($query);

    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':sexo', $sexo);
    $stmt->bindParam(':descricao', $descricao);
    $stmt->bindParam(':foto', $foto);
    $stmt->bindParam(':cpf', $CPF);
    $stmt->bindParam(':idPerso_trainer', $idPerso_trainer);
    $result = $stmt->execute();
    
    $ultimoID = $dbh->lastInsertId();


    $dbhPerfis = Conexao::getConexao();

    $queryPerfis = "INSERT INTO olimpo.perfis (id ,nome) VALUES (:id,'PERSONAL-TRAINER');";
    
    $stmtPerfis = $dbhPerfis->prepare($queryPerfis);
    $stmtPerfis->bindParam(":id",$ultimoID);
    $resultPerfis= $stmtPerfis->execute();

    $queryCREFS = "INSERT INTO olimpo.crefs (idUsuarios , numero, natureza, UF_registro, autenticado ) VALUES (:idUsuarios, :numero, :natureza, :UF_registro, 1 );";

    $dbhCREFS = Conexao::getConexao();

    $stmtCREFS = $dbhPerfis->prepare($queryCREFS);
    $stmtCREFS->bindParam(':idUsuarios', $ultimoID);
    $stmtCREFS->bindParam(':numero', $numero_CREFS);
    $stmtCREFS->bindParam(':natureza', $natureza);
    $stmtCREFS->bindParam(':UF_registro', $UF_registro);
    $result = $stmtCREFS->execute();

    var_dump($result);



    // if ($result AND $resultPerfis)
    // {
    //     header('location: index.php');
    //     exit;
    // } else {
    //     echo '<p>Não foi fossível inserir Usuário!</p>';
    //     $error = $dbh->errorInfo();
    //     print_r($error);
    // }
    // $dbh = null;
    // echo "<p><a href='index.php'>Voltar</a></p>";