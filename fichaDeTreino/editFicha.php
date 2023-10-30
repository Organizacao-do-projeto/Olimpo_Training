<?php
session_start();

!empty($_POST['idFichas_treino']) ? $idFichas_treino = $_POST['idFichas_treino'] : $idFichas_treino = 0 ;


//fazendo a conexão com o banco de dados
include 'src/conexao.php';

$dbhft_exe = Conexao::getConexao();
$dbhfichas_treino = Conexao::getConexao();
$dbhExercicios = Conexao::getConexao();

// query dos exercicios
$queryft_exe = "SELECT * FROM olimpo.ft_exe WHERE idFichas_Treino = :idFichas_treino; ";


$stmtft_exe = $dbhft_exe->prepare($queryft_exe);
$stmtft_exe->bindParam(':idFichas_treino', $idFichas_treino);
$stmtft_exe->execute();
$exercicios = $stmtft_exe->fetchAll();


//QUERY DO CABEÇALHO
$queryfichas_treino = "SELECT * FROM olimpo.fichas_treino WHERE idFichas_Treino = :idFichas_treino; ";

$stmtfichas_treino = $dbhfichas_treino->prepare($queryfichas_treino);
$stmtfichas_treino->bindParam(':idFichas_treino', $idFichas_treino);
$stmtfichas_treino->execute();
$cabecalhofichas_treino = $stmtfichas_treino->fetch();



if(!empty($_POST['idFichas_treino']) && $_POST['idFichas_treino'] != 0 )
{
$_SESSION['cabecalhoFichaEdit'] = $cabecalhofichas_treino;
};


        
if(!isset($_SESSION['sessaoFicha']) || empty($_SESSION['sessaoFicha'])) {
    $_SESSION['sessaoFicha'] = array();

    foreach($exercicios as $exercicio){
                        
        $idExercicios = $exercicio['idExercicios'];

        $queryExercicios = "SELECT * FROM olimpo.exercicios WHERE idExercicios = :idExercicios";
        
        $stmtExercicios = $dbhExercicios->prepare($queryExercicios);
        $stmtExercicios->bindParam(":idExercicios",$idExercicios);
        $stmtExercicios->execute();
        $resultTableExercicios = $stmtExercicios->fetch();
        

        $_SESSION['sessaoFicha'][] = [
            "id" => $resultTableExercicios['idExercicios'],
            "nome" => $resultTableExercicios['nome'],
            "modo" => $exercicio["modo"],
            "series" => $exercicio["series"],
            "repeticoes" => $exercicio["repeticoes"],
            "carga" => $exercicio["carga"],
            "intervaloSeries" => $exercicio["descSeries"]
            
        ];
        
    };

}



if(isset($_GET['acao'])) {
    if($_GET['acao'] == "addExercicio") {
        
        $_SESSION['sessaoFicha'][] = [
            'id' => (int) $_GET['id'],
            'nome' => $_GET['nome'],
            'modo' =>  $_GET['modo'],
            'series' => (int) $_GET['series'],
            'repeticoes' => (int) $_GET['repeticoes'],
            'carga' => (int) $_GET['carga'],
            'intervaloSeries' => (int) $_GET['intervaloSeries']
        ];   
        
    }

    if($_GET['acao'] == "excluir") {
        $id = (int) $_GET['id'];

        unset($_SESSION['sessaoFicha'][$id]);
        $_SESSION['sessaoFicha'] = array_values($_SESSION['sessaoFicha']);
        
    }

}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar ficha de treino</title>
</head>
<style>
    /* INICIO DOBRA EXERCICIOS */ 
    
    .headerInfos{
        padding: 20px;
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        align-items: center;
    }

    .headerInfos a{
        text-decoration: none;
        color: black;
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }

    h2{
        font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
    }


    .btIndex{
        border: none;
        width: 250px;
        padding: 5px 0px;
        color: #fff;
        text-align: center;
        text-decoration: none;
        display: inline-block;  
        box-sizing: border-box;
        margin-bottom: 15px;
        padding: 12.2362px 36.7085px;
        gap: 12.24px;
        background: radial-gradient(circle at 10% 20%, rgb(255, 200, 124) 0%, rgb(252, 251, 121) 90%);
        border: 1.22362px solid #F2F2F2;
        backdrop-filter: blur(2.44724px);
        border-radius: 83.206px;
        color: #68521b;
        font-weight: 800;
        font-size: 1.1rem;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
        font-family: 'Rubik';
        
    }

    .showExercicios{
        margin-bottom: 400px;
        display: flex;
        flex-direction: row;
        flex-wrap: wrap;
        justify-content: space-around;
    }


    /* INICIO BLOCO EXERCICIOS */
    .blocoExercicio_form {
        margin-top: 20px;
        opacity: 0;
    }
    
    .blocoExercicio input[type=number] {
        width: 35px;
        border-radius: 15%;
        border: 3px solid gold;
    }

    .blocoExercicio_form_seriesRep {
        display: flex;
        flex-direction: row;
        margin-left: 27px;
    }

    .blocoExercicio_form_intervaloCarga {
        display: flex;
        text-align: center;
        margin-left: 28px;
        
    }

    .blocoExercicio_form_seriesRep #repeticoes{
        margin-left: 35px;
    }

    

    #addExercicio {
        margin-top: 5px;
        width: 97%;
        height: 28px;
        border-radius: 15%;
        background-color: rgb(44, 223, 44);
        cursor: pointer;
    }

/* FIM DOBRA EXERCICIOS */


/* INCIO TESTE INTEGRAÇÃO */

    /* INICIO CARD EXERCÍCIO */
    
    @property --rotate {
        syntax: "<angle>";
        initial-value: 132deg;
        inherits: false;
    }
    :root{
        --card-height: 520px;
        /* --card-height: 390px; */
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
        font-family: 'Rubik';
        font-weight: 500;

    }


    .blocoExercicio_form {
        color: black;
        font-family: 'Rubik';
        font-size: 18px;
        font-style: normal;
        font-weight: 200;
        line-height: 110%; /* 143px */
        letter-spacing: -1.625px;
        overflow: hidden;
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
        font-family: 'Rubik';
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
    .blocoExercicio:hover .blocoExercicio_form{
        opacity: 1;
    }
    

    /* mexe pra frente */
    .blocoExercicio:hover{
        transform: scale(1.039);
        transition: ease-out .3s;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);

    }

    /* gira a animação */
    /* @keyframes spin{
        0% {
            --rotate: 0deg;
        }
        100%{
            --rotate: 360deg;
        }
    }; */



 /* FIM TESTE INTEGRAÇÃO */


    /* INICIO DOBRA FICHA */
    .wrapper_preFicha {
        border: 3px solid #36304a;
        border-radius: 10px 10px 0 0;
        height: 290px;
        width: 100%;
        position: fixed;
        bottom: 0;
        background-color: #f4f6fc; 
    }

    .wrapper_preFicha input[type=text]{
        background: transparent;
        border: none;
        margin-left: 10px;
        font-family: 'Rubik';
        font-size: 21px;
        font-style: normal;
        font-weight: 700;
        color: black;
    }
    
    .label_tituloFicha{
        margin-left: 10px;
        font-family: 'Rubik';
        font-size: 21px;
        font-style: normal;
        font-weight: 700;
        color: #36304a;
    }

    #tituloFicha {
        margin-bottom: 15px;
        margin-top: 15px;
    }

    .preFicha {
        display: flex;
        flex-direction: row;
        width: 100%;
        height: 270px;
    }

    #barra {
        width: 75%;
        height: 100%;
        flex-wrap: wrap;
        overflow: auto;

    }


/* INCIO DOBRA TABELA */
    #tabelaExe{
        border-collapse: collapse;
        width: 100%;
        border: 1px solid #36304a;
        overflow: auto;
    }
    
    #tabelaExe thead td{
        background-color: #36304a;
        color: #fff;
        font-weight: 500;
        border: 1px solid #ccc;

    }

    #tabelaExe td, th{
        font-family: 'Rubik';
        font-size: 20px;
        font-style: normal;
        font-weight: 400;
    }

    .primeirotd{
        margin-left: 8px;
    }
    

    /* ##########  */

    #barraExe {
        width: 100%;
        height: 100%;
        overflow: auto;
    }

    #barraExe tr{
        font-family: 'Rubik';
        font-size: 18px;
        font-style: normal;
        font-weight: 400;
        color: black;
    }

    .remover{
        
        background-color: black;
        color: white;
        padding: 1px 20px;
        text-decoration: none;
        border-radius: 15%;
        
    }

    .remover:hover{
        filter: invert(1);

    }
    
    #barraExe table:nth-child(odd){
        background: #fff;
    }
    
    #barraExe table:nth-child(even){
        background: #f0f0f0;
    }
    
    #barraExe tr:hover{
        background: #f0f0f0;

    }

    /* ########### */

    /* INICIO DOBRA CABEÇALHO DA FICHA */

    .cabecalhoFicha {
        height: 100%;
        width: 25%;
    }

    .wrapper_dados_ficha {
        height: 100%;
    }

    .wrapper_dados_ficha fieldset {
        height: 100%;
    }

    .labelIntervaloExe{
        font-family: 'Rubik';
        font-size: 17px;
        font-style: normal;
        font-weight: 600;
        color: #36304a;
    }
    .wrapper_dados_ficha input[type=number]{
        width: 30px;

    }
    
    .labelObs{
        font-family: 'Rubik';
        font-size: 17px;
        font-style: normal;
        font-weight: 600;
        color: #36304a;

    }

    
    #observacoes {
        width: 100%;
        height: 120px;
    }
    
    .wrapEnviar{
        text-align: end;
    }

    #Enviar{
    font-family: 'Rubik';
    font-size: 14px;
    font-style: normal;
    align-self: end;
    font-weight: 600;
    background: #7CFC00;
    border: transparent;
    border-radius: 10px;
    width: 80px;
    height: 30px;
    color: black;
    cursor: pointer;
    margin: 0px;

    }

    /* FIM DOBRA FICHA */
</style>

<body>

<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

    <header class="headerInfos">
        <a href="../views/perfil.php?idPerfil=10" target="_blank" >
            <h2>Aluno: Jefferson Romero</h2>
        </a>

        <a href="index.php?idUsuarios=2" class="btIndex" target="_blank">Fichas de treino do aluno</a>
    </header>


    <!-- INICIO DOBRA EXERCICIOS -->
    <!-- INICIO BLOCO DE CÓDIGO IMUTÁVEL -->
    <main>
    <div class="showExercicios"> 
    
    <?php  

    include_once 'src/conexao.php';

    $dbh = Conexao::getConexao();

    $query = "SELECT * FROM olimpo.exercicios";

    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $exercicios = $stmt->fetchAll();


    foreach($exercicios as $exercicio): ?>
     
    <form action="" method="GET">
        <div class="wrapperBloco">
            <div class="blocoExercicio" id="<?=$exercicio['idExercicios']?>">
                <div class="blocoExercicio_content">
                        <h1><?=$exercicio['nome']?></h1>
                        <input type="hidden" name="id" value="<?=$exercicio['idExercicios']?>">
                        <input type="hidden" name="nome" value="<?=$exercicio['nome']?>"> 
                        <input type="hidden" name="acao" value="addExercicio">
                    <a href="detailsExercicio.php?id=<?=$exercicio['idExercicios']?>" target="_blank">
                    <!-- essa imagem tem 200x150 -->
                    <?php

                        // $extensao = $exercicio['nome_arq'];
                        // $extensao = pathinfo($extensao, PATHINFO_EXTENSION);

                        // if($extensao == 'mp4' || $extensao == 'mov' || $extensao == 'webm'): ?>
                        <!-- <video class="videoAnimacao" autoplay muted loop> -->
                            <!-- <source src="animacoes/"> -->
                        <!-- </video> -->
                        <?php   //else: ?>
                            
                            <img class="videoAnimacao" src="../exercicios/animacoes/<?=$exercicio['nome_arq']?>">



                        <?php
                        //endif;
                        ?>         
                    </a>
                    <div class="blocoExercicio_form">
                        <label>Modo</label>:&nbsp;
                        <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep"><label>Repetições</label>
                        <input type="radio" name="modo" value="TEMPO"><label>Tempo</label>
                        <div class="blocoExercicio_form_seriesRep">
                            <label>Series:</label><input type="number" id="series" name="series" value="3">&nbsp;
                            <label id="repeticoes">Rep:</label><input type="number"  name="repeticoes" value="12">
                        </div>
                        <div class="blocoExercicio_form_intervaloCarga">
                            <label>Carga: </label><input type="number" id="carga" name="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                            <label id="intervaloSeries">Desc</label><input type="number"  name="intervaloSeries" value="30">s
                    </div>
                        <br>
                    </div>
                    <div class="tipoExercicio">
                        <?=$exercicio['ativ_fisica']?>
                    </div>
                    <div>
                        <button type="submit" id="addExercicio">+</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
    endforeach;
    ?>


    <!-- FIM BLOCO DE CÓDIGO IMUTÁVEL -->
    <!-- FIM DOBRA EXERCICIOS -->




    <!-- INCIO PARTE COLADA -->
    <div class="wrapper_preFicha">
        <form action="addEditFicha.php" method="POST">
            <label class="label_tituloFicha">Título da ficha de treino: </label><input type="text" name="tituloFicha" value="<?=$_SESSION['cabecalhoFichaEdit']['titulo']?>" id="tituloFicha" autofocus><br>
            
            <div class="preFicha">
                <div id="barra">
                    <table id="tabelaExe">
                        <thead>
                            <td width="50%"><span class="primeirotd">Nome<span></td>
                            <td width="10%">Series</td>
                            <td width="10%">Rep</td>
                            <td width="10%">Carga</td>
                            <td width="10%">Desc</td>
                            <td width='10%'></td>
                        </thead>
                    </table>

                    <div id="barraExe">
                        <?php

                        $i = 0;

                        foreach($_SESSION['sessaoFicha'] as $dados){

            
                            echo "<table width='100%' >
                                        <tr>
                                            <td width='50%' ><span class='primeirotd'>".$dados['nome']."</span></td>
                                            <td width='10%'>".$dados['series']."</td>
                                            <td width='10%'>".$dados['repeticoes'];
                                            $dados['modo'] == "TEMPO" ? $printModo = "s" : $printModo = ""; echo $printModo."</td>
                                            <td width='10%'>".$dados['carga']."kg</td>
                                            <td width='10%'>".$dados['intervaloSeries']."s</td>
                                            <td width='10%' align='center'><a class='remover' href='?acao=excluir&id=$i' title='remover'>X</a></td>
                                        </tr>
                                    </table>
                                    ";
                                        $i++;
                                    }
                                    ?>
                    </div>
                </div>

                                    <!-- INICIO DOBRA CABEÇALHO DA FICHA -->

                <div class="cabecalhoFicha">
                    <div class="wrapper_dados_ficha">
                        <fieldset>
                            <label for="intervaloExercicios" class="labelIntervaloExe">Intervalo entre exercícios: </label><input type="number" name="intervaloExercicios" value="<?=$_SESSION['cabecalhoFichaEdit']['descExercicios']?>"><Strong class="labelIntervaloExe">s</Strong><br><br>
                            <label for="observacoes" class="labelObs">Observações <textarea name="observacoes" id="observacoes"><?=$_SESSION['cabecalhoFichaEdit']['observacoes']?></textarea><br>
                            <input type="hidden" id="resultObs" name="resultObs">
                            <div class="wrapEnviar">
                                <input type="submit" value="Enviar" id="Enviar">
                            <div>
                        </fieldset>
                    </div>
                </div>
        </form>

    </div>
    </div>
    </main>
    <!-- FIM PARTE COLADA -->


    <!-- FIM DOBRA DA BARRA DE DADOS DA FICHA -->

</body>

<script>

    document.getElementById('resultObs').value = document.getElementById('observacoes').value;

    document.getElementById('radioRep').checked = "checked";

</script>

</html>
