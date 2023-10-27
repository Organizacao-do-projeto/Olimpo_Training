<?php
session_start();
//puxar dados da variavel de sessão e registrar no banco de dados

include_once "src/conexao.php";


$idAluno = 1;
$idPersonal = 1;

$tituloFicha = $_POST['tituloFicha'];
$descExercicios = $_POST['intervaloExercicios'];
$observacoes = $_POST['observacoes'];


$dbhFicha = Conexao::getConexao();
$dbhft_exe = Conexao::getConexao();

$queryFichaDeTreino = "INSERT INTO olimpo.fichas_Treino ( idAluno, idPersonal, titulo, descExercicios, observacoes, data_criacao)
                        VALUES(:idAluno, :idPersonal, :titulo, :descExercicios, :observacoes, NOW())";


$queryft_exe = "INSERT INTO olimpo.FT_EXE (idFichas_Treino, idExercicios, series, repeticoes, carga, descSeries, modo)
                    VALUES(:idFichas_Treino, :idExercicios, :series, :repeticoes, :carga, :descSeries, :modo)";



echo "<br><br>Ficha de treino adicionada com sucesso!!!<br>";
echo "<a href='index.php'>Visualizar fichas de treino</a>";




$stmtFicha = $dbhFicha->prepare($queryFichaDeTreino);
$stmtFicha->bindParam(':idAluno', $idAluno);
$stmtFicha->bindParam(':idPersonal', $idPersonal);
$stmtFicha->bindParam(':titulo', $tituloFicha);
$stmtFicha->bindParam(':descExercicios', $descExercicios);
$stmtFicha->bindParam(':observacoes', $observacoes);
$stmtFicha->execute();
$lastIdFicha = $dbhFicha->lastInsertId();



//adiciona cada exercício da ficha
forEach($_SESSION['sessaoFicha'] as $dados){

        $stmtft_exe = $dbhft_exe->prepare($queryft_exe);
        $stmtft_exe->bindParam(':idFichas_Treino', $lastIdFicha);
        $stmtft_exe->bindParam(':idExercicios', $dados['id']);
        $stmtft_exe->bindParam(':series', $dados['series']);
        $stmtft_exe->bindParam(':repeticoes', $dados['repeticoes']);
        $stmtft_exe->bindParam(':carga', $dados['carga']);
        $stmtft_exe->bindParam(':descSeries', $dados['intervaloSeries']);
        $stmtft_exe->bindParam(':modo', $dados['modo']);
        $stmtft_exe->execute();

}


$_SESSION['sessaoFicha'] = [];

$dbhFicha = null;
$dbhft_exe = null;

header("Location: index.php");
