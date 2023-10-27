<?php
    include_once '../src/conexao.php';

    $dbh = Conexao::getConexao();
 
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    $query = "SELECT * FROM olimpo.usuarios WHERE id = :id;";

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    $usuario = $stmt->fetch(PDO::FETCH_BOTH);
    $dbh = null;
    if (!$usuario) 
    {
        header('location: index.php?msg=Usuário não encontrado para o ID: {$id}');
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste CRUD</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../assets/css/formulario.css">
</head>

<body>
    <header>
        <h1>O L I M P O</h1>
        <p style="text-align: center;">Update</p>
    </header>
    <nav>
        <!-- <a href="index.php" style="text-align: center;">Voltar</a> -->
    </nav>
    <main class="container">

    <h1>Cadastro</h1>
    <form action="usuarioadd.php" method="post">
        <label>Nome:</label><br>
        <input type="text" name="nome" placeholder="Informe o seu nome" size="80" required><br>
        <label>E-mail:</label><br>
        <input type="email" name="email" placeholder="Informe o seu e-mail" size="80" required autofocus><br>
        <label for="cref">CREF:</label>
        <input type="text" placeholder="Informe o seu CREF">
        <label for="sexo">Sexo:</label>
        <input type="radio" name="sexo" value="M">Masculino<BR>
        <input type="radio" name="sexo" value="F">Feminino</P>
        <label for="descricao">Descrição Pessoal:</label>
        <textarea name="descricao" id="" cols="30" rows="10"></textarea>
        <label>Senha:</label><br>
        <input type="password" name="password" placeholder="Informe a sua senha" required><br><br>

        <button class="btn" type="submit">Salvar</button>
    </form>
</main>
</body>

</html>