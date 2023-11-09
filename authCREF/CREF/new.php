<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Exercicio 03 - Usuários</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>
    <header>
        <h1>Autenticar CREF - Usuários</h1>
        <p>Exercício introdutório exemplificando o crud nas tabelas usuários e perfil. </p>
    </header>
    <nav>
        <a href="#">Home</a>
        <a href="index.php">Usuários</a>
        <a href="#">Perfil</a>
    </nav>
    <main>

        <h1>Novo Usuário</h1>
        <form action="usuarioadd.php" method="post">
            <label>E-mail</label><br>
            <input type="email" name="email" placeholder="Informe seu e-mail." size="80" required autofocus><br>
            <label>Nome</label><br>
            <input type="text" name="nome" placeholder="Informe seu nome." size="80" required><br>
            <label>Password</label><br>
            <input type="password" name="password" placeholder="Informe sua senha." required><br><br>

            <button class="btn" type="submit">Salvar</button>
        </form>
    </main>
</body>

</html>