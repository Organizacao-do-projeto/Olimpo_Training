<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuário aluno</title>
    <link rel="stylesheet" href="../assets/css/boot.css">
    <link rel="stylesheet" href="../assets/css/form.css">
    
</head>
<body>
<header class="main_header">
        <div class="main_header_content">
            <a href="../index.php">
                <img src="../assets/img/logos/logo_borda.png" alt="Olimpo Training" title="Olimpo Training"></a>
                <h4>Olimpo Training</h4>

            <nav class="main_header_content_menu">
                <ul>
                    <li><a href="../views/sele.html">Voltar</a></li>
                </ul>
            </nav>
        </div>
    </header>

    
    <form action="usuarioadd.php" method="post" enctype="multipart/form-data">
        <div class="main-login-aluno">
            <div class="left-login">
                <h1>Cadastre-se<br>E entre para o Olimpo</h1>
                <img src="../assets/img/treino.svg" class="left-login-image" alt="Treino animação">
            </div>

            
            <div class="right-login">
                <div class="card-login">
                    <h1>Cadastro</h1>
                    <div class="textfield">
                        <label for="usuario">Nome Completo<font color="red">*</font></label><span></span>
                        <input type="text" name="nome" size="80" minlength="3" maxlength="300" placeholder="Informe o seu nome" required><br>

                        <label for="email">E-mail<font color="red">*</font></label>
                        <input type="email" name="email" size="50" maxlength="150" placeholder="Informe o seu e-mail" required><br>
                        <label>Senha<font color="red">*</font></label>
                        <input type="password" name="password" minlength="2" maxlength="25" autocomplete="off" required
                            placeholder="Informe sua senha">
                        <br>
                        <div class="wrapInputRadio">
                            <label for="sexo">Sexo:<font color="red">*</font></label><br><br>
                            <input type="radio" name="sexo" value="Masculino" checked >Masculino
                            <input type="radio" name="sexo" value="Feminino">Feminino
                        </div>

                        <div class="flex-row">
                            <div>
                                <label for="altura">Altura:<font color="red">*</font></label>
                                <div class="flex-row center-text">
                                <input type="number" name="altura" class="shortInput" placeholder="Ex.: 175" minlenght="1" maxlength="3" required>cm
                                </div>
                            </div>
                            &nbsp;&nbsp;
                            <div>
                            <label for="peso">Peso:<font color="red">*</font></label>
                                <div class="flex-row center-text">
                                    <input type="number" name="peso" class="shortInput" placeholder="Ex.: 65.5" maxlength="7" minlength="1" required>kg
                                </div>
                            </div>
                        </div><br>

                        <label for="objetivo">Objetivo Pessoal:<font color="red">*</font></label>
                        <textarea name="objetivo" id="" placeholder="Conte-nos onde quer chegar com ajuda dos treinos..." minlength="1" maxlength="250" required></textarea><br>   

                        <label>Foto de Perfil:<font color="red">*</font></label><br>
                        <input type="file" name="foto" id="foto" required><br><br>

                        <div class="wrapInputRadio">
                            <label for="sexo">Tipo de Assinatura:<font color="red">*</font></label><br><br>
                            <input type="radio" name="assinatura" value="ANUAL" checked>Anual&nbsp;&nbsp;
                            <input type="radio" name="assinatura" value="MENSAL">Mensal
                        </div>

                        <div class="wrapInputRadio">
                            <label for="pagamento">Tipo de Pagamento:<font color="red">*</font></label><br><br>
                            <input type="radio" name="pagamento" value="PIX" checked>PIX&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="pagamento" value="BOLETO">Boleto<br><br>
                        </div>
                        
                        <label>CPF:<font color="red">*</font></label>
                        <input type="text" class="CPF" name="CPF" size="3" id="cpf" minlenght="10" maxlength="14" autocomplete="off"
                            placeholder="Ex: 000.000.000-00" onkeyup="mascara_cpf()" onkeypress="TestaCPF()" required><br><br>
                    </div>
                    <button type="submit" class="btn-login">Enviar</button>
                </div>
            </div>
        </div>
    </form>

    <script src="../assets/script/cpf.js"></script>
    

</body>
</html>