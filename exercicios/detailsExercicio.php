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
    <link rel="stylesheet" href="../assets/css/boot.css">
    <title> <?=$exercicio['nome']?> </title>
</head>
<style> 
.nome_exer{
    font-size: 2rem;
    font-weight: 500;
    margin: 20px 15px;
    text-align: center;
}

.img_exer{
    
    width: 700px;
    height: 500px;
     margin-left:450px;
    border-radius: 83.206px;
     font-weight: 800;
     font-size: 1.1rem;
      box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22)
    
}
</style>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
?>
<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

<h1 aling="center" class="nome_exer" ><?=$exercicio['nome']?></h1>

<body>
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
    <img width="700px" height="700px" class="img_exer" src="animacoes/<?=$exercicio['nome_arq']?>"><br>
<?php
endif;
?>

<h3>Atividade física</h3>
<p><?=$exercicio['ativ_fisica']?></p>

<p><?php echo "<pre>"; echo "<p><font color='black' face='Arial' size='5'>".$exercicio['descricao']."</font>"; echo "<pre>";?></p><br>


<iframe width="850" height="479" src="https://www.youtube.com/embed/<?=$exercicio['link_tutorial']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe><br>;

<?=$dbh=null;?>

</body>
<?php
        // $path = getenv('DOCUMENT_ROOT');
        // include_once $path."/Olimpo_Training/teste5/layouts/header.php";
?>
</html>