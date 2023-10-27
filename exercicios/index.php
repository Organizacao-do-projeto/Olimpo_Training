<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Exercicios </title>
</head>
<style>
    /* INICIO DOBRA EXERCICIOS */


    .btAdmin{
        display: flex;
        justify-content: end;
    }

    .showExercicios{
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
    }

    .wrapbtn{
        display: flex;
        align-items: end;
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
    
    .wrapbtn a{
        display: flex;
        text-align: center;
        font-family: 'Rubik';
        text-decoration: none;
        color: #68521b;
        font-weight: 800;
        font-size: 1.3rem;
        
    }

    .blocoExercicio {
        display: flex;
        flex-direction: column;
        width: 280px;
        height: 285px;
        background-color: rgb(7, 120, 225);
        border-radius: 5%;
        overflow: hidden;
        align-items: center;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);

    }

    .blocoExercicio_content_title {
        display: flex;
        flex-direction: row;
        width: 100%;
        justify-content: center;
    }

    .blocoExercicio_content_title h1 {
        margin: 5px;
        font-size: 1.6rem;
        color: #fff;
        max-width: 260px;
        word-wrap: break-word;
    }

    .blocoExercicio img {
        width: 200px;
        height: 150px;
    }

    .blocoExercicio video {
        width: 200px;
        height: 150px;
    }

    .blocoExercicio input[type=number] {
        width: 40px;
        border-radius: 15%;
        border: 3px solid red;
    }

    .blocoExercicio_form_seriesRep {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
    }

    .blocoExercicio_form_intervaloCarga {
        justify-content: space-between;
    }

    #editExercicio {
        margin-top: 5px;
        width: 97%;
        height: 28px;
        border-radius: 15%;
        background-color: rgb(44, 223, 44);
    }

    .formAction{
        display: inline-block;  
    }


    /* FIM DOBRA EXERCICIOS */
    /* Teste */

</style>
<body>
        <?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/teste5/layouts/header.php";
        ?>
    <section class="btAdmin">
        <div class="wrapbtn">
            <a href="admPanelExercicios.php" class="btnCriar">Painel de administrador</a>
        </div>    
    </section>
    <section class="showExercicios">
<?php 

//verificação pra ver se o usuario é admin

if(isset($_GET['msg'])){

    $msg = $_GET['msg'];
    echo $msg;

};

    include_once 'src/conexao.php';

    $dbh = Conexao::getConexao();

    $query = "SELECT * FROM olimpo.exercicios";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $exercicios = $stmt->fetchAll();

    
    foreach($exercicios as $exercicio):
?>

    <div class="blocoExercicio" id="<?=$exercicio['idExercicios']?>">
        <div class="blocoExercicio_content">
            <div class="blocoExercicio_content_title">
                <h1><?=$exercicio['nome']?></h1>
            </div>
            <a href="detailsExercicio.php?id=<?=$exercicio['idExercicios']?>" target="_blank">
            <!-- essa imagem tem 200x150 -->
            <?php

                $extensao = $exercicio['nome_arq'];
                $extensao = pathinfo($extensao, PATHINFO_EXTENSION);

                if($extensao == 'mp4' || $extensao == 'mov' || $extensao == 'webm'): ?>
                    <video autoplay muted loop>
                        <source src="animacoes/<?=$exercicio['nome_arq']?>">
                    </video>
                <?php
                else:
                ?>
                    <img src="animacoes/<?=$exercicio['nome_arq']?>">
                <?php
                endif;
                ?>
            </a>
            <br>
        </div>
    </div>

    <br><br>
<?php endforeach; ?>
    </section>

</body>
</html>