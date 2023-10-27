<?php
session_start();


include_once "src/conexao.php";


$idAluno = 1;
$idPersonal = 1;

$tituloFicha = $_POST['tituloFicha'];
$descExercicios = $_POST['intervaloExercicios'];
$observacoes = $_POST['observacoes'];


$dbhFicha = Conexao::getConexao();
$dbhft_exe = Conexao::getConexao();

$idFichas_treino = $_SESSION['cabecalhoFichaEdit']['idFichas_treino'];

$queryft_exeDel = "DELETE FROM olimpo.FT_EXE WHERE idFichas_treino = :idFichas_treino; ";


$stmtft_exe = $dbhft_exe->prepare($queryft_exeDel);
$stmtft_exe->bindParam(':idFichas_treino' , $idFichas_treino);
$stmtft_exe->execute();


$queryFichaDeTreino = "UPDATE olimpo.Fichas_treino SET titulo = :titulo, descExercicios = :descExercicios, observacoes = :observacoes WHERE idFichas_treino = :idFichas_treino; ";

$stmtFicha = $dbhFicha->prepare($queryFichaDeTreino);
$stmtFicha->bindParam(':titulo', $tituloFicha);
$stmtFicha->bindParam(':descExercicios', $descExercicios);
$stmtFicha->bindParam(':observacoes', $observacoes);
$stmtFicha->bindParam(':idFichas_treino' , $idFichas_treino);
$stmtFicha->execute();


$queryft_exe = "INSERT INTO olimpo.FT_EXE (idFichas_Treino, idExercicios, series, repeticoes, carga, descSeries, modo)
                    VALUES(:idFichas_Treino, :idExercicios, :series, :repeticoes, :carga, :descSeries, :modo)";



//adiciona cada exercício da ficha
forEach($_SESSION['sessaoFicha'] as $dados){

        $stmtft_exe = $dbhft_exe->prepare($queryft_exe);
        $stmtft_exe->bindParam(':idFichas_Treino', $idFichas_treino);
        $stmtft_exe->bindParam(':idExercicios', $dados['id']);
        $stmtft_exe->bindParam(':series', $dados['series']);
        $stmtft_exe->bindParam(':repeticoes', $dados['repeticoes']);
        $stmtft_exe->bindParam(':carga', $dados['carga']);
        $stmtft_exe->bindParam(':descSeries', $dados['intervaloSeries']);
        $stmtft_exe->bindParam(':modo', $dados['modo']);
        $stmtft_exe->execute();

}



echo "<br><br>Ficha de treino editada com sucesso!!!<br>";
echo "<a href='index.php'>Visualizar fichas de treino</a>";






$_SESSION['sessaoFicha'] = [];
$_SESSION['cabecalhoFichaEdit'] = [];

$dbhFicha = null;
$dbhft_exe = null;

header("Location: index.php");
