<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";

    $filtro = $_POST['filtro'] ?? "" ;
        
    require_once '../src/conexao.php';

    # solicita a conexão com o banco de dados e guarda na váriavel dbh.
    $dbh = Conexao::getConexao();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="../assets/css/boot.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/list_format.css">
    

    <title>Usuários</title>
</head>

<body>
<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>
    <div class="list_container">
        <h1>Usuários</h1>

        <article class="wrap_filtros">  
            <div class="filtros">
                <form method="POST">
                    <label>Selecione o tipo de usuario: </label>&nbsp;
                    <input type="radio" name="filtro" value="COMUM" <?php if($filtro == 'COMUM' || $filtro == "") echo "checked"; ?>>&nbsp;Comum&nbsp;
                    <input type="radio" name="filtro" value="ALUNO" <?php if($filtro == 'ALUNO') echo "checked"; ?> >&nbsp;Aluno &nbsp;
                    <input type="radio" name="filtro" value="PERSONAL-TRAINER" <?php if($filtro == 'PERSONAL-TRAINER') echo "checked"; ?>>&nbsp;Personal&nbsp;
                    <input type="submit" name="Enviar" class="bt_yellow" value="Filtrar"> 
                </form>
            </div>
        </article>

<?php

    switch($filtro){
        case 'ALUNO':
            $query = "SELECT * FROM olimpo.usuarios
                        WHERE id IN(SELECT id FROM perfis 
                        WHERE nome = 'ALUNO');";
            $stmt = $dbh->query($query); 

            $quantidadeRegistros = $stmt->rowCount();
            ?>
            <table width="1150px">
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>Saldo solici.</th>
                        <th>Sexo</th>
                        <th>Foto</th>
                        <th>Ação</th>
                    </tr>
            <?php
            if($quantidadeRegistros == 0){ ?>
                    <tr>
                        <td colspan="10">Não existem usuários cadastrados.</td>
                    </tr>
            <?php
            }else{
                while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                ?>
                        <tr>
                                <td><?=$row['id']?></td>
                                <td><a class="linkagem" href="perfil.php?idPerfil=<?=$row['id']?>"><?=$row['nome']?></a></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['CPF']?></td>
                                <td><?=$row['saldo_solici']?></td>
                                <td><?=$row['sexo']?></td>
                                <td><?=$row['foto']?></td>
                                <td>
                                    <a class="btnalterar" href="../usuarioAluno/update.php?id=<?=$row['id']?>">Editar</a>&nbsp;
                                    <a class="btnexcluir" href="../usuarioAluno/delete.php?id=<?=$row['id']?>" onclick=" return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                                </td>
                        </tr>
                <?php
                };
            };
            break;


        case 'PERSONAL-TRAINER':
            $query =  "SELECT * FROM olimpo.usuarios
            WHERE id IN(SELECT id FROM perfis 
                        WHERE nome = 'PERSONAL-TRAINER');";
            $stmt = $dbh->query($query);

            $quantidadeRegistros = $stmt->rowCount();



            ?>
            <table width="1150px">
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>CPF</th>
                        <th>CREF</th>
                        <th>Sexo</th>
                        <th>Foto</th>
                        <th>Ação</th>
                    </tr>
            <?php
            if($quantidadeRegistros == 0){ ?>
                    <tr>
                        <td colspan="10">Não existem usuários cadastrados.</td>
                    </tr>
            <?php
            }else{
                while($row = $stmt->fetch(PDO::FETCH_BOTH)){

                    //conexão com a tabela dos CREFS
                    $dbhCREFS = Conexao::getConexao();

                    $queryCREFS = "SELECT * FROM olimpo.crefs WHERE idUsuarios = :idUsuarios;"; 

                    $idUser = $row['id'];

                    $stmtCREFS = $dbhCREFS->prepare($queryCREFS);
                    $stmtCREFS->bindParam(":idUsuarios", $row['id']);
                    $stmtCREFS->execute();
                    $CREF = $stmtCREFS->fetch();

                    // echo "<pre>";
                    // var_dump($CREF);
                    // echo "</pre>";
                ?>
                        <tr>
                                <td><?=$row['id']?></td>
                                <td><a class="linkagem" href="perfil.php?idPerfil=<?=$row['id']?>"><?=$row['nome']?></a></td>
                                <td><?=$row['email']?></td>
                                <td><?=$row['CPF']?></td>
                                <td><?php
                                echo "CREF ".$CREF['numero']."-".substr($CREF['natureza'], 0, 1)."/".$CREF['UF_registro'];
                                ?></td>
                                <td><?=$row['sexo']?></td>
                                <td><?=$row['foto']?></td>
                                <td>
                                    <a class="btnalterar" href="../usuarioPersonal/update.php?id=<?=$row['id']?>">Editar</a>&nbsp;
                                    <a class="btnexcluir" href="../usuarioPersonal/delete.php?id=<?=$row['id']?>&foto=<?=$row['foto']?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                                </td>
                        </tr>

                <?php
                };
            };
            break;

        default:
            $query = "SELECT * FROM olimpo.usuarios
            WHERE id IN(SELECT id FROM perfis 
                        WHERE nome = 'COMUM');";
            $stmt = $dbh->query($query);           

            $quantidadeRegistros = $stmt->rowCount();
            ?>
            <table width="1150px">
                    <tr>
                        <th>id</th>
                        <th>Nome</th>
                        <th>Email</th>
                        <th>Sexo</th>
                        <th>Foto</th>
                        <th>Ação</th>
                    </tr>
            <?php
            if($quantidadeRegistros == 0){ ?>
                        <tr>
                            <td colspan="10">Não existem usuários cadastrados.</td>
                        </tr>
            <?php
            }else{
                while($row = $stmt->fetch(PDO::FETCH_BOTH)){
                ?>
                    <tr>
                            <td><?=$row['id']?></td>
                            <td><a class="linkagem" href="perfil.php?idPerfil=<?=$row['id']?>"><?=$row['nome']?></a></td>
                            <td><?=$row['email']?></td>
                            <td><?=$row['sexo']?></td>
                            <td><?=$row['foto']?></td>
                            <td>
                                <a class="btnalterar" href="../usuarioComum/update.php?id=<?=$row['id']?>">Editar</a>&nbsp;
                                <a class="btnexcluir" href="../usuarioComum/delete.php?id=<?=$row['id']?>&foto=<?=$row['foto']?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</a>
                            </td>
                    </tr>
                <?php
                };
            };
            break;
    };

?>
    </div> 

</body>
<style>
 
</style>
</html>
