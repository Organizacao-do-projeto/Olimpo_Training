
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
        width: 300px;
        height: 50px;
        padding: 5px 0px;
        background-color: rgb(223,172,42);
        color: black;
        text-align: center;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 600;
        border-radius: 3px;
        
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
        height: 290px;
        width: 100%;
        position: fixed;
        bottom: 0;
        Background-color: #fff;


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
        font-weight: bold;

    }

    #barraExe {
        width: 100%;
        height: 100%;
    }

    #exerciciosAdd {
        width: 100%;
        height: 100%;

    }

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

    #observacoes {
        width: 100%;
        height: 130px;
    }

    .row_exercicio {
        width: 100%;
        height: 30px;
    }

    .row_exercicio div {
        display: inline-block;
    }

    .row_exercicio_titulo {
        width: 60%;
    }

    .row_exercicio_complements {
        width: 9%;

    }

.remover{

  background-color: black;
  color: white;
  padding: 1px 20px;
  text-decoration: none;
  border-radius: 15%;

}

    /* FIM DOBRA FICHA */
</style>

<body>

<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

    <header class="headerInfos">
        <a href="../views/perfil.php?idPerfil=10" target="_blank" >
            <h2>Aluno: Jefferson Romero</h2>
        </a>

        <a href="index.php?idUsuarios=2" class="btIndex" target="_blank">Visualizar fichas de treino deste usuário.</a>
    </header>


    <!-- INICIO DOBRA EXERCICIOS -->
    <!-- INICIO BLOCO DE CÓDIGO IMUTÁVEL -->
    <main>
    <div class="showExercicios">    
    <div class="blocoExercicio" id="1">
        <div class="blocoExercicio_content">
            <div class="blocoExercicio_content_title">
                <h1>Flexão diamante</h1>
            </div>
            <a href="detalhesExercicio.php?id=1" target="_blank">
            <img src="https://i0.wp.com/homemnoespelho.com.br/wp-content/uploads/2021/07/Homem-No-Espelho-Flexao-de-braco-diamante.gif?resize=480%2C270&ssl=1">
            </a>
            <br>
        </div>
        <div class="blocoExercicio_form">
            Modo:&nbsp;
            <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep">Repeticoes
            <input type="radio" name="modo" value="TEMPO">Tempo
            <span class="blocoExercicio_form_seriesRep">
                Series<input type="number" id="series" value="3">&nbsp;
                Rep<input type="number" id="repeticoes" value="12">
            </span>
            <span class="blocoExercicio_form_intervaloCarga">
                Carga <input type="number" id="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                Intervalo <input type="number" id="intervaloSeries" value="30">s
            </span>
            <br>
        </div>
        <button onclick="addExercicio(this)" id="addExercicio">+</button>
    </div>

    <div class="blocoExercicio" id="2">
        <div class="blocoExercicio_content">
            <div class="blocoExercicio_content_title">
                <h1>Polichinelo</h1>
            </div>
            <a href="detalhesExercicio.php?id=1" target="_blank">
            <img src="https://www.hipertrofia.org/blog/wp-content/uploads/2020/05/polichinelos-execu%C3%A7%C3%A3o-1.gif">
            </a>
            <br>
        </div>
        <div class="blocoExercicio_form">
            Modo:&nbsp;
            <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep">Repeticoes
            <input type="radio" name="modo" value="TEMPO">Tempo
            <span class="blocoExercicio_form_seriesRep">
                Series<input type="number" id="series" value="3">&nbsp;
                Rep<input type="number" id="repeticoes" value="12">
            </span>
            <span class="blocoExercicio_form_intervaloCarga">
                Carga <input type="number" id="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                Intervalo <input type="number" id="intervaloSeries" value="30">s
            </span>
            <br>
        </div>
        <button onclick="addExercicio(this)" id="addExercicio">+</button>
    </div>

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
                <a href="detalhesExercicio.php?id=1" target="_blank">
                <img src="https://i.pinimg.com/originals/cf/69/7a/cf697a042d827afe23090ad23af1c181.gif">
                </a>
                <br>
            </div>
            <div class="blocoExercicio_form">
                Modo:&nbsp;
                
                <input type="radio" name="modo" value="REPETICOES" checked="checked" class="radioRep" id="radioRep">Repeticoes
                <input type="radio" name="modo" value="TEMPO">Tempo
                <span class="blocoExercicio_form_seriesRep">
                    Series<input type="number" id="series" name="series" value="3">&nbsp;
                    Rep<input type="number" id="repeticoes" name="repeticoes" value="12">
                </span>
                <span class="blocoExercicio_form_intervaloCarga">
                    Carga <input type="number" id="carga" name="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                    Intervalo <input type="number" id="intervaloSeries" name="intervaloSeries" value="30">s
                </span>
                <br>
            </div>
            <button type="submit" id="addExercicio">+</button>
        </div>
    </form>
    <!-- ############# EXRCICIOS FUNFANDO COM ESTRUTURA PHP ################### -->

    <?php for($i = 0; $i <= 5; $i++){?>
    <div class="blocoExercicio" id="1">
        <div class="blocoExercicio_content">
            <div class="blocoExercicio_content_title">
                <h1>Burpee</h1>
            </div>
            <a href="detalhesExercicio.php?id=1" target="_blank">
            <img src="https://media.tenor.com/u2-VJiigKCkAAAAM/exercise-jump.gif">
            </a>
            <br>
        </div>
        <div class="blocoExercicio_form">
            Modo:&nbsp;
            <input type="radio" name="modo" value="REPETICOES" checked="checked" id="radioRep">Repeticoes
            <input type="radio" name="modo" value="TEMPO">Tempo
            <span class="blocoExercicio_form_seriesRep">
                Series<input type="number" id="series" value="3">&nbsp;
                Rep<input type="number" id="repeticoes" value="12">
            </span>
            <span class="blocoExercicio_form_intervaloCarga">
                Carga <input type="number" id="carga" value="0">kg &nbsp;&nbsp;&nbsp;&nbsp;
                Intervalo <input type="number" id="intervaloSeries" value="30">s
            </span>
            <br>
        </div>
        <button onclick="addExercicio(this)" id="addExercicio">+</button>
        </div>
        <?php }; ?>
    <!-- FIM BLOCO DE CÓDIGO IMUTÁVEL -->
    <!-- FIM DOBRA EXERCICIOS -->

    
    
    <!-- DOBRA DA BARRA DE DADOS DA FICHA -->
    <div class="wrapper_preFicha">
        <form action="addFicha.php" method="POST">
            Título da ficha de treino: <input type="text" name="tituloFicha" value="Treino A" id="tituloFicha" autofocus><br>
            
            <div class="preFicha">
                <div id="barra">
                    <table width="100%" id="tabelaExe" border="1px">
                        <tr>
                            <td width="50%">Nome</td>
                            <td width="10%">Series</td>
                            <td width="10%">Rep</td>
                            <td width="10%">Carga</td>
                            <td width="10%">Desc</td>
                            <td width='10%'></td>
                        </tr>
                    </table>

                    <div id="barraExe">
                        <?php

                        $i = 0;

                        foreach($_SESSION['sessaoFicha'] as $dados){

            
                            echo "<table width='100%' >
                                    <tr>
                                        <td width='50%'>".$dados['nome']."</td>
                                        <td width='10%'>".$dados['series']."</td>
                                        <td width='10%'>".$dados['repeticoes'];
                                        $dados['modo'] == "TEMPO" ? $printModo = "s" : $printModo = ""; echo $printModo."</td>
                                        <td width='10%'>".$dados['carga']."kg</td>
                                        <td width='10%'>".$dados['intervaloSeries']."s</td>
                                        <td width='10%'><a class='remover' href='?acao=excluir&id=$i'>X</a></td>
                                        </tr>
                                        </table>
                                        ";
                                        $i++;
                                    }
                                    ?>
                    </div>
                </div>

                <div class="cabecalhoFicha">
                    <div class="wrapper_dados_ficha">
                        <fieldset>
                            Intervalo entre exercícios <input type="number" name="intervaloExercicios" value="45">s<br>
                            Observações <textarea name="observacoes" id="observacoes"></textarea><br>
                            <input type="hidden" id="resultObs" name="resultObs">
                            <input type="submit" value="Enviar" id="Enviar">
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

    function addExercicio(e) {
        let divPai = e.parentElement;
        let id = divPai.id;

        let divContent = divPai.children[0];
        let nome = divContent.children[0].children[0].innerText;

        divForm = divPai.children[1];

        let modo;
        divForm.children[0].checked ? modo = divForm.children[0].value : modo = divForm.children[1].value

        let series = divForm.children[2].children[0].value;
        let repeticoes = divForm.children[2].children[1].value;
        let intervaloSeries = divForm.children[3].children[1].value;
        let carga = divForm.children[3].children[0].value;

        window.location.href = `?acao=addExercicio&nome=${nome}&id=${id}&series=${series}&repeticoes=${repeticoes}&intervaloSeries=${intervaloSeries}&carga=${carga}&modo=${modo}`;

    }

    document.getElementById('resultObs').value = document.getElementById('observacoes').value;
    document.getElementById('radioRep').checked = "checked";
    
</script>

</html>
