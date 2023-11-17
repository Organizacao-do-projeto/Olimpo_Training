<?php
    session_start();

    include_once __DIR__.'/../auth/restrito.php';
    include_once '../src/conexao.php';

    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    $dbh = Conexao::getConexao();
    
    $query = "SELECT * FROM olimpo.usuarios WHERE id = :id;";
    
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_BOTH);

    
    $dbhPerfis = Conexao::getConexao();
    
    $queryPerfis = "SELECT * FROM olimpo.perfis WHERE id = :id;";
    
    $stmtPerfis = $dbhPerfis->prepare($queryPerfis);
    $stmtPerfis->bindParam(':id', $id);
    $stmtPerfis->execute();
    $perfis = $stmtPerfis->fetch(PDO::FETCH_BOTH);


    $dbhCREFS = Conexao::getConexao();
    
    $queryCREFS = "SELECT * FROM olimpo.crefs WHERE idUsuarios = :idUsuarios;";
    
    $stmtCREFS = $dbhCREFS->prepare($queryCREFS);
    $stmtCREFS->bindParam(':idUsuarios', $id);
    $stmtCREFS->execute();
    $CREFS = $stmtCREFS->fetch(PDO::FETCH_BOTH);


    $dbh = null;
    $dbhPerfis = null;
    $dbhCREFS= null;

    if (!$usuario) 
    {
        header("location: index.php?error=Usuário não encontrado para o ID: $id");
        exit;
    }


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- <link rel="stylesheet" href="assets/css/formulario.css"> -->
  <link href="../assets/css/boot.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/css/formulario.css">
  <link rel="stylesheet" href="../assets/css/form.css">

  <title>Editar Personal</title>
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


<!-- INCIO DOBRA INTEGRAÇÃO -->

<form action="usuarioupdate.php" method="post" enctype="multipart/form-data">
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
                        <input type="text" name="nome" size="80" minlength="3" maxlength="300" value="<?=$usuario['nome']?>" placeholder="Informe o seu nome" required><br>

                        <label for="email">E-mail<font color="red">*</font></label>
                        <input type="email" name="email" size="50" value="<?=$usuario['email']?>" placeholder="Informe o seu e-mail" required><br>
                        <label>Senha<font color="red">*</font></label>
                        <input type="password" name="password" maxlength="25" autocomplete="off" required
                            placeholder="Informe sua senha">
                        <br>
                        <div class="wrapInputRadio">
                        <label for="sexo">Sexo:<font color="red">*</font></label>
                            <input type="radio" name="sexo" value="Masculino"
                            <?php
                            if($usuario['sexo'] == "Masculino"){ echo "checked"; }; ?>>Masculino
          <input type="radio" name="sexo" value="Feminino" <?php
          if($usuario['sexo'] == "Feminino"){ echo "checked"; };?> >Feminino
                        </div><br>

                        <label for="descricao">Descrição Pessoal: <font color="red">*</font></label>
                        <textarea name="descricao" placeholder="Conte mais sobre sua carreira..."  minlength="1" maxlength="250" required><?=$usuario['descricao']?></textarea>

                        <label>CPF:<font color="red">*</font></label>
                        <input type="text" class="CPF" name="cpf" value="<?=$usuario['CPF']?>" size="3" id="cpf" maxlength="14" minlength="10" autocomplete="off"
                            placeholder="Ex: 000.000.000-00" onkeyup="mascara_cpf()" onkeypress="TestaCPF()" required><br>

                        <label for="numero">Numero do CREF: <font color="red">*</font></label>
                        <input type="text" name="numero" value="<?=$CREFS['numero']?>" minlength="6" maxlength="6" required placeholder="Informe os digitos do seu CREF"><br>

                        <label for="natureza">Natureza do CREF: <font color="red">*</font></label>
                      <select name="natureza" id="natureza">
                                    <option value="Bacharelado/Licenciatura">Bacharelado/Licenciatura</option>
                                  <option value="Provisionado">Provisionado</option>
                      </select>

                       
                        
                        </select>

                            <label for="UF_registro" >UF de registro <font color="red">*</font></label>
                            <select name="UF_registro" id="UF_registro">
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
                    <input type="file" name="foto" onchange="pressed()" id="foto" ><span id="fileLabel"><?=$usuario['foto']?></span><br/><br><br>
                    <input type="hidden" value="<?=$usuario['id']?>" name="id">
                    <input type="hidden" value="<?=$usuario['foto']?>" name="fotoAnterior">
                    <?php if(isset($_GET['redirect'])){  ?>
                                <input type="hidden" name="redirect" value="<?=$_GET['redirect']?>" >
                    <?php
                    }
                    ?>
                    <button class="btn" type="submit">Salvar</button>
                </div>
            </div>
        </div>
    </form>
<!-- FIM DOBRA INTEGRAÇÃO -->

</body>
<script src="../assets/script/cpf.js"></script>
<script>

<?php   echo 'document.getElementById("UF_registro").value = "'.$CREFS['UF_registro'].'";
            document.getElementById("natureza").value = "'.$CREFS['natureza'].'";'; ?>

window.pressed = function(){
    var a = document.getElementById('foto');
    var fileLabel = document.getElementById('fileLabel');
    if(a.value == "")
    {
        fileLabel.innerHTML = "Escolha um arquivo";
    }
    else
    {
        var theSplit = a.value.split('\\');
        fileLabel.innerHTML = theSplit[theSplit.length-1];
    }
};



</script>

<style>
    input[type=file]{
    width: 122px;
    height: 35px;
    color: transparent;
    }
</style>

</html>