<?php

    require_once '../src/conexao.php';

    # solicita a conexão com o banco de dados e guarda na váriavel dbh.
    $dbh = Conexao::getConexao();
    $dbhUsuarios = Conexao::getConexao();
    
    // FUNCIONANDO
    $query = "SELECT * FROM olimpo.CREFs WHERE autenticado = 0;"; 
    
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Autenticar CREF - ADMIN </title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <header>
        <h1>Autenticar CREF - ADMIN </h1>
        <p>Exercício introdutório exemplificando o crud nas tabelas usuários e perfil. </p>
    </header>
    <nav>
        <a href="../../views/index.php">Home</a>
        <a href="#">Usuários</a>
    </nav>

    <main>
        <h1>Personal Trainers</h1>

        <section class="section__btn">
            <a class="btn" href="https://www.confef.org.br/confef/" target="_blank">Buscar</a>
        </section>
        
        <hr>

        <section>
            <table >
                <thead>
                <tr>
                    <th colspan="4" id="thCREF">Dados do CREF</th>
                    <th colspan="3" ></th>
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

                            // $idUsuario = intval($row['idUsuarios']);
                            // print_r($idUsuario);

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
                                <a class="btnexcluir" href="deleteCREF.php?id=<?=$usuario['id'];?>" onclick="return confirm('Deseja confirmar a operação?');">Rejeitar</a>
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