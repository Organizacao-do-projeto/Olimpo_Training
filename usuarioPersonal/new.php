<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="assets/css/formulario.css">
  <link href="../assets/css/boot.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <title>Cadastro Personal</title>
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
  <main class="container">

    <h1>Cadastro</h1>
      <form action="usuarioadd.php" method="POST" enctype="multipart/form-data">
         <label>Nome:</label><br>
          <input type="text" name="nome" placeholder="Informe o seu nome" size="80" required><br>
          <label>E-mail:</label><br>
          <input type="email" name="email" placeholder="Informe o seu e-mail" size="80" required autofocus><br>
          <label>Senha:</label><br>
          <input type="password" name="password" placeholder="Informe a sua senha" required><br><br>
          <label for="sexo">Sexo:</label>
          <input type="radio" name="sexo" value="Masculino" checked>Masculino<BR>
          <input type="radio" name="sexo" value="Feminino">Feminino
          <label for="descricao">Descrição Pessoal:</label>
          <textarea name="descricao" id="" cols="30" rows="10" placeholder="Conte mais sobre você..."></textarea>

          <label for="numero">CPF:</label>
          <input type="text" name="cpf" placeholder="Informe o seu cpf">

          <label for="numero">Numero do CREF:</label>
          <input type="number" name="numero" placeholder="Informe o seu CREF">

          <label for="natureza">Natureza do CREF:</label>
          <select name="natureza">
                      <option value="Bacharelado">Bacharelado</option>
                      <option value="Licenciatura">Licenciatura</option>
                      <option value="Provisionado">Provisionado</option>
          </select>
          <label for="UF_registro">UF de registro</label>
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
          <label>Foto de perfil:</label><br>
          <input type="file" name="foto" ><br><br>
          <button class="btn" type="submit">Salvar</button>
      </form>
  </main>
</body>
</html>