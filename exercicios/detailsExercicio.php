<?php

// if(!$_SESSION['usuario']){
//     header("Location:index.php?msg=Ops! talvez você não tenha acesso àquela pagina.");
// }

isset($_GET['id']) ? $idExercicios = $_GET['id'] : header("Location:index.php?msg=Ops! nenhum exercicio selecionado");
// $idExercicios = 6;

require_once 'src/conexao.php';

$dbh = Conexao::getConexao();

$query = "SELECT * FROM olimpo.exercicios WHERE idExercicios = :idExercicios";

$stmt = $dbh->prepare($query);
$stmt->bindParam(":idExercicios", $idExercicios);
$stmt->execute();
$exercicio = $stmt->fetch();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> <?=$exercicio['nome']?> </title>
</head>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/teste5/layouts/header.php";
?>
<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

<h1 aling="center" ><?=$exercicio['nome']?></h1>

<?php

$extensao = $exercicio['nome_arq'];
$extensao = pathinfo($extensao, PATHINFO_EXTENSION);

if($extensao == 'mp4' || $extensao == 'mov' || $extensao == 'webm'): ?>
    <video width="500px" height="500px" autoplay muted loop>
        <source src="animacoes/<?=$exercicio['nome_arq']?>">
    </video>
<?php
else:
?>
    <img width="700px" height="700px" src="animacoes/<?=$exercicio['nome_arq']?>"><br>
<?php
endif;
?>

<h3>Atividade física</h3>
<p><?=$exercicio['ativ_fisica']?></p>

<p><?php echo "<pre>"; echo "<p><font color='black' face='Arial' size='5'>".$exercicio['descricao']."</font>"; echo "<pre>";?></p><br>


<iframe width="850" height="479" src="https://www.youtube.com/embed/<?=$exercicio['link_tutorial']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe><br>;

<?=$dbh=null;?>