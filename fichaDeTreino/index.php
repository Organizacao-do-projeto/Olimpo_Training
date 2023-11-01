<?php
session_start();
$_SESSION['sessaoFicha'] = [];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boot.css">
    <title>Fichas de Treino</title>
</head>
<style>
    
.mainTitulo{
    margin-bottom: 30px;
    text-align: center;
    color: black;
    font-family: 'Rubik';
    font-size: 70px;
    font-style: normal;
    font-weight: 600;
    line-height: 110%; /* 143px */
    letter-spacing: -1.625px;
}

.wrapbtn{
    text-align: end;
}

.btnCriar {
  border: none;
  width: 250px;
  padding: 5px 0px;
  color: #fff;
  text-align: center;
  text-decoration: none;
  display: inline-block;  

  box-sizing: border-box;
    margin-bottom: 15px;
    padding: 12.2362px 36.7085px;
    gap: 12.24px;
    background: radial-gradient(circle at 10% 20%, rgb(255, 200, 124) 0%, rgb(252, 251, 121) 90%);
    border: 1.22362px solid #F2F2F2;
    backdrop-filter: blur(2.44724px);
    border-radius: 83.206px;
    color: #68521b;
    font-weight: 800;
    font-size: 1.1rem;
    box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
    font-family: 'Rubik';
}

.sectionFichas{
    display: flex;
    flex-direction: row;
    wrap: wrap;
    justify-content: space-between;
    margin-bottom: 100px;
    flex-wrap: wrap;
}


.showficha{
    margin-top: 20px;
    color: white;
    border-radius: 5%;
    
    
    width: 310px;
    height: 420px;
    
    background: #000000;
    border-radius: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    
}

.showficha_margin{
    width: 100%;
    height: 100%;
    margin-top: 40px;
    margin-bottom: 40px;
    border: 1px solid gold;

}

.showficha_cabecalho{
    display:flex;
    flex-direction: row;
    align-items: center;
}
.showficha_cabecalho img{
    filter: brightness(0) saturate(100%) invert(90%) sepia(83%) saturate(1156%) hue-rotate(357deg) brightness(106%) contrast(103%);
    
}

.showficha_cabecalho p{
    font-style: 'monospace';
    font-weight: 600;
    font-size: 1.1rem;
    margin-left: 6px;
}

.showficha_dados{
    margin-left: 4px;
    margin-right: 4px;
    margin-top: 40px;
    display:flex;
    flex-direction: row;
    
}


.showficha_data{
    width: 30%;
    height: 50px;
    border-radius: 100px;
    background: radial-gradient(ellipse farthest-corner at right bottom, #FEDB37 0%, #FDB931 8%, #9f7928 30%, #8A6E2F 40%, transparent 80%),
                radial-gradient(ellipse farthest-corner at left top, #FFFFFF 0%, #FFFFAC 8%, #D1B464 25%, #5d4a1f 62.5%, #5d4a1f 100%);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    font-style: 'Ubuntu';
    font-weight: 600;

}

.empty{
    width:70%;
    height: 50px;
    border-radius: 100px;
    background: #1A1A1A;

}

.showficha_title{
    margin-top: 10px;
    display: flex;
    min-height: 40px;
    width: 250px;
    padding: 20px;
    align-items: flex-start;
    gap: 5px;
    align-self: stretch;
    border-radius: 30px;
    background: #1A1A1A;
}


</style>
<body>
<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
?>
<a href="../views/index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

    <?php 
    // session_start();
    // $dadosUsuario = $_SESSION['dadosUsuario'];
    $dadosUsuario = array();
    $dadosUsuario['tipo'] = 'ADMINISTRADOR';

    if($dadosUsuario['tipo'] == 'ADMINISTRADOR' || $dadosUsuario['tipo'] == 'PERSONAL-TRAINER'): ?>
    <div class="wrapbtn">
        <a href="usersRequires.php" class="btnCriar">Criar Ficha de treino</a>
    </div>
    <?php endif; ?>

    <h1 class="mainTitulo">Fichas de Treino</h1>
    
    <section class="sectionFichas">
<?php

// pega o id do usuario que entrou na tela
isset($_GET['idUsuarios']) ? $usuarioId = $_GET['idUsuarios'] : $usuarioId = 1;


//algoritmo para mostrar todos as registro da ficha de treino

require_once 'src/conexao.php';

$dbh = Conexao::getConexao();


$query = "SELECT * FROM olimpo.fichas_treino ";


$stmt = $dbh->prepare($query);
$stmt->execute();
$fichas = $stmt->fetchAll();
$quantFichas = count($fichas);

    $i = 0;

    foreach($fichas as $row): 
    $i++;
    ?>


     <!-- 'Nome: '.$row['titulo']."<br>";
     'Data Criacao: '.$row['data_criacao'];
     "<br>"; -->
    <form action='detailsFicha.php' method="POST">
        <button class='showficha' type="submit" name="Enviar">
            <div class="showficha_margin">
                <div class="showficha_cabecalho">
                        <p> <?=$i?><font  color="gold"> | <?=$quantFichas?></font></p>
                    <img src="../views/assets/img/setaFicha.png" height="9px">
                </div>
                <div class="showficha_dados">
                    <div class="showficha_data">
                        <?=$row['data_criacao']?>
                    </div>
                    <div class="empty">
                    </div>                    
                </div>

                <div class="showficha_title">
                    <h1><?=$row['titulo']?></h1>
                </div>
            <div>
            <input type="hidden" name="idFichas_treino" value="<?=$row['idFichas_treino']?>">
        </button>
    </form>
<?php endforeach; ?>
    </section>

</body>
</html>