<?php
    session_start();

    include_once __DIR__.'/../auth/restrito.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Exercicios Admin </title>
</head>
<body>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
?>

<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>
<section class="btAdmin">
    <a href="newExercicio.php" class="wrapbtn">Cadastrar exercicio</a>
</section>

<?php 

//verificação pra ver se o usuario é admin

    include_once 'src/conexao.php';

    $dbh = Conexao::getConexao();

    $query = "SELECT * FROM olimpo.exercicios";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $exercicios = $stmt->fetchAll();

?>



<section class="showExercicios">
<?php   
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
                <div class="botoesAcao">

                    <form class="formAction" action='deleteExercicio.php' method='POST'>
                            <input type='hidden' name='idExercicios' value='<?=$exercicio['idExercicios']?>'>
                            <!-- colocar o nome aqui -->
                            <input type='hidden' name='nome' value='<?=$exercicio['nome_arq']?>'>
                            <button title="Excluir" type="button" onclick="swalConfirm(this,'Exlcuir exercicio','Tem certeza que deseja excluir este exercicio?')" id="btExcluir"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Cross_icon_%28white%29.svg/120px-Cross_icon_%28white%29.svg.png" width="16px" height="17px"  alt="Excluir"></button>
                    </form>
                    <form class="formAction" action='editExercicio.php' method='POST'>
                            <input type='hidden' name='idEdit' value='<?=$exercicio['idExercicios']?>'>
                            <button title="Editar" type="submit" id="btEdit"><img src="https://cdn-icons-png.flaticon.com/512/1827/1827933.png" width="20px" height="17px"  alt="Editar" ></button>
                            
                    </form>
                </div>
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

.wrapbtn{
        display: flex;
        align-items: center;
        box-sizing: border-box;
        justify-content: center;
        text-decoration: none;
        
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
        display: flex;
        text-align: center;
font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
        color: #68521b;
        font-weight: 800;
        font-size: 1.3rem;
    }
    
        .btAdmin{
            display: flex;
            justify-content: end;
        }
        
        .btnCriar{
            display: flex;
            justify-content: center;
        }
        /* FIM DOBRA BOTÃO */


    
    /* INICIO DOBRA EXERCICIOS */
    .showExercicios{
            margin: 4px;
            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            /* justify-content: space-around; */
            margin-bottom: 90px;
        }

 
    /* INICIO CARD EXERCÍCIO */
    
    @property --rotate {
        syntax: "<angle>";
        initial-value: 132deg;
        inherits: false;
    }
    :root{
        --card-height: 390px;
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
        margin: 5px;
        margin-top: 18px;

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


    #editExercicio {
        margin-top: 5px;
        width: 97%;
        height: 28px;
        border-radius: 15%;
        background-color: rgb(44, 223, 44);
    }

    .botoesAcao{
        display: flex;
        flex-direction: row;
        align-items: center;
        justify-content: center;
        margin-top: 10px;
        
    }
    
    #btEdit{
        font-weight: 700;
        background-color: #607d8b;
        border: transparent;
        border-radius: 10px;
        width: 90px;
        height: 35px;
        color: #fff;
        cursor: pointer;
    }

    #btEdit:hover{
    background: #DCDCDC;
    }

    #btEdit img{
        filter:  brightness(0) invert(1);
    }
    #btEdit:hover img{
        filter: invert(0);
    }

    #btExcluir{      
    font-weight: 700;
    color: #fff;
    border-radius: 10px;
    background: #f74e43;
    width: 90px;
    height: 35px;
    border: transparent;
    padding: 0;
    cursor: pointer;
    }

    #btExcluir:hover img{
        filter: invert(1);
    }      

    #btExcluir:hover{
        background: #DCDCDC;
    }


    /* FIM DOBRA EXERCICIOS */

</style>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/footer.php";
?>
</html>