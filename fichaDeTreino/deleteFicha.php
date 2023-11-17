<?php
session_start();

include_once __DIR__.'/../auth/restrito.php';

$idFichas_treino = $_POST['idFichas_treino'];

require_once "src/conexao.php";

$dbhft_exe = Conexao::getConexao();
$dbhFichas_treino = Conexao::getConexao();

$queryft_exe = "DELETE FROM olimpo.ft_exe WHERE idFichas_treino = :idFichas_treino; ";

$queryFichas_treino = "DELETE FROM olimpo.fichas_treino WHERE idFichas_treino = :idFichas_treino; ";


$stmtft_exe = $dbhft_exe->prepare($queryft_exe);
$stmtft_exe->bindParam(':idFichas_treino' , $idFichas_treino);
$stmtft_exe->execute();

//no outro banco de dados
$stmtFichas = $dbhFichas_treino->prepare($queryFichas_treino);
$stmtFichas->bindParam(':idFichas_treino' , $idFichas_treino);
$stmtFichas->execute();

echo "Ficha de treino excluída com sucesso!<br>";
echo "<a href='index.php'>Fichas de treino</a>";

header("Location: index.php?success=Ficha de treino deletada com suceeso!");