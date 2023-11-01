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
    $assinatura = $_POST['assinatura'];
    $pagamento = $_POST['pagamento'];
    $CPF = $_POST['CPF'];

    var_dump($pagamento);

    $assinatura == 'ANUAL' ? $saldo_solici = 7 : $saldo_solici = 3;
    

    $dbh = Conexao::getConexao();

    if($fotoAtributos['size'] > 0){
        //query de adiocinar com o foto
        $query = "INSERT INTO olimpo.usuarios ( nome , email , password ,  sexo , altura, peso , saldo_solici , objetivo , foto , CPF )
        VALUES( :nome , :email , :password , :sexo , :altura, :peso ,  :saldo_solici, :objetivo , :foto , :CPF); ";
        $addFoto = true;
    }else{
        //query de adicionar sem foto
        $query = "INSERT INTO olimpo.usuarios ( nome , email , password ,  sexo , altura, peso , saldo_solici, objetivo , CPF )
        VALUES( :nome , :email , :password , :sexo , :altura, :peso , :saldo_solici, :objetivo , :CPF); ";
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
    $stmt->bindParam(':saldo_solici', $saldo_solici);
    $stmt->bindParam(':objetivo', $objetivo);
    $stmt->bindParam(':foto', $fotoAtributos['name']);
    if($addFoto){
        $stmt->bindParam(':foto', $foto);
        move_uploaded_file($fotoAtributos['tmp_name'], $caminhoFoto);
    }
    $stmt->bindParam(':CPF', $CPF);
    
    $result= $stmt->execute();

    $ultimoID = $dbh->lastInsertId();


    // QUERY PERFIS
    $dbhPerfis = Conexao::getConexao();

    $queryPerfis = "INSERT INTO olimpo.perfis (id ,nome) VALUES (:id,'ALUNO');";
    
    $stmtPerfis = $dbhPerfis->prepare($queryPerfis);
    $stmtPerfis->bindParam(":id",$ultimoID);
    $resultPerfis= $stmtPerfis->execute();


    // QUERY ASSINATURAS
    $dbhAssinaturas = Conexao::getConexao();

    $queryAssinaturas = "INSERT INTO olimpo.assinaturas (tipo, idUsuarios) VALUES (:tipo,:idUsuarios);";
    
    $stmtAssinaturas = $dbhAssinaturas->prepare($queryAssinaturas);
    $stmtAssinaturas->bindParam(":tipo",$assinatura);
    $stmtAssinaturas->bindParam(":idUsuarios",$ultimoID);
    $resultAssinaturas = $stmtAssinaturas->execute();

    // QUERY ASSINATURAS
    $dbhPagamentos = Conexao::getConexao();

    $queryPagamentos = "INSERT INTO olimpo.pagamentos (tipo, idUsuarios) VALUES (:tipo,:idUsuarios);";
    
    $stmtPagamentos = $dbhPagamentos->prepare($queryPagamentos);
    $stmtPagamentos->bindParam(":tipo",$pagamento);
    $stmtPagamentos->bindParam(":idUsuarios",$ultimoID);
    $resultPagamentos = $stmtPagamentos->execute();

    if ($result AND $resultPerfis AND $resultAssinaturas AND $resultPagamentos)
    {
        header('location: index.php');
        exit;
    } else {
        echo '<p>Não foi fossível inserir Usuário!</p>';
        # método da classe conexao que informa o error ocorrido na execução da query.
        $error = $dbh->errorInfo();
        print_r($error);
    }
    $dbh = null;
    echo "<p><a href='index.php'>Voltar</a></p>";