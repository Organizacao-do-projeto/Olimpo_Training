<?php

    require_once '../src/conexao.php';

    $dbh = Conexao::getConexao();
    $dbhUsuarios = Conexao::getConexao();
    
    $query = "SELECT * FROM olimpo.CREFs WHERE autenticado = 0;"; 
    
    $stmt = $dbh->query($query);
    
    $quantidadeRegistros = $stmt->rowCount();
    
    # busca todos os dados da tabela usuário.
    // $usuarios = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Autenticar CREF | ADMIN </title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="../assets/css/boot.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/list_format.css">
</head>
<body>
    
<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
?>

<a href="../views/index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

    <main>
        <h1 class="titulo">Personal Trainers</h1>

        <section class="list_container">
        <article class="wrap_bt_buscar">
            <a class="bt_yellow bt_buscar" href="https://www.confef.org.br/confef/" target="_blank">Buscar</a>
        </article>

            <table width="1150px" >
                <thead>
                <tr>
                    <th colspan="4" id="thCREF">Dados do CREF</th>
                    <td colspan="4" id="back-white"></td>
                </tr>
                
                    <tr>
                        <th>#</th>
                        <th>Numero</th>
                        <th>Natureza</th>
                        <th>UF</th>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($quantidadeRegistros == "0"): ?>
                        <tr>
                            <td colspan="8">Não existem usuários pendentes de autenticação.</td>
                        </tr>
                        <?php else: ?>
                        <?php while($row = $stmt->fetch(PDO::FETCH_BOTH)):
                            
                            $queryUsuarios = "SELECT * FROM olimpo.usuarios WHERE id = :id;"; 

                            $stmtUsuarios = $dbhUsuarios->prepare($queryUsuarios);
                            $stmtUsuarios->bindParam(":id" , $row['idUsuarios']);
                            $stmtUsuarios->execute();
                            $usuario = $stmtUsuarios->fetch();
                            ?>
                        <tr>
                            <?php $autenticado =  $row['autenticado'] == "1" ? "AUTENTICADO" : "NÃO AUTENTICADO"; ?>
                            <td><?php echo $usuario['id'];?></td>   
                            <td><?=$row['numero'];?></td>
                            <td><?=$row['natureza'];?></td>
                            <td><?=$row['UF_registro'];?></td>
                            <td><?=$usuario['nome'];?></td>
                            <td><?=$usuario['CPF'];?></td>
                            <td><?=$usuario['email'];?></td>
                            <td class="td__operacao">
                                <a class="btnalterar" href="updateCREF.php?id=<?=$usuario['id'];?>">Autenticar</a>
                                <a class="btnexcluir" href="deleteCREF.php?id=<?=$usuario['id'];?>" onclick="return confirm('Deseja realmente rejeitar este usuário?');">Rejeitar</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php endif; $dbh = null; $dbhCREF = null; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>