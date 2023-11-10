<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/formulario.css">
  <link href="../assets/css/boot.css" rel="stylesheet">
  <!-- <link href="../assets/css/style.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="../assets/css/form.css">
  <title>Cadastro Personal Trainer</title>
</head>
<body>
    <!--DOBRA CABEÇALHO-->

    <header class="main_header">
        <div class="main_header_content">
            <a href="../index.php" class="logo">
                <img src="../assets/img/logos/logo_borda.png" alt="Logo Olimpo"
                    title="Logo Olimpo"></a>

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
                <div class="card-login-personal">
                    <h1>Cadastro</h1>
                    <div class="textfield">
                        <label for="usuario">Nome Completo<font color="red">*</font></label><span></span>
                        <input type="text" name="nome" size="80" 
                        minlength="3" maxlength="300" placeholder="Informe o seu nome" required><br>

                        <label for="email">E-mail<font color="red">*</font></label>
                        <input type="email" name="email" size="50" placeholder="Informe o seu e-mail" size="50" maxlength="150" required><br>
                        <label>Senha<font color="red">*</font></label>
                        <input type="password" name="password" maxlength="25" autocomplete="off" required
                            placeholder="Informe sua senha">
                        <br>
                        <div class="wrapInputRadio">
                            <label for="sexo">Sexo:<font color="red">*</font></label>
                            <input type="radio" name="sexo" value="Masculino" checked>Masculino
                            <input type="radio" name="sexo" value="Feminino" required>Feminino
                        </div><br>

                        <label for="descricao">Descrição Pessoal: <font color="red">*</font></label>
                        <textarea name="descricao" placeholder="Conte mais sobre sua carreira..." minlength="1" maxlength="250" required></textarea>

                        <label>CPF:<font color="red">*</font></label>
                        <input type="text" class="CPF" name="cpf" size="3" id="cpf" maxlength="14" minlength="10" autocomplete="off"
                            placeholder="Ex: 000.000.000-00" onkeyup="mascara_cpf()" onkeypress="TestaCPF()" required><br>

                        <label for="numero">Numero do CREF: <font color="red">*</font></label>
                        <input type="number" name="numero" placeholder="Informe os digitos do seu CREF" minwidth="6" maxwidth="6" required><br>

                        <label for="natureza">Natureza do CREF: <font color="red">*</font></label>
                      <select name="natureza" required>
                                  <option value="Bacharelado">Bacharelado</option>
                                  <option value="Licenciatura">Licenciatura</option>
                                  <option value="Provisionado">Provisionado</option>
                      </select>

                       
                        
                        </select>

                            <label for="UF_registro">UF de registro <font color="red">*</font></label required>
                            <select name="UF_registro">
                              <option value="">Selecione</option>
                              <option value="AC">AC</option>
                              <option value="AL">AL</option>
                              <option value="AP">AP</option>
                              <option value="AM">AM</option>
                              <option value="BA">BA</option>
                              <option value="CE">CE</option>
                              <option value="DF">DF</option>
                              <option value="ES">ES</option>
                              <option value="GO">GO</option>
                              <option value="MA">MA</option>
                              <option value="MS">MS</option>
                              <option value="MT">MT</option>
                              <option value="MG">MG</option>
                              <option value="PA">PA</option>
                              <option value="PB">PB</option>
                              <option value="PR">PR</option>
                              <option value="PE">PE</option>
                              <option value="PI">PI</option>
                              <option value="RJ">RJ</option>
                              <option value="RN">RN</option>
                              <option value="RS">RS</option>
                              <option value="RO">RO</option>
                              <option value="RR">RR</option>
                              <option value="SC">SC</option>
                              <option value="SP">SP</option>
                              <option value="SE">SE</option>
                              <option value="TO">TO</option>
                            </select> 


                    <label>Foto de perfil: <font color="red">*</font></label><br>
                    <input type="file" name="foto" required><br><br>
                    <button class="btn" type="submit">Salvar</button>
                </div>
            </div>
        </div>
    </form>

</body>
<script src="../assets/script/cpf.js"></script>
</html>