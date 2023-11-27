<?php
session_start();

$dadosUsuario = $_SESSION['dadosUsuario'];

include_once __DIR__.'/../auth/restrito.php';
include_once __DIR__.'/../src/databases/conexao.php';
include_once __DIR__.'/../src/dao/crefdao.php';

$autenticado = new CREF();

//verifica se o usuário é personal
if(!isPersonal($dadosUsuario['perfil'], $autenticado->getAuthCREF($dadosUsuario['id']))){
    header('Location: ../index.php?error=Voce não tem permissão para Editar treinos.');
}

if(empty($_SESSION['sessaoFicha'])){ 
        header('Location: index.php?error=Você tentou adicionar um treino vazio, adicione no mínimo um exercicio');
        exit();
 }

$idPersonal = 1;

$tituloFicha = $_POST['tituloFicha'];
$descExercicios = $_POST['intervaloExercicios'];
$observacoes = $_POST['observacoes'];
$usuarioAddTreino = $_POST['usuarioAddTreino'];

$idAluno = $usuarioAddTreino;

echo "<pre>";
var_dump($_SESSION['sessaoFicha']);
echo "</pre>";

$dbhFicha = Conexao::getConexao();
$dbhft_exe = Conexao::getConexao();
$dbhUsuarios = Conexao::getConexao();

$queryFichaDeTreino = "INSERT INTO olimpo.fichas_Treino ( idAluno, titulo, descExercicios, observacoes, data_criacao)
                        VALUES(:idAluno, :titulo, :descExercicios, :observacoes, NOW())";


$queryft_exe = "INSERT INTO olimpo.FT_EXE (idFichas_Treino, idExercicios, series, repeticoes, carga, descSeries, modo)
                    VALUES(:idFichas_Treino, :idExercicios, :series, :repeticoes, :carga, :descSeries, :modo)";

$queryUsuarios = "SELECT saldo_treinos
                 FROM olimpo.usuarios
                 WHERE id = :id ";


$stmtFicha = $dbhFicha->prepare($queryFichaDeTreino);
$stmtFicha->bindParam(':idAluno', $idAluno);
// $stmtFicha->bindParam(':idPersonal', $idPersonal);
$stmtFicha->bindParam(':titulo', $tituloFicha);
$stmtFicha->bindParam(':descExercicios', $descExercicios);
$stmtFicha->bindParam(':observacoes', $observacoes);
$stmtFicha->execute();
$lastIdFicha = $dbhFicha->lastInsertId();



// adiciona cada exercício da ficha
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

$stmtUsuarios = $dbhUsuarios->prepare($queryUsuarios);
$stmtUsuarios->bindParam(':id', $usuarioAddTreino);
$stmtUsuarios->execute();
$saldoTreinosUsuario = $stmtUsuarios->fetch();

echo "Resultado da conexão de saldo de treinos: <br>".var_dump($saldoTreinosUsuario);

$saldoTreinosUsuario = $saldoTreinosUsuario['saldo_treinos'] - 1;

echo "Resultado da conexão de saldo de treinos: <br>".var_dump($saldoTreinosUsuario);

$queryUsuarios =        "UPDATE olimpo.usuarios SET saldo_treinos = :saldo_treinos
                        WHERE id = :id";

$stmtUsuarios = $dbhUsuarios->prepare($queryUsuarios);
$stmtUsuarios->bindParam(':saldo_treinos',$saldoTreinosUsuario);
$stmtUsuarios->bindParam(':id', $usuarioAddTreino);
$stmtUsuarios->execute();


$_SESSION['sessaoFicha'] = [];


$dbhFicha = null;
$dbhft_exe = null;
$dbhUsuarios = null;

header("Location: index.php?success=Ficha de treino criada com suceeso!");
