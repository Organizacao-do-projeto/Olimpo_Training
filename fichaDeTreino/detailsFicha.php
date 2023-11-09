<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boot.css">
    <title>Detalhes ficha de treino</title>
</head>
<style>

/* INCIO DOBRA GERAL */
.flex-row{
    display: flex;
    flex-direction: row;
}

.center_all{
    display: flex;
    justify-content: center;
    align-items: center;
}

.background_ficha{
    width: 100%;
    height: 100%;
    /* background: linear-gradient(45deg, green , gold); */
    /* background: linear-gradient(135deg, rgb(255, 168, 168) 10%, rgb(252, 255, 0) 100%); */
    background: linear-gradient(190deg, rgb(255, 230, 109) 11.2%, rgb(87, 232, 107) 100.2%);
}

/* FIM DOBRA GERAL */

 /* INICIO DOBRA FICHA */

.ficha{

    width: 80%;
    /* background: #fff; */
    margin-top: 130px;
    margin-bottom: 130px;
}

.wrapper_data{
    margin:0 auto;
    display: flex;
    justify-content: end;
}

.data_criacao{
    display: flex;
    justify-content: end;
    background-color: #36304a;
    color: #fff;
    font-family: 'Rubik';
    font-size: 25px;
    font-style: normal;
    font-weight: 400;
    line-height: 110%;
    letter-spacing: -1.625px;
    width: 165px;
    margin-right: 18px;
    border-radius: 10px 10px 0 0 ;
    
    
}

.data_criacao span{
    width: 100%;
    text-align: center;

}

.ficha_content{
    background: #fff;
    border-radius: 15px 15px;

}

/* FIM DOBRA FICHA */

/* INICIO DOBRA CABEÇALHO */

.cabecalhoFicha{
    min-height: 200px; 
    background-color: #f4f6fc; 
    border-radius: 10px 10px 0 0; 
}


.cabecalhoFicha h1{
    margin: 0;
    color: black;
    font-family: 'Rubik';
    font-size: 75px;
    font-style: normal;
    font-weight: 500;
    line-height: 110%;
    letter-spacing: -1.625px;
    margin-left: 40px;
    margin-bottom: 20px;
}

.botoesCabecalho{
    margin-left: 50px;
    margin-right: 10px;
    justify-content: space-between;
    font-family: 'Rubik';
    font-size: 19px;
    font-style: normal;
    font-weight: 400;
    
}

.botoesCabecalho span{
    color: black;
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


/* FIM DOBRA CABEÇALHO */

/* INICIO DOBRA TABELA */

.container_table{
    background: #fff;
}

.container_table a{
    text-decoration: none;
    color: black;
}

.container_table th,td{
    margin-left: 50px;
    margin-right: 10px;
    font-family: 'Rubik';
    font-size: 20px;
    font-style: normal;
    font-weight: 800;
}


.container_table th{
    background: #36304a;
    color: #fff;
    height: 45px;
    padding: 8px;
}


table {
    border-collapse: collapse;
  border-radius: 15px;
  overflow: hidden;
}

td{
    color: black;
    width: 200px;
    max-width: 200px;
    height: 150px;
    max-height: 150px;
    text-align: center;
    word-break: break-word;
    
}


.animacao_exercicio{
    width: 200px;
    max-width: 200px;
    height: 150px;
    max-height: 150px;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 200px 150px;
}


 /* FIM DOBRA TABELA */

a{
    text-decoration: none;
}

/* FIM DOBRA TABELA */


/* INICIO DOBRA INFOS PERSONAL */

hr {
  border: borde;
  clear:both;
  display:block;
  /* width: 100%;                */
  background-color: black;
  height: 1px;
}

.infoPersonal{
    background: #f4f6fc;
}

.infoPersonal h1{
    margin-left: 50px;
    margin-right: 10px;
    font-family: 'Rubik';
    font-size: 19px;
    font-style: normal;
    font-weight: 400;
}

.infosPersonal_content{
    justify-content: space-between;
    margin-left: 30px;
    margin-bottom: 30px;
    margin-right: 30px;
    margin-top: 0px;
}

.dadosPerfilPersonal{
    display: flex;
    flex-direction: row;
    margin: 0 auto;
    text-align: center;
    align-items: center;
    justify-content: start;
}

.dadosPerfilPersonal{
    margin-right: 10px;
    font-family: 'Rubik';
    font-size: 16px;
    font-style: normal;
    font-weight: 700;
}

#fotoUsuario {
    border-radius: 50%;
    box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
    padding: 5px;
    margin: 20px;
    width: 100px;
    height: 100px;
    border: 5px solid rgba(253, 237, 15, 0.3);
    transition: all 0.3s ease-out;
}

.outras_infos h2{
    margin-right: 10px;
    font-family: 'Rubik';
    font-size: 19px;
    font-style: normal;
    font-weight: 700;
}

.outras_infos p{
    margin-top: 10px;
    margin-right: 10px;
    font-family: 'Rubik';
    font-size: 16px;
    font-style: normal;
    font-weight: 400;
}

#content_observacoes{
    border: 2.5px solid black;
    width: 360px;
    height: 160px;
    overflow: auto;
    border-radius: 5%;
    word-break: break-word;
}

#content_observacoes>span{
    padding: 15px;
}

/* FIM DOBRA INFOS PERSONAL */

/* INCIO DOBRA PDF */

.gerarPDF{
    display: flex;
    justify-content: center;
}

.gerarPDF button{
    font-family: 'Rubik';
    font-size: 14px;
    font-style: normal;

    font-weight: 600;
    background: #7CFC00;
    border: transparent;
    border-radius: 10px;
    width: 100px;
    height: 40px;
    color: black;
    cursor: pointer;
    margin: 12px;
}

/* FIM DOBRA PDF */

</style>
<body>
    <?php

$idFichas_treino = $_POST['idFichas_treino'];
// echo "O número que choegou no teste foi: ".$_POST['teste'];
// $idFichas_treino = 70;

require_once 'src/conexao.php';


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

    $path = getenv('DOCUMENT_ROOT');
    include_once $path."/Olimpo_Training/layouts/header.php";
        
?>

<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

<main class="background_ficha center_all">
    <section class="ficha">
        <div class="wrapper_data">
            <div class="data_criacao"><span><?php echo date("d/m/Y", strtotime($cabecalhofichas_treino['data_criacao']));?><span>

            </div>
        </div>

        <div class="ficha_content">
            <article class="cabecalhoFicha">
                <br><br>
                <h1><?=$cabecalhofichas_treino['titulo']?></h1>

                <div class='botoesCabecalho flex-row'>
                    <span id="spanDesc_exercicios">Desc/exercicio: <?=$cabecalhofichas_treino['descExercicios']?>s</span>

                    <form action="editFicha.php" method="POST">
                        <input type="hidden" value="<?=$cabecalhofichas_treino['idFichas_treino']?>" name="idFichas_treino">
                        <button title="Editar" type="submit" id="btEdit"><img src="https://cdn-icons-png.flaticon.com/512/1827/1827933.png" width="20px" height="17px"  alt="Editar" ></button>   
                    </form>
                    <form action="deleteFicha.php" method="POST">
                        <input type="hidden" value="<?=$cabecalhofichas_treino['idFichas_treino']?>" name="idFichas_treino">
                        <button title="Excluir" type="submit" onclick="return confirm('Tem certeza que deseja excluir sua ficha de treino?')" id="btExcluir"><img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/61/Cross_icon_%28white%29.svg/120px-Cross_icon_%28white%29.svg.png" width="16px" height="17px"  alt="Excluir"></button>
                    </form>
                </div>
            </article>

            <!-- INCIO DOBRA TABELA -->
            <article class="container_table">
                <table width='100%' >
                        <thead>
                            <!-- o de baixo vai puxar o url da animação -->
                            <th width='25%'>Execução</th>
                            <th width='25%'>Nome</th>
                            <th width='10%'>Series</th>
                            <th class='x_auxiliar'></th>
                            <th width='10%'>Repetições</th>
                            <th width='10%'>Carga</th>
                            <th width='10%'>Desc/Series</th>
                        </thead>
                <?php
                foreach($exercicios as $dados):
                
                    $idExercicios = $dados['idExercicios'];

                    $dbhExercicios = Conexao::getConexao();
        
                    $queryExercicios = "SELECT * FROM olimpo.exercicios WHERE idExercicios = :idExercicios";
                    
                    $stmtExercicios = $dbhExercicios->prepare($queryExercicios);
                    $stmtExercicios->bindParam(":idExercicios",$idExercicios);
                    $stmtExercicios->execute();
                    $resultTableExercicios = $stmtExercicios->fetch();
                
                ?>
            

                        <tr>
                            <!-- o de baixo vai puxar o url da animação -->
                            <td width='25%'><a target="_blank" href="../exercicios/detailsExercicio.php?id=<?=$dados['idExercicios']?>"><!--<div class='animacao_exercicio'></div>--><img src="../exercicios/animacoes/<?=$resultTableExercicios['nome_arq']?>" class='animacao_exercicio'></a></td>
                            <td width='25%' ><a target="_blank" href="../exercicios/detailsExercicio.php?id=<?=$dados['idExercicios']?>"><?=$resultTableExercicios['nome']?></a></td>
                            <td width='10%'><?=$dados['series']?></td>
                            <td>x</td>
                            <td width='10%'><?php echo $dados['repeticoes'];
                            $dados['modo'] == "TEMPO" ? $printModo = "s" : $printModo = ""; echo $printModo; ?></td>
                            <td width='10%'><?=$dados['carga']?>kg</td>
                            <td width='10%'><?=$dados['descSeries']?>s</td>
                        </tr>        
                        
                        <?php endforeach; ?>
                    </table>
                </article> 
                <!-- FIM DOBRA TABELA -->

                
                <!-- INICIO DOBRA INFOS PERSONAL -->
                <article class="infoPersonal">
                    <hr>
                    <h1>Criador: </h1>
                    <div class="infosPersonal_content flex-row">
                        <div class="dadosPerfilPersonal">
                                    <img width="150px" height="150px" src="https://nationalpti.org/wp-content/uploads/2014/02/Personal-Trainer.jpg" id="fotoUsuario">
                                    <h3> Renato Cariani</h3>
                        </div>
                        <div class="outras_infos">
                            <h2>Observações: </h2>
                            <p id="content_observacoes"><span><?=$cabecalhofichas_treino['observacoes']?><span></p>
                        </div>
                    </div>
                    <hr>
                </article>
            <!-- FIM DOBRA INFOS PERSONAL -->

            <!-- INICIO DOBRA PDF -->
            <article class="gerarPDF">
                <form method="POST" action="genPDF/gerarPDFFicha.php">
                    <input type="hidden" value="<?=$cabecalhofichas_treino['idFichas_treino']?>" name="idFichas_treino">
                    <button type="submit">Gerar PDF</button>
                </form>
            </article>
            <!-- FIM DOBRA PDF -->
        </div>
    <section>
<main>

</body>
</html>
<?php
$dbhExercicios = null;
$dbhfichas_treino = null;
$dbhft_exe =  null;