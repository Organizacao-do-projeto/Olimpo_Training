<?php
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
    

    <title>Usuários</title>
</head>

<body>
    <!--DOBRA CABEÇALHO-->

    <header class="main_header">
        <div class="main_header_content">
            <a href="../../../index.php" class="logo">
                <img src="../assets/img/logo_borda.png" alt="Logo Olimpo"
                    title="Logo Olimpo" a href="../index.html"></a>
                  

            <nav class="main_header_content_menu">
                <ul>
                    <li><a href="../../../index.php">Voltar</a></li>
                </ul>
            </nav>
        </div>
    </header>

        <hr>

        <section>
            <table >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th>CPF</th>
                        <th>Ação</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if ($quantidadeRegistros == "0"): ?>
                        <tr>
                            <td colspan="4">Não existem usuários cadastrados.</td>
                        </tr>
                    <?php else: ?>
                        <?php while($row = $stmt->fetch(PDO::FETCH_BOTH)): ?>
                        <tr>
                            
                            <td><?php echo $row['id'];?></td>
                            <td><?= $row['nome'];?></td>
                            <td><?= $row['email'];?></td>
                            <td><?= $row['CPF'];?></td>
                            
                            
                            <td class="td__operacao">
                                <a class="btnalterar" href="update.php?id=<?=$row['id'];?>">Alterar</a>
                                <a class="btnexcluir" href="delete.php?id=<?=$row['id'];?>" onclick="return confirm('Deseja confirmar a operação?');">Excluir</a>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    <?php endif; $dbh = null; ?>
                </tbody>
            </table>
        </section>
    </main>
</body>
</html>