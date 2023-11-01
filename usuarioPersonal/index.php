<?php
    require_once '../src/conexao.php';

        $dbh = Conexao::getConexao();

        $query = "SELECT * FROM olimpo.usuarios;"; 

        $stmt = $dbh->query($query);

        $quantidadeRegistros = $stmt->rowCount();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD - Personal</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header>
        <h1>O L I M P O</h1>
    </header>
    <nav>
        <a href="../index.php">Home</a>
        <a href="index.php">Usuários</a>
        <a href="#">Perfil</a>
    </nav>

    <main>
        <h1>Usuários</h1>
        <section class="section__btn">
            <a class="btn" href="new.php">Novo</a>
        </section>

        <hr>

        <section>
            <table >
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nome</th>
                        <th>E-mail</th>
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
                            <td class="td__operacao">
                                <a class="btnalterar" href="update.php?id=<?=$row['id'];?>">Alterar</a>
                                <a class="btnexcluir" href="delete.php?id=<?=$row['id'];?>&foto=<?=$row['foto']?>" onclick="return confirm('Deseja confirmar a operação?');">Excluir</a>
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