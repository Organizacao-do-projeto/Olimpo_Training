<?php
session_start();

!empty($_POST['idFichas_treino']) ? $idFichas_treino = $_POST['idFichas_treino'] : $idFichas_treino = 0 ;


//fazendo a conexão com o banco de dados
include 'src/conexao.php';

$dbhft_exe = Conexao::getConexao();
$dbhfichas_treino = Conexao::getConexao();

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

$testeDoFetch = $cabecalhofichas_treino;




        
if(!isset($_SESSION['sessaoFicha']) || empty($_SESSION['sessaoFicha'])) {
    $_SESSION['sessaoFicha'] = array();

    foreach($exercicios as $exercicio){
        
        $_SESSION['sessaoFicha'][] = [
            "id" => $exercicio['idExercicios'],
            "nome" => "Burpee"/*$exercicio["nome"]*/,
            "modo" => $exercicio["modo"],
            "series" => $exercicio["series"],
            "repeticoes" => $exercicio["repeticoes"],
            "carga" => $exercicio["carga"],
            "intervaloSeries" => $exercicio["descSeries"]
            
        ];
        
    };

}





// $_SESSION['sessaoFicha'] = [];

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

    .blocoExercicio {
        display: flex;
        flex-direction: column;
        width: 280px;
        height: 360px;
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
        width: 80%;
        height: 100%;
        flex-wrap: wrap;
        overflow: auto;

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
    }

    .wrapper_dados_ficha {
        height: 100%;
    }

    .wrapper_dados_ficha fieldset {
        height: 100%;
    }

    #observacoes {
        width: 300px;
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
    <!-- INICIO DOBRA EXERCICIOS -->
    <!-- INICIO BLOCO DE CÓDIGO IMUTÁVEL -->

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

    <div class="blocoExercicio" id="3">
        <div class="blocoExercicio_content">
            <div class="blocoExercicio_content_title">
                <h1>Agachamento búlgaro</h1>
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


    <?php for($i = 0; $i <= 5; $i++){?>
    <div class="blocoExercicio" id="4">
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
    <?php }; ?>
    <!-- FIM BLOCO DE CÓDIGO IMUTÁVEL -->
    <!-- FIM DOBRA EXERCICIOS -->

    
    <!-- DOBRA DA BARRA DE DADOS DA FICHA -->
    <div class="wrapper_preFicha">
        <form action="addEditFicha.php" method="POST">
            Título da ficha de treino: <input type="text" name="tituloFicha" value="<?=$_SESSION['cabecalhoFichaEdit']['titulo']?>" id="tituloFicha" autofocus><br>
            
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

                        forEach($_SESSION['sessaoFicha'] as $dados){

            
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
                                    //<td width='10%'><a href='?acao=excluir?id=$i'><button>X".$dados['intervaloSeries']."</button></td>
                                    ?>
                    </div>
                </div>

                <div class="cabecalhoFicha">
                    <div class="wrapper_dados_ficha">
                        <fieldset>
                            Intervalo entre exercícios <input type="number" name="intervaloExercicios" value="<?=$_SESSION['cabecalhoFichaEdit']['descExercicios']?>">s<br>
                            Observações <textarea name="observacoes" id="observacoes" placholder="Digite aqui sua observação!"><?=$_SESSION['cabecalhoFichaEdit']['observacoes']?></textarea><br>
                            <input type="hidden" id="resultObs" name="resultObs">
                            <input type="hidden" name="result" id="result">
                            <input type="submit" value="Enviar" id="Enviar">
                        </fieldset>
                    </div>
                </div>
        </form>

    </div>
    </div>

    <!-- FIM DOBRA DA BARRA DE DADOS DA FICHA -->
<?php
 //limitador temporário
// $_SESSION['sessaoFicha'] = [];
?>
</body>

<script>
    // dados de entrada
    //idFicha, titulo da ficha, data criação(melhor pegar no php), observações, intervalo entre exercicios, idPersonal, idAluno

    //idExercicio, series, repeticoes, intervalo entre series, carga, modo


    //falta listar exercicios(com jquery), adicionar ao banco de dados  

    let primExercicio = document.getElementById("1");

    let exercicioUm = {
        id: 1,
        nome: "Flexao",
        series: 3,
        repeticoes: 30,
        intervaloSeries: 45,
        carga: 10,
        modo: "TEMPO"
    }


    let ficha = [
        exercicioUm
    ]

    // ficha.splice(3,1);



    let btaddExercicio = document.getElementById("addExercicio");
    let linkTeste = document.getElementById("linkTeste");

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

        dadosAdd = {
            nome: nome,
            id: parseInt(id),
            series: parseInt(series),
            repeticoes: parseInt(repeticoes),
            intervaloSeries: parseInt(intervaloSeries),
            carga: parseInt(carga),
            modo: modo
        }


        ficha.push(
            dadosAdd
            // {
            //     nome: nome,
            //     id: parseInt(id),
            //     series: parseInt(series),
            //     repeticoes: parseInt(repeticoes),
            //     intervaloSeries: parseInt(intervaloSeries),
            //     carga: parseInt(carga),
            //     modo: modo
            // }
        );

        window.location.href = `?acao=addExercicio&nome=${nome}&id=${id}&series=${series}&repeticoes=${repeticoes}&intervaloSeries=${intervaloSeries}&carga=${carga}&modo=${modo}`;
        

        atualizaFicha();
    }






    let barra = document.getElementById("barra");
    let barraExe = document.getElementById("barraExe");
    let tabelaExe = document.getElementById("tabelaExe");
    barra.style.backgroundColor = 'red';


    let naldo;

    function atualizaFicha() {
        naldo = "";
        for (let i = 0; i <= (ficha.length - 1); i++) {

            naldo += `  <table width='100%' >
                            <tr>
                                <td width="50%">${ficha[i].nome}</td>
                                <td width="10%">${ficha[i].series}</td>
                                <td width="10%">${ficha[i].repeticoes}</td>
                                <td width="10%">${ficha[i].carga}</td>
                                <td width="10%">${ficha[i].intervaloSeries}</td>
                            </tr>
                        </table>
                      `;
        }

        // colocar em uma tabela
        // barraExe.innerHTML = naldo;
    }


    atualizaFicha();

    function getResult() {
        return JSON.stringify(ficha);
    }


    document.getElementById('resultObs').value = document.getElementById('observacoes').value;
    document.getElementById("result").value = getResult();

    document.getElementById('radioRep').checked = "checked";
    document.getElementsByClassName('radioRep').checked = "checked";

</script>

</html>
