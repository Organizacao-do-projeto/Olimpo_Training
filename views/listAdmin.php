<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";

    require_once '../src/conexao.php';

    # solicita a conexão com o banco de dados e guarda na váriavel dbh.
    $dbh = Conexao::getConexao();

    # cria uma instrução SQL para selecionar todos os dados na tabela usuarios.
    $query = "SELECT * FROM olimpo.usuarios;"; 

    # prepara a execução da query e retorna para uma variável chamada stmt.
    $stmt = $dbh->query($query);

    # devolve a quantidade de linhas retornada pela consulta a tabela.
    $quantidadeRegistros = $stmt->rowCount();

    # busca todos os dados da tabela usuário.
    // $usuarios = $stmt->fetchAll();
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

    <div class="list_container">
        <h1>Listagem de usuários</h1>

        <form method="POST">
            <label>Selecione o usuario: </label>
            <input type="radio" name="filtro" value="comum">Comum
            <input type="radio" name="filtro" value="aluno">Aluno 
            <input type="radio" name="filtro" value="personal">Personal
            <input type="submit" name="Enviar" value="Filtrar"> 
        </form>

              <table width="1150px">
                <tr>

                    <th>id</th>
                    <th>Nome</th>
                    <th>Tipo</th>
                    <th>Email</th>
                    <th>CPF</th>
                    <th>Saldo solici.</th>
                    <th>Foto</th>
                    <th>CREF</th>
                    <th>Autenticado</th>
                    <th>Ação</th>
                </tr>
                <?php if ($quantidadeRegistros == "0"): ?>
                                <tr>
                            <td colspan="4">Não existem usuários cadastrados.</td>
                        </tr>
                <?php else: ?>
                <?php while($row = $stmt->fetch(PDO::FETCH_BOTH)): 
                        
                        $dbhPerfis = Conexao::getConexao();

                        $queryPerfis = "SELECT nome FROM olimpo.perfis WHERE id = :id;"; 


                        $stmtPerfis = $dbhPerfis->prepare($queryPerfis);
                        $stmtPerfis->bindParam(":id", $row['id']);
                        $stmtPerfis->execute();
                        $perfis = $stmtPerfis->fetch();


                        $tipoUsr = $perfis['nome'];

                        if($tipoUsr == 'PERSONAL-TRAINER'){
                                $dbhCREFS = Conexao::getConexao();

                                $queryCREFS = "SELECT * FROM olimpo.crefs WHERE idUsuarios = :idUsuarios;"; 

                                $idUser = $row['id'];

                                $stmtCREFS = $dbhCREFS->prepare($queryCREFS);
                                $stmtCREFS->bindParam(":idUsuarios", $idUser);
                                $stmtCREFS->execute();
                                $CREF = $stmtCREFS->fetch();

                                $personal = true;
        
                        }

                ?>
                <tr>
                    <td><?=$row['id']?></td>
                    <td><?=$row['nome']?></td>
                    <td><?=$perfis['nome']?></td>
                    <td><?=$row['email']?></td>
                    <td><?=$row['CPF']?></td>
                    <td><?=$row['saldo_solici']?></td>
                    <td><?=$row['foto']?></td>
                    <td><?php if($tipoUsr == 'PERSONAL-TRAINER'){
                        echo "CREF ".$CREF['numero']."-".substr($CREF['natureza'], 0, 1)."/".$CREF['UF_registro'];
                    }?></td>
                    <td><?php if($tipoUsr == 'PERSONAL-TRAINER'){
                        echo $CREF['autenticado'];
                    }?></td>
                    <td>
                        <?php if($tipoUsr == 'PERSONAL-TRAINER'): ?>
                        <a class="btn" href="../usuarioPersonal/update.php?id=<?=$row['id']?>">Editar</a>&nbsp;
                        <a class="btn" href="../usuarioPersonal/delete.php?id=<?=$row['id']?>&foto=<?=$row['foto']?>">Excluir</a>
                        <?php endif;  

                        if($tipoUsr == 'ALUNO'): ?>
                        <a class="btn" href="../usuarioAluno/update.php?id=<?=$row['id']?>">Editar</a>&nbsp;
                        <a class="btn" href="../usuarioAluno/delete.php?id=<?=$row['id']?>&foto=<?=$row['foto']?>">Excluir</a>
                        <?php endif;

                        if($tipoUsr == 'COMUM'): ?>
                        <a class="btn" href="../usuarioComum/CRUD_mensalidades/CRUD/usuarios/update.php?id=<?=$row['id']?>">Editar</a>&nbsp;
                        <a class="btn" href="../usuarioComum/CRUD_mensalidades/CRUD/usuarios/delete.php?id=<?=$row['id']?>&foto=<?=$row['foto']?>">Excluir</a>
                        <?php endif; ?>
                    </td>
                </tr>  

                <?php endwhile; ?>
                <?php endif; $dbh = null; 
                
                ?>
              </table>
    </div>

</body>
<style>
        
</style>
</html>
