
<?php
session_start();

if(!isset($_SESSION['sessaoFicha']) || empty($_SESSION['sessaoFicha'])) {
    $_SESSION['sessaoFicha'] = array();

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

};


?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Criar ficha de treino</title>
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

    .blocoExercicio {
        display: flex;
        flex-direction: column;
        width: 280px;
        height: 360px;
        background-color: rgb(7, 120, 225);
        border-radius: 5%;
        overflow: hidden;
        align-items: center;
        color: #fff;
    }

    .blocoExercicio_content {
        text-align: center;
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

    #addExercicio {
        margin-top: 5px;
        width: 97%;
        height: 28px;
        border-radius: 15%;
        background-color: rgb(44, 223, 44);
        cursor: pointer;
    }

    /* FIM DOBRA EXERCICIOS */


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
    <form action="" method="GET">
        <div class="blocoExercicio" id="3">
            <div class="blocoExercicio_content">
                <div class="blocoExercicio_content_title">
                    <h1>Agachamento búlgaro</h1>
                    <input type="hidden" name="nome" value="Agachamento búlgaro"> 
                    <input type="hidden" name="id" value="3">
                    <input type="hidden" name="acao" value="addExercicio">
                </div>
                <a href="detalhesExercicio.php?id=3" target="_blank">
                <img src="https://i.pinimg.com/originals/cf/69/7a/cf697a042d827afe23090ad23af1c181.gif">
                </a>
                <br>
            </div>
            <div class="blocoExercicio_form">
                <label>Modo</label>:&nbsp;
                
                <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep"><label>Repeticoes</label>
                <input type="radio" name="modo" value="TEMPO"><label>Tempo</label>
                <span class="blocoExercicio_form_seriesRep">
                <label>Series</label><input type="number" id="series" name="series" value="3">&nbsp;
                <label>Rep</label><input type="number" id="repeticoes" name="repeticoes" value="12">
                </span>
                <span class="blocoExercicio_form_intervaloCarga">
                <label>Carga </label><input type="number" id="carga" name="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Intervalo </label><input type="number" id="intervaloSeries" name="intervaloSeries" value="30">s
                </span>
                <br>
            </div>
            <button type="submit" id="addExercicio">+</button>
        </div>
    </form>
    
    <form action="" method="GET">
        <div class="blocoExercicio" id="3">
            <div class="blocoExercicio_content">
                <div class="blocoExercicio_content_title">
                    <h1>Polichinelo</h1>
                    <input type="hidden" name="nome" value="Polichinelo"> 
                    <input type="hidden" name="id" value="3">
                    <input type="hidden" name="acao" value="addExercicio">
                </div>
                <a href="detalhesExercicio.php?id=3" target="_blank">
                <img src="https://www.hipertrofia.org/blog/wp-content/uploads/2020/05/polichinelos-execu%C3%A7%C3%A3o-1.gif">
                </a>
                <br>
            </div>
            <div class="blocoExercicio_form">
                <label>Modo</label>:&nbsp;
                
                <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep"><label>Repeticoes</label>
                <input type="radio" name="modo" value="TEMPO"><label>Tempo</label>
                <span class="blocoExercicio_form_seriesRep">
                <label>Series</label><input type="number" id="series" name="series" value="3">&nbsp;
                <label>Rep</label><input type="number" id="repeticoes" name="repeticoes" value="12">
                </span>
                <span class="blocoExercicio_form_intervaloCarga">
                <label>Carga </label><input type="number" id="carga" name="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Intervalo </label><input type="number" id="intervaloSeries" name="intervaloSeries" value="30">s
                </span>
                <br>
            </div>
            <button type="submit" id="addExercicio">+</button>
        </div>
    </form>

    <form action="" method="GET">
        <div class="blocoExercicio" id="3">
            <div class="blocoExercicio_content">
                <div class="blocoExercicio_content_title">
                    <h1>Flexão diamante</h1>
                    <input type="hidden" name="nome" value="Flexão diamante"> 
                    <input type="hidden" name="id" value="3">
                    <input type="hidden" name="acao" value="addExercicio">
                </div>
                <a href="detalhesExercicio.php?id=3" target="_blank">
                <img src="https://i0.wp.com/homemnoespelho.com.br/wp-content/uploads/2021/07/Homem-No-Espelho-Flexao-de-braco-diamante.gif?resize=480%2C270&ssl=1">
                </a>
                <br>
            </div>
            <div class="blocoExercicio_form">
                <label>Modo</label>:&nbsp;
                
                <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep"><label>Repeticoes</label>
                <input type="radio" name="modo" value="TEMPO"><label>Tempo</label>
                <span class="blocoExercicio_form_seriesRep">
                <label>Series</label><input type="number" id="series" name="series" value="3">&nbsp;
                <label>Rep</label><input type="number" id="repeticoes" name="repeticoes" value="12">
                </span>
                <span class="blocoExercicio_form_intervaloCarga">
                <label>Carga </label><input type="number" id="carga" name="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Intervalo </label><input type="number" id="intervaloSeries" name="intervaloSeries" value="30">s
                </span>
                <br>
            </div>
            <button type="submit" id="addExercicio">+</button>
        </div>
    </form>

    <!-- ############# EXRCICIOS FUNFANDO COM ESTRUTURA PHP ################### -->
    <form action="" method="GET">
        <div class="blocoExercicio" id="3">
            <div class="blocoExercicio_content">
                <div class="blocoExercicio_content_title">
                    <h1>Agachamento búlgaro</h1>
                    <input type="hidden" name="nome" value="Agachamento búlgaro"> 
                    <input type="hidden" name="id" value="3">
                    <input type="hidden" name="acao" value="addExercicio">
                </div>
                <a href="detalhesExercicio.php?id=3" target="_blank">
                <img src="https://i.pinimg.com/originals/cf/69/7a/cf697a042d827afe23090ad23af1c181.gif">
                </a>
                <br>
            </div>
            <div class="blocoExercicio_form">
                <label>Modo</label>:&nbsp;
                
                <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep"><label>Repeticoes</label>
                <input type="radio" name="modo" value="TEMPO"><label>Tempo</label>
                <span class="blocoExercicio_form_seriesRep">
                <label>Series</label><input type="number" id="series" name="series" value="3">&nbsp;
                <label>Rep</label><input type="number" id="repeticoes" name="repeticoes" value="12">
                </span>
                <span class="blocoExercicio_form_intervaloCarga">
                <label>Carga </label><input type="number" id="carga" name="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                <label>Intervalo </label><input type="number" id="intervaloSeries" name="intervaloSeries" value="30">s
                </span>
                <br>
            </div>
            <button type="submit" id="addExercicio">+</button>
        </div>
    </form>
    <!-- ############# EXRCICIOS FUNFANDO COM ESTRUTURA PHP ################### -->

    <?php for($i = 0; $i <= 5; $i++){?>
        <form action="" method="GET">
            <div class="blocoExercicio" id="4">
                <div class="blocoExercicio_content">
                    <div class="blocoExercicio_content_title">
                        <h1>Burpee</h1>
                        <input type="hidden" name="nome" value="Burpee"> 
                        <input type="hidden" name="id" value="4">
                        <input type="hidden" name="acao" value="addExercicio">
                    </div>
                    <a href="detalhesExercicio.php?id=4" target="_blank">
                    <img src="https://media.tenor.com/u2-VJiigKCkAAAAM/exercise-jump.gif">
                    </a>
                    <br>
                </div>
                <div class="blocoExercicio_form">
                    <label>Modo</label>:&nbsp;
                    
                    <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep"><label>Repeticoes</label>
                    <input type="radio" name="modo" value="TEMPO"><label>Tempo</label>
                    <span class="blocoExercicio_form_seriesRep">
                    <label>Series</label><input type="number" id="series" name="series" value="3">&nbsp;
                    <label>Rep</label><input type="number" id="repeticoes" name="repeticoes" value="12">
                    </span>
                    <span class="blocoExercicio_form_intervaloCarga">
                    <label>Carga </label><input type="number" id="carga" name="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                    <label>Intervalo </label><input type="number" id="intervaloSeries" name="intervaloSeries" value="30">s
                    </span>
                    <br>
                </div>
                <button type="submit" id="addExercicio">+</button>
            </div>
        </form>
        <?php }; ?>
    <!-- FIM BLOCO DE CÓDIGO IMUTÁVEL -->
    <!-- FIM DOBRA EXERCICIOS -->


    <!-- DOBRA DA BARRA DE DADOS DA FICHA -->
    <div class="wrapper_preFicha">
        <form action="addFicha.php" method="POST">
            <label class="label_tituloFicha">Título da ficha de treino: </label><input type="text" name="tituloFicha" value="Treino A" id="tituloFicha" autofocus><br>
            
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
                            <label for="intervaloExercicios" class="labelIntervaloExe">Intervalo entre exercícios: </label><input type="number" name="intervaloExercicios" value="45"><Strong class="labelIntervaloExe">s</Strong><br><br>
                            <label for="observacoes" class="labelObs">Observações <textarea name="observacoes" id="observacoes"></textarea><br>
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

    <!-- FIM DOBRA DA BARRA DE DADOS DA FICHA -->
</body>

<script>

    document.getElementById('resultObs').value = document.getElementById('observacoes').value;
    document.getElementById('radioRep').checked = "checked";
    
</script>

</html>
