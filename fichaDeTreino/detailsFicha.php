<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes ficha de treino</title>
</head>
<style>

.animacao_exercicio{
    background-image: url(https://media.tenor.com/u2-VJiigKCkAAAAM/exercise-jump.gif);
    width: 100%;
    height: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: 200px 150px;
}

td{
    width: 200px;
    height: 150px;
    text-align: center;
    word-break: break-word;
}

.x_auxiliar{
    margin: 0 auto;
}

a{
    text-decoration: none;
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
    include_once $path."/Olimpo_Training/teste5/layouts/header.php";
        
?>
<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

<h1><?=$cabecalhofichas_treino['titulo']?></h1>

<div class='showCabecalho'>
    <form action="editFicha.php" method="POST">
        <input type="hidden" value="<?=$cabecalhofichas_treino['idFichas_treino']?>" name="idFichas_treino">
        <button type="submit">Editar</button>
    </form>
    <form action="deleteFicha.php" method="POST">
        <input type="hidden" value="<?=$cabecalhofichas_treino['idFichas_treino']?>" name="idFichas_treino">
        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir sua ficha de treino?')">Excluir</button>
    </form>
    <p><span id="spanDesc_exercicios">Descanso entre exercicios: <?=$cabecalhofichas_treino['descExercicios']?></span>&nbsp;&nbsp;<span id="spanData_criacao">Data de criação: <?=$cabecalhofichas_treino['data_criacao']?></span></p>
</div>

<table width='100%' >
            <thead>
                <!-- o de baixo vai puxar o url da animação -->
                <th width='25%'>Animação</th>
                <th width='25%'>Nome</th>
                <th width='10%'>Series</th>
                <th class='x_auxiliar'></th>
                <th width='10%'>Repetições</th>
                 <th width='10%'>Carga</th>
                 <th width='10%'>Descanso/Series</th>
            </thead>
<?php
    foreach($exercicios as $dados): ?>
   
             <tr>
                <!-- o de baixo vai puxar o url da animação -->
                 <td width='25%'><a target="_blank" href="detailsExercicio.php?id=<?=$dados['idExercicios']?>"><div class='animacao_exercicio'></div></a></td>
                 <td width='25%'><a target="_blank" href="detailsExercicio.php?id=<?=$dados['idExercicios']?>">burpee</a></td>
                 <td width='10%'><?=$dados['series']?></td>
                 <td class="x_auxiliar">x</td>
                 <td width='10%'><?php echo $dados['repeticoes'];
                 $dados['modo'] == "TEMPO" ? $printModo = "s" : $printModo = ""; echo $printModo; ?></td>
                 <td width='10%'><?=$dados['carga']?>kg</td>
                 <td width='10%'><?=$dados['descSeries']?>s</td>
             </tr>        

<?php endforeach; ?>
</table> 
<section> 
    <article>
        <div class="infoPersonal">
            <p>Id do personal criador(futuramente o nome):<a target="_blank" href="perfil.php?id=<?=$cabecalhofichas_treino['idPersonal']?>"> <?=$cabecalhofichas_treino['idPersonal']?></p>
            <p>Foto do personal: </p>
            <a target="_blank" href="perfil.php?id=<?=$cabecalhofichas_treino['idPersonal']?>">
                <img width="150px" height="150px" src="https://nationalpti.org/wp-content/uploads/2014/02/Personal-Trainer.jpg">
            </a>
        </div>
        <div class="outras_infos">
            <p>Observações: </p>
            <p id="content_observacoes"><span><?=$cabecalhofichas_treino['observacoes']?><span></p>
        </div>
    </article>
</section>
<p>
<?php    

   
        
?>

<form method="POST" action="genPDF/gerarPDFFicha.php">
    <input type="hidden" value="<?=$cabecalhofichas_treino['idFichas_treino']?>" name="idFichas_treino" id="idFichas_treino">
    <button type="submit">Gerar PDF</button>
</form>

</body>
</html>