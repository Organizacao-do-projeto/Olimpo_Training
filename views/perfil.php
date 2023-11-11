<?php
// session_start();
// if(!isset($_SERVER['dadosUsuario'])){

//     header("Location: index.php");

// }

//$dadosUsuario = $_SERVER['dadosUsuario'];

// varivael estática para testar o programa
$dadosUsuario = [ "id" => 7, "nome" => "Fernando", "idPerso_trainer" => 8 ];


//adicionar os dados do perfil
//estilizar
include_once "src/conexao.php";

//verifica se o perfil existe
if(isset($_GET['idPerfil'])){
    
    $idPerfil = $_GET['idPerfil'];

}else{
    
    echo "<p><Strong>Ops, este usuário não foi encontrado!</Strong></p>" ;
}

//dá o update se o botão for selecionado
if(isset($_POST['idPerso_trainer'])){

    $valorUpdate = $_POST['idPerso_trainer'];

    $dbh = Conexao::getConexao();
    
    $queryUpdatePersonal = "UPDATE olimpo.usuarios SET idPerso_trainer = :valorUpdate WHERE id = :id;";
    
    $stmtUpdate = $dbh->prepare($queryUpdatePersonal);
    $stmtUpdate->bindParam(":valorUpdate", $valorUpdate);
    $stmtUpdate->bindParam(":id", $dadosUsuario['id']);
    $stmtUpdate->execute();
    
}


$dbh = Conexao::getConexao();

$queryPerfil = "SELECT * FROM olimpo.usuarios WHERE id = :idPerfil; ";

$stmtPerfil = $dbh->prepare($queryPerfil);
$stmtPerfil->bindParam(":idPerfil", $idPerfil);
$stmtPerfil->execute();
$dadosPerfil = $stmtPerfil->fetch();

if($dadosPerfil['autenticado'] == 0 ){
    // header("Location: index.php");
}



$dbhTabelaPerfis = Conexao::getConexao();

$queryTabelaPerfis = "SELECT * FROM olimpo.perfis WHERE id = :idPerfil";

$stmtTabelaPerfis = $dbhTabelaPerfis->prepare($queryTabelaPerfis);
$stmtTabelaPerfis->bindParam(":idPerfil", $idPerfil);
$stmtTabelaPerfis->execute();
$dadosTabelaPerfis = $stmtTabelaPerfis->fetch();


?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <title><?=$dadosPerfil['nome']?> | Olimpo Training </title>
</head>
<body>
<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
?>
        <a href="pesquisarUsuario.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>
    <main>

    <header>
        <section class="lado">
                            <?php if(empty($dadosPerfil['foto'])){ ?>
                                <img src="assets/img/usuarioGenerico.jpg" id="fotoUsuario" >

                            <?php }else{ ?>
                                <img src="../assets/img/usuarios/<?=$dadosPerfil['foto']?>" id="fotoUsuario" >
                                
                            <?php } ?>
        </section>
    </header>

    <section class="infosPersonal">
            <article>
                <!-- <?php
                //verifica se o usuário apresentado é personal trainer
                if($dadosTabelaPerfis['nome'] == 'PERSONAL-TRAINER'):
                    //verifica se ele já está selecionado como personal traienr do usuário
                    //AQUI EM BAIXO VERIFICAR A CONTA DO USUÁRIO E NÃO DO PERSONAL
                    if($dadosUsuario['idPerso_trainer'] == $dadosTabelaPerfis['id']){
                        //depois colcocar outra informando se já for o personal da pessoa, apresentar o botão selecionado e ao clicar irá aparecer um confirm perguntando se retirar este usuário como seu personal trainer
                        //mostra o botão selecionado
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" name="idPerso_trainer" value="0">
                            <button class="btSelecionado" type="submit" onclick="return confirm('Deseja retirar <?=$dadosPerfil['nome']?> como seu personal trainer?')">Retirar personal trainer</button>
                        <form>

                        <?php 
                    }else{
                        //mostra o botão padrão
                        ?>
                        <form action="" method="POST">
                            <input type="hidden" name="idPerso_trainer" value="<?=$dadosPerfil['id']?>">
                            <button class="btDesselecionado" type="submit">Adicionar como seu personal</button>
                        <form>
                        
                        <?php
                    }
                 endif;
                ?>   -->

                 <div class="infosPersonalContent">
                    <h1><?=$dadosPerfil['nome']?></h1>
                    <!-- colocar aqui um if para direcionar apresentar a desrcição se personal ou os dados se usário -->
                    <div class="infosPersonalContentDescricao">
                        <?php
                         if($dadosTabelaPerfis['nome'] == 'PERSONAL-TRAINER'){ ?>
                             <span class="tipoUser"> Personal Trainer </span><br>
                             <p> <?=$dadosPerfil['descricao']?> </p>
                             <?php
                         }else{ ?>
                            <br>
                            <span class="tipoUser"> Aluno </span><br>
                            <span class="tituloAtributos"><Strong>Altura: </Strong><?=$dadosPerfil['altura']?><Strong> cm</Strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<Strong>Peso: </Strong><?=$dadosPerfil['peso']?><Strong> kg</Strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<Strong>Sexo: </Strong><?=$dadosPerfil['sexo']?></span><br><br><br>
                            <p> <?=$dadosPerfil['objetivo']?> </p>
                            <?php
                         }
                        ?>
                    </div>
                 </div>

            </article>
            

    </section>
    </main>
</body>
<style>
       .lado {
            height: 800px;
            width: 280px;
            position: absolute;
            background-color: #fff;
            box-shadow: 2px 0px 2px 1px rgba(0, 0, 0, 0.2);
            display: flex;
            align-items: center;    
        }
        
        #fotoUsuario {
            border-radius: 50%;
            box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
            padding: 5px;
            margin: 20px;
            width: 200px;
            height: 200px;
            border: 5px solid rgba(253, 237, 15, 0.3);
            transition: all 0.3s ease-out;
        }

        .infosPersonal{
            margin-left: 300px;
            height: 800px;
            width: 1220px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .btSelecionado{
            
            box-sizing: border-box;
            

            margin-bottom: 15px;

            padding: 12.2362px 36.7085px;
            gap: 12.24px;

            width: 284.48px;
            height: 67.3px;

            background: radial-gradient(circle at 10% 20%, rgb(255, 200, 124) 0%, rgb(252, 251, 121) 90%);

            border: 1.22362px solid #F2F2F2;
            backdrop-filter: blur(2.44724px);

            border-radius: 83.206px;
            color: #68521b;
            font-weight: 800;
            font-size: 1.1rem;
            box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);


        }

        .btDesselecionado{

            box-sizing: border-box;
            

            margin-bottom: 15px;

            padding: 12.2362px 36.7085px;
            gap: 12.24px;

            width: 284.48px;
            height: 67.3px;

            background: linear-gradient(to right, rgb(182, 244, 146), rgb(51, 139, 147));

            border: 1.22362px solid #F2F2F2;

            border-radius: 83.206px;
            color: #fff;
            font-weight: 800;
            font-size: 1.1rem;
            box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);

        }


         h1 {
            width: 455px;
            height: 127px;
            left: 79px;
            top: 353px;

    font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
            font-style: normal;
            font-weight: 500;
            font-size: 50px;
            line-height: 127px;
            letter-spacing: -2.22739px;
            color: black;
            margin-left: 30px;

        }

        .infosPersonalContent{
            width: 100%;
            max-width: 800px;
            background-color: #E4E2DF;
        }
        .infosPersonalContent h1{
            width: 100%;
            margin: 0;
            height: 90px; 
            margin-left: 30px;
        }

        .infosPersonalContentDescricao p{
            height: 210px;
            margin-left: 30px;

            font-family: 'Relative';
            font-style: normal;
            font-weight: 400;
            font-size: 18px;
            line-height: 150%;

            /* color: rgba(22, 22, 22, 0.9); */
            color: black;


            flex: none;
            order: 1;
            flex-grow: 0;

        }

        .infosPersonalContentDescricao span{
            margin-left: 30px;
        }

        .tituloAtributos{
            width: 801px;
            height: 151px;
            margin-left: 30px;
            
    font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
            font-style: normal;
            font-weight: 600;
            font-size: 18px;
            line-height: 150%;
            
            color: black;
            
        }

        .tipoUser{
            color: green;
            margin-left: 30px;
            
    font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
            font-style: normal;
            font-weight: 400;
            font-size: 28px;
            line-height: 150%;
            
        }

</style>
</html>