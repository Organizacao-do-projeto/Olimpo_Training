<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../CRUD_mensalidades/assets/css/boot.css">
    <link rel="stylesheet" href="../../assets/css/form.css">
    
</head>
<body>
<header class="main_header">
        <div class="main_header_content">
            <a href="../../index.php">
                <img src="../../assets/img/logo_borda.png" alt="Olimpo Training" title="Olimpo Training"></a>
                <h4>Olimpo Training</h4>

            <nav class="main_header_content_menu">
                <ul>
                    <li><a href="../../index.php">Voltar</a></li>
                </ul>
            </nav>
        </div>
    </header>

    
    <form action="../CRUD_mensalidades/usuarios/usuarioadd.php" method="post">
        <div class="main-login">
            <div class="left-login">
                <h1>Cadastre-se<br>E entre para o Olimpo</h1>
                <img src="treino.svg" class="left-login-image" alt="Treino animação">

            </div>

            
            <div class="right-login">
                <div class="card-login">
                    <h1>Cadastro</h1>
                    <div class="textfield">
                        <label for="usuario">Nome Completo</label>
                        <input type="text" name="nome" size="80" placeholder="Informe o seu nome" required>
                    </div>
                    <div class="textfield">
                        <label for="email">E-mail</label>
                        <input type="email" name="email" size="50" placeholder="Informe o seu e-mail" required><br>
                        <label>Senha</label>
                        <input type="password" name="password" maxlength="25" autocomplete="off" required
                            placeholder="Informe sua senha">
                        <br>
                        <label>CPF</label>
                        <input type="text" class="cpf" name="CPF" size="3" id="cpf" maxlength="14" autocomplete="off"
                            placeholder="Ex: 000.000.000-00" onkeyup="mascara_cpf()" onkeypress="TestaCPF()"><br><br>
                    </div>
                    <button type="submit" class="btn-login">Enviar</button>

                </div>
            </div>
        </div>
    </form>

    <script src="../../assets/css/cpf.js"></script>

</body>
</html>