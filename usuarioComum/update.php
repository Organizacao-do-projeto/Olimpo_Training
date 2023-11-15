<?php
    include_once '../src/conexao.php';

    $dbh = Conexao::getConexao();

    # cria a variavel $id com valor igual a 1. 
    $id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
    
    $query = "SELECT * FROM olimpo.usuarios WHERE id = :id;";
    
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $usuarios = $stmt->fetch(PDO::FETCH_BOTH);


    // $dbhPerfis = Conexao::getConexao();

    // $queryPerfis = "SELECT * FROM olimpo.perfis WHERE id = :id;";

    // $stmtPerfis = $dbhPerfis->prepare($queryPerfis);
    // $stmtPerfis->bindParam(':id', $id);
    // $stmtPerfis->execute();
    // $perfis = $stmtPerfis->fetch(PDO::FETCH_BOTH);


    // $dbhAssinaturas = Conexao::getConexao();

    // $queryAssinaturas = "SELECT * FROM olimpo.assinaturas WHERE idUsuarios = :idUsuarios;";

    // $stmtAssinaturas = $dbhAssinaturas->prepare($queryAssinaturas);
    // $stmtAssinaturas->bindParam(':idUsuarios', $id);
    // $stmtAssinaturas->execute();
    // $assinaturas = $stmtAssinaturas->fetch(PDO::FETCH_BOTH);


    // $dbhPagamentos = Conexao::getConexao();

    // $queryPagamentos = "SELECT * FROM olimpo.pagamentos WHERE idUsuarios = :idUsuarios;";

    // $stmtPagamentos = $dbhPagamentos->prepare($queryPagamentos);
    // $stmtPagamentos->bindParam(':idUsuarios', $id);
    // $stmtPagamentos->execute();
    // $pagamentos = $stmtPagamentos->fetch(PDO::FETCH_BOTH);
    
    $dbh = null;
    // if (!$usuarios || !$perfis /*|| !$assinaturas || !$pagamentos*/ ) 
    // {
    //     header('location: index.php?msg=Usuário não encontrado para o ID: {$id}');
    //     exit;
    // }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de usuario aluno</title>
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


    <form action="usuarioupdate.php" method="post" enctype="multipart/form-data">
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
                        <input type="text" name="nome" value="<?=$usuarios['nome']?>" size="80" placeholder="Informe o seu nome" minlength="3" maxlength="300" required><br>

                        <label for="email">E-mail<font color="red">*</font></label>
                        <input type="email" name="email" value="<?=$usuarios['email']?>" size="50" placeholder="Informe o seu e-mail" maxlength="150" required><br>
                        <label>Senha<font color="red">*</font></label>
                        <input type="password" name="password" maxlength="25" autocomplete="off" required
                            placeholder="Informe sua senha">
                        <br>
                        <div class="wrapInputRadio">
                            <label for="sexo">Sexo:<font color="red">*</font></label><br><br>
                            <input type="radio" name="sexo" value="Masculino" <?php if($usuarios['sexo'] == 'Masculino'){ echo "checked";};?>>Masculino
                        <input type="radio" name="sexo" value="Feminino" <?php if($usuarios['sexo'] == 'Feminino'){ echo "checked";};?>>Feminino
                        </div>

                        <div class="flex-row">
                            <div>
                                <label for="altura">Altura:<font color="red">*</font></label>
                                <div class="flex-row center-text">
                                <input type="text" name="altura" value="<?=$usuarios['altura']?>"  minlentgh="1" maxlength="7" required class="shortInput" placeholder="Ex.: 175">cm
                                </div>
                            </div>
                            &nbsp;&nbsp;
                            <div>
                            <label for="peso">Peso:<font color="red">*</font></label>
                                <div class="flex-row center-text">
                                    <input type="text" name="peso" value="<?=$usuarios['peso']?>" class="shortInput" placeholder="Ex.: 65.5" required maxlength="7" minlength="1" >kg
                                </div>
                            </div>
                        </div><br>

                        <label for="objetivo">Objetivo Pessoal:<font color="red">*</font></label>
                        <textarea name="objetivo" placeholder="Conte-nos onde quer chegar com ajuda dos treinos..."  minlength="1" maxlength="250" required><?=$usuarios['objetivo']?></textarea><br>   

                        <div>
                            <label>Foto de Perfil:</label><br>
                            <input type="file" name="foto" onchange="pressed()" id="foto" ><span id="fileLabel"><?=$usuarios['foto']?></span><br/>
                        </div>
                            <input type="hidden" value="<?=$usuarios['id']?>" name="id">
                            <input type="hidden" value="<?=$usuarios['foto']?>" name="fotoAnterior" >
                            <?php if(isset($_GET['redirect'])){  ?>
                            <input type="hidden" name="redirect" value="<?=$_GET['redirect']?>" >
                            <?php
                            }
                            ?>
                    </div>
                    <button type="submit" class="btn-login">Enviar</button>
                </div>
            </div>
        </div>
    </form>

    <script src="../assets/script/cpf.js"></script>
    <script>
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
    width: 160px;
    height: 35px;
    color: transparent;
    }
</style>
</body>
</html>