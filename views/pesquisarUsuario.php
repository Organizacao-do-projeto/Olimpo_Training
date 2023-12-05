<?php
session_start();

include_once __DIR__.'/../auth/restrito.php';

$dadosUsuario = $_SESSION['dadosUsuario'];

if(isset($_GET['nomeBusca'])){

    $nomeBusca = $_GET['nomeBusca'];

    include_once "src/conexao.php";

    $dbh = Conexao::getConexao();
    
    $query = "SELECT * FROM olimpo.usuarios WHERE nome LIKE CONCAT('%', :nomeBusca,'%');";

    $stmt = $dbh->prepare($query);
    $stmt->bindParam(":nomeBusca", $nomeBusca);
    $stmt->execute();
    $results = $stmt->fetchAll();
    $qntRegistros = $stmt->rowCount();

    $dbhExercicios = Conexao::getConexao();
    
    $queryExercicios = "SELECT * FROM olimpo.exercicios WHERE nome LIKE CONCAT('%', :nomeBusca,'%');";

    $stmtExercicios = $dbhExercicios->prepare($queryExercicios);
    $stmtExercicios->bindParam(":nomeBusca", $nomeBusca);
    $stmtExercicios->execute();
    $resultsExercicios = $stmtExercicios->fetchAll();
    $qntRegistrosExercicios = $stmtExercicios->rowCount();

    $dbhFichas_treino = Conexao::getConexao();
    

    if($dadosUsuario['perfil'] == "ADMINISTRADOR"){
        $queryFichas_treino = "SELECT * FROM olimpo.fichas_treino WHERE titulo LIKE CONCAT('%', :nomeBusca,'%');";
    }else{
        $queryFichas_treino = "SELECT * FROM olimpo.fichas_treino WHERE titulo LIKE CONCAT('%', :nomeBusca,'%')
        AND idAluno = :idAluno;";
    }

    $stmtFichas_treino = $dbhFichas_treino->prepare($queryFichas_treino);
    $stmtFichas_treino->bindParam(":nomeBusca", $nomeBusca);
    if($dadosUsuario['perfil'] != 'ADMINISTRADOR'){
        $stmtFichas_treino->bindParam(":idAluno", $dadosUsuario['id']);
    }
    $stmtFichas_treino->execute();
    $resultsFichas_treino = $stmtFichas_treino->fetchAll();
    $qntRegistrosFichas_treino = $stmtFichas_treino->rowCount();
    
};

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesquisar usuário</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<style>
    
    .showUsers{
        margin-left: 100px;
        margin-right: 50px;
        margin-bottom: 100px;

    }

    #wrapperBusca{
        display: flex;
        justify-content: center;
        border-radius: 80%;
        margin-top: 30px;
    }

    #btBusca{
        width: 20px;
        height: 20px;
        background: transparent;
        /* border-radius: 50%; */
        cursor: pointer;
        border: none;

    }

    .formBusca{
        display: flex;
        flex-direction: row;
        align-items: center;
        border-radius: 100px 100px;
        border: 4px  solid gold;
        padding: 40px;
        background-color: #fff;
    }

    .limitInput{
        width: 800px;

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

    .animaExercicio {
        border-radius: 25px;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
        padding: 5px;
        margin: 20px;
        width: 100px;
        height: 100px;
        border: 5px solid rgba(253, 237, 15, 0.3);
        transition: all 0.3s ease-out;
    }

    .linhaUsuario{
        display: flex;
        flex-direction: column;
        align-items: start;
        justify-content: space-around;
    }

    .linhaUsuario div{
        display:flex;
        flex-direction: row;
        align-items: center;
    }

    .linhaUsuario span{
        font-size: 16px;
    }

    .h1Ficha{
        font-size: 25px;
        margin-top: 37px;
        margin-bottom: 14px;
    }

    a{
        text-decoration: none;
    }

    .hr{
        width: 100%;
        height: 2px;
        border-radius: 10px;
        background-color: yellow;
        box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.10);
        border: none;

    }

    span{
        color: green;
        font-weight: 600;
    }

    .btFicha{
        height: 100px;
        background: rgba(0,0,0,0);
        border: none;
        cursor: pointer;
        display: flex;
        flex-direction: column;
         
    }

</style>
<?php
    $path = getenv('DOCUMENT_ROOT');
    include_once $path."/Olimpo_Training/layouts/header.php";
?>

<body>

<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

    <header>
        <article id="wrapperBusca">
            <form class="formBusca" action="" method="GET">
                <div class="limitInput">
                    <input type="text" name="nomeBusca" class="w3-input" id="nomeBusca" placeholder="Digite o nome de um usuário">
                </div>
                <button type="submit" id="btBusca" ><img width="40px"
                height="40px" src="assets/img/search.gif" ></button>
            </form>
        </article>
    <header>

    <section class="showUsers">
        <?php
            if(isset($_GET['nomeBusca'])){

            if($qntRegistros <= 0 && $qntRegistros == null && $qntRegistrosExercicios <= 0 && $qntRegistrosExercicios == null && $qntRegistrosFichas_treino <= 0 && $qntRegistrosFichas_treino == null){

                echo "<h1>Nada econtrado com esse nome</h1>";   
                
               }else{

                foreach($results as $result):
                    ?>

                    <a href="perfil.php?idPerfil=<?=$result['id']?>">
                        <article class="linhaUsuario">
                            <div>
                            <?php if(empty($result['foto'])){ ?>
                                <img src="assets/img/usuarioGenerico.jpg" id="fotoUsuario" >

                            <?php }else{ ?>
                                <img src="../assets/img/usuarios/<?=$result['foto']?>" id="fotoUsuario" >
                                
                            <?php } ?>
                                <h1><?=$result['nome']?></h1>
                            </div>
                            <span>
                                <?php
                                //pega o tipo de perfil do usuario
                                $dbhPerfis = Conexao::getConexao();

                                $queryPerfis = "SELECT * FROM olimpo.perfis WHERE id = :id";

                                $stmtPerfis = $dbh->prepare($queryPerfis);
                                $stmtPerfis->bindParam("id", $result['id']);
                                $stmtPerfis->execute();
                                $resultPerfis = $stmtPerfis->fetch();

                                echo $resultPerfis['nome'];

                                ?>
                            </span>
                        </article>
                    </a>
                    <hr class="hr">
                    <?php
                endforeach;
                #pesquisa do exercício
                foreach($resultsExercicios as $resultExercicio):
                    ?>
                    <a href="../exercicios/detailsExercicio.php?id=<?=$resultExercicio['idExercicios']?>">
                        <article class="linhaUsuario">
                            <div>
                                <img src="../exercicios/animacoes/<?=$resultExercicio['nome_arq']?>" class="animaExercicio" >
                                <h1><?=$resultExercicio['nome']?></h1>
                            </div>
                            <span>
                                EXERCICIO
                                <?php
                                //pega o tipo de perfil do usuario
                                // $dbhPerfis = Conexao::getConexao();

                                // $queryPerfis = "SELECT * FROM olimpo.perfis WHERE id = :id";

                                // $stmtPerfis = $dbh->prepare($queryPerfis);
                                // $stmtPerfis->bindParam("id", $result['id']);
                                // $stmtPerfis->execute();
                                // $resultPerfis = $stmtPerfis->fetch();

                                // echo $resultPerfis['nome'];

                                ?>
                            </span>
                        </article>
                    </a>
                    <hr class="hr">
                    <?php
                endforeach;

                #pesquisa da ficha de treino
                foreach($resultsFichas_treino as $resultFichas_treino):
                    ?>
                    <form method="POST" action="../fichaDeTreino/detailsFicha.php">
                        <input type="hidden" value="<?=$resultFichas_treino['idFichas_treino']?>" name="idFichas_treino">
                        <button type="submit" class="btFicha" > 
                        <!-- <a> -->
                            <article class="linhaUsuario">
                                <div>
                                    <h1 class="h1Ficha"><?=$resultFichas_treino['titulo']?></h1>
                                </div>
                                <span>
                                    TREINO
                                </span>
                            </article>
                        <!-- </a> -->
                        </button>
                        <!-- <button type="submit">Visualizar</button>  -->
                    </form> 
                    <hr class="hr">
                  
                    <?php
                endforeach;

               }


            }

            ?>

    </section>
</body>
</html>

<?php

