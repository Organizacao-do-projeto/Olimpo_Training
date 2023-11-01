<?php

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

    a{
        text-decoration: none;
    }

    .hr{
        width: 100%;
        height: 3px;
        border-radius: 50%;
        background-color: black;
    }

    span{
        color: green;
        font-weight: 600;
    }

</style>
<?php
    $path = getenv('DOCUMENT_ROOT');
    include_once $path."/Olimpo_Training/layouts/header.php";
?>

<body>
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

            if($qntRegistros <= 0 || $qntRegistros == null){

                echo "<h1>Nenhum usuário com esse nome</h1>";   
                
               }else{

                foreach($results as $result):
                    ?>
                    </hr>
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
                        <article>
                    </a>
                    
                    <?php
                endforeach;
               }
            }

            ?>

    </section>
</body>
</html>

<?php

