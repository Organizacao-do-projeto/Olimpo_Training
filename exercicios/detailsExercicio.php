<?php
session_start();

include_once __DIR__.'/../auth/restrito.php';

isset($_GET['id']) ? $idExercicios = $_GET['id'] : header("Location:index.php?error=Ops! nenhum exercicio selecionado");
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

.all{
    width: 100%;
    display: flex;
}
    
.img_exer{
    width: 700px;
    display: flex;
    max-width: 600px;
    max-height: 500px;
     margin-left:90px;
     margin-bottom: 30px;
     margin-right: 40px;
    border-radius: 83.206px;
     font-weight: 800;
     font-size: 1.1rem;
      box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22)
}

.nome_exer{
    width: 100%;
    display: flex;
    justify-content: center;
    margin-top: 15px;
    margin-bottom: 40px;
    font-size: 2.5rem;
    
}

.ativ{
    display: flex;
    

}


.descricao{
    width: 100%;
    display: flex;
     margin-top: 10px;
     margin-right: 250px;
     margin-left: 20px;
     background: linear-gradient(to right, rgb(255, 245, 187), rgb(255, 212, 173));
     padding: 15px 20px;
     margin-bottom: 300px;
     border: solid black;
     max-height: 500px;
     border-radius: 10px;
     overflow: auto;
     opacity: 0.8;

}

.descricao:hover{
    opacity: 1;
    background: linear-gradient(to right, rgb(255, 241, 162), rgb(255, 198, 145));
}

.link{
    width: 50%;
    display: flex;
    margin-left: 450px;
    max-width: 700px;
    border: solid black;
    border-radius: 20px;
    margin-top: 60px;
}

</style>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
?>
<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

<h1 class="nome_exer" ><?=$exercicio['nome']?></h1>

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
    <div class="all">
    <img width="700px" height="700px" class="img_exer" src="animacoes/<?=$exercicio['nome_arq']?>"><br>
<?php
endif;
?>




<div class="descricao">
<p><?php echo "<p><font color='black' face='Arial' size='5'>".$exercicio['descricao']."</font></p>";?></p><br>
</div>

</div>

<iframe width="850" height="479" class="link" src="https://www.youtube.com/embed/<?=$exercicio['link_tutorial']?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe><br>
   
<?=$dbh=null;?>

</body>
<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/footer.php";
?>



<!-- .img_exer{
    
    width: 700px;
    height: 500px;
     margin-left:450px;
    border-radius: 83.206px;
     font-weight: 800;
     font-size: 1.1rem;
      box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22)
    
}
.descricao{
width: 100%;
display: flex;
justify-content: center;
align-items: center;
max-width: 500px;
text-align: center;
margin-top: 20px;
margin-left: 530px;
margin-bottom: 20px;
}

.nome{
    width: 100%;
    display: inline-block;
    text-align: center;
    background-color: gold;
    padding: 20px auto;
    font-size: 1.5rem;
    font-weight: 10000 ;
} -->

</html>