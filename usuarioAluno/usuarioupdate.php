<?php
    session_start();

    include_once __DIR__.'/../auth/restrito.php';

    header('Content-Type: text/html; charset=utf-8;');
    
    require_once '../src/conexao.php';

    $dadosUsuario = $_SESSION['dadosUsuario'];

    #verifica se é aluno
    echo isAluno($dadosUsuario['perfil']);

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
    $id = (int) $_POST['id'];
    $fotoAnterior = $_POST['fotoAnterior'];

    
    $assinatura == 'ANUAL' ? $saldo_treinos = 7 : $saldo_treinos = 3;

    $dbh = Conexao::getConexao();

    if($fotoAtributos['size'] > 0){
        //query de adiocinar com o foto
        $query = "UPDATE olimpo.usuarios SET nome = :nome, email = :email, password = :password, sexo = :sexo, altura = :altura, peso = :peso, saldo_treinos = :saldo_treinos, objetivo = :objetivo, foto = :foto, CPF = :CPF WHERE id = :id; ";
        $addFoto = true;
    }else{
        //query de adicionar sem foto
        $query = "UPDATE olimpo.usuarios SET nome = :nome, email = :email, password = :password, sexo = :sexo, altura = :altura, peso = :peso, saldo_treinos = :saldo_treinos, objetivo = :objetivo, CPF = :CPF WHERE id = :id; ";
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
    $stmt->bindParam(':saldo_treinos', $saldo_treinos);
    $stmt->bindParam(':objetivo', $objetivo);
    if($addFoto){
        $stmt->bindParam(':foto', $foto);
        unlink('../assets/img/usuarios/'.$fotoAnterior);
        move_uploaded_file($fotoAtributos['tmp_name'], $caminhoFoto);
    }
    $stmt->bindParam(':CPF', $CPF);
    $usuario = $stmt->execute();


    
    $dbhAssinaturas = Conexao::getConexao();

    $queryAssinaturas = "UPDATE olimpo.assinaturas SET tipo = :tipo WHERE idUsuarios = :idUsuarios; ";
    
    $stmtAssinaturas = $dbhAssinaturas->prepare($queryAssinaturas);
    $stmtAssinaturas->bindParam(":tipo", $assinatura);
    $stmtAssinaturas->bindParam(":idUsuarios", $id);
    $assinaturas = $stmtAssinaturas->execute();


    $dbhPagamentos = Conexao::getConexao();

    $queryPagamentos = "UPDATE olimpo.pagamentos SET tipo = :tipo WHERE idUsuarios = :idUsuarios; ";
    
    $stmtPagamentos = $dbhPagamentos->prepare($queryPagamentos);
    $stmtPagamentos->bindParam(":tipo", $pagamento);
    $stmtPagamentos->bindParam(":idUsuarios", $id);
    $pagamentos = $stmtPagamentos->execute();


    $dbh = null;
    $dbhAssinaturas = null;
    $dbhPagamentos = null;

    if ($usuario && $assinaturas && $pagamentos)
    {
        if(isset($_POST['redirect'])){

            header('location: '.$_POST['redirect'].'?success=Usuario editado com êxito!&filtro=ALUNO');

        }else{
            header('location: ../views/index.php?success=Conta atualizada com sucesso.&updated=true');
        }
    } else {
        header("location: index.php?error=Não foi possível atualizar o usuário com ID: $id");
    }