<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boot.css">
    <title> Exercícios </title>
</head>
<body>

    <?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
        ?>
    <section class="btAdmin">
        <div class="wrapbtn">
            <a href="admPanelExercicios.php" class="btnCriar">Painel de Administrador</a>
        </div>    
    </section>
    <h1 class="mainTitulo">Exercícios</h1>
    
    <section class="showExercicios">
<?php 

//verificação pra ver se o usuario é admin


    include_once 'src/conexao.php';

    $dbh = Conexao::getConexao();

    $query = "SELECT * FROM olimpo.exercicios";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $exercicios = $stmt->fetchAll();

    
    foreach($exercicios as $exercicio):
?>
    <div class="wrapperBloco">
        <div class="blocoExercicio" id="<?=$exercicio['idExercicios']?>">
            <div class="blocoExercicio_content">
                    <h1><?=$exercicio['nome']?></h1>
                <a href="detailsExercicio.php?id=<?=$exercicio['idExercicios']?>" target="_blank">
                <!-- essa imagem tem 200x150 -->
                <?php

                    $extensao = $exercicio['nome_arq'];
                    $extensao = pathinfo($extensao, PATHINFO_EXTENSION);

                    if($extensao == 'mp4' || $extensao == 'mov' || $extensao == 'webm'): ?>
                    <video class="videoAnimacao" autoplay muted loop>
                        <source src="animacoes/<?=$exercicio['nome_arq']?>">
                    </video>
                    <?php   else: ?>
                    <img class="videoAnimacao" src="animacoes/<?=$exercicio['nome_arq']?>">
                    <?php
                    endif;
                    ?>         
                </a>
                <div class="tipoExercicio">
                    <?=$exercicio['ativ_fisica']?>
                </div>
            </div>
        </div>
    </div>

    <br><br>
<?php endforeach; ?>
    </section>

</body>
<style>

.mainTitulo{

    color: black;
   font-family: 'Ubuntu', sans-serif, Arial, Helvetica;;
    font-size: 90px;
    font-style: normal;
    font-weight: 600;
    margin-bottom: 20px;
    text-align: center;
    line-height: 110%; /* 143px */
    letter-spacing: -1.625px;
}    


.btAdmin{
        display: flex;
        justify-content: end;
        margin-top: 20px;
    }

    .showExercicios{
        margin: 20px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        /* justify-content: space-around; */
        margin-bottom: 90px;
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
font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
        text-decoration: none;
        color: #68521b;
        font-weight: 800;
        font-size: 1.3rem;
        
    }




    /* INICIO CARD EXERCÍCIO */
    
    @property --rotate {
        syntax: "<angle>";
        initial-value: 132deg;
        inherits: false;
    }
    :root{
        --card-height: 330px;
        /* modifica a altura */
        --card-width: 290px;
    }


    /* coloca o fundo rgb */
    .wrapperBloco{
        width: calc(var(--card-width) + 13px);
        height: calc(var(--card-height) + 13px);
        background-image: linear-gradient(var(--rotate), rgb(255, 255, 141), gold 43%, yellow, #5ddcff);
        opacity: 1;
        transition: opacity .5s;
        animation: spin 5s Linear infinite;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 10px;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
        margin: 15px;

    }

    /* div principal */
    .blocoExercicio{
        background: linear-gradient(45deg,#F7D4D4,#F6ECC4);
        width: var(--card-width);
        height: var(--card-height);
        padding: 3px;
        border-radius: 6px;
        justify-content: center;
        align-items: center;
        text-align: center;
        display: flex;
        flex-direction: column;
        font-size: 1.5rem;
        color: black;
font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
       font-family: 'Ubuntu', sans-serif, Arial, Helvetica;, 'Ubuntu', sans-serif, Arial, Helvetica;
        font-weight: 500;

    }

    .blocoExercicio a{
        text-decoration: none;
    }

    .videoAnimacao{
        margin-top: 15px;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
        border-radius: 13px;
        width: 200px;
        height: 150px;
    }

    .tipoExercicio{
        font-size: 19px;
        margin-top: 26px;
        color: rgb(88 199 250 / 0%);
    }
    
    .blocoExercicio_content h1{
        color: black;
font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
        font-size: 35px;
        font-style: normal;
        font-weight: 600;
        line-height: 110%; /* 143px */
        letter-spacing: -1.625px;
        overflow: hidden;

    }


    /* modifica o texto inserido na div */
    .blocoExercicio:hover .tipoExercicio{
        color: black;
        transition: color 1s;
        
    }
    

    /* mexe pra frente */
    .blocoExercicio:hover{
        transform: scale(1.08);
        transition: ease-out .3s;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);

    }

    /* gira a animação */
    @keyframes spin{
        0% {
            --rotate: 0deg;
        }
        100%{
            --rotate: 360deg;
        }
    };

    /* FIM CARD EXERCICIO */

</style>
<?php
        // $path = getenv('DOCUMENT_ROOT');
        // include_once $path."/Olimpo_Training/teste5/layouts/header.php";
?>
</html>