<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Exercicios Admin </title>
</head>
<style>
    /* INICIO DOBRA EXERCICIOS */

    .blocoExercicio {
        display: flex;
        flex-direction: column;
        width: 280px;
        height: 285px;
        background-color: rgb(7, 120, 225);
        border-radius: 5%;
        overflow: hidden;
        align-items: center;
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

</style>
<body>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/teste5/layouts/header.php";
?>

<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

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

        <table >
            <tr>
                <td>
                    <form class="formAction" action='deleteExercicio.php' method='POST'>
                            <input type='hidden' name='idExercicios' value='<?=$exercicio['idExercicios']?>'>
                            <!-- colocar o nome aqui -->
                            <input type='hidden' name='nome' value='<?=$exercicio['nome_arq']?>'>
                            <button type='submit'>Excluir</button>
                    </form>
                    <form class="formAction" action='editExercicio.php' method='POST'>
                            <input type='hidden' name='idEdit' value='<?=$exercicio['idExercicios']?>'>
                            <button type='submit' id="editExercicio">Editar</button>
                    </form>
                <td>
            <tr>
        </table>
    </div>

    <br><br>
<?php endforeach; ?>


</body>
</html>