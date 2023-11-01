<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
    <style>
        .redirects {
            height: 1600px;
            width: 90px;
            position: absolute;
            background-color: #fff;
            box-shadow: 2px 0px 2px 1px rgba(0, 0, 0, 0.2);

        }

        .wrapper {

            margin-left: 100px;
        }


        .redirects a {
            /* width: 80px;
            height: 80px;
            border: none; */
            width: 80px;
            height: 50px;
            padding: 5px 0px;
            text-align: center;
            text-decoration: none;
            font-size: .8rem;
            font-weight: 600;
            border-radius: 3px;
            border: 1px solid rgba(0, 0, 0, 0.2);
            display: inline-block;
            opacity: 0.5;

        }

        .redirects a:hover {
            opacity: 1;
        }

        h1 {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .info_user {
            display: flex;
            flex-direction: row;
            justify-content: end;
            align-items: center;
        }

        .info_user h2 {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }

        .container_fichasDeTreino {
            width: 100%;
            height: 350px;
        }

        .container_fichasDeTreino_apresentacao {
            background-color: blue;
            width: 450px;
            height: 250px;

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

        .banner {
            background-image: url('https://i.pinimg.com/736x/7c/ce/ef/7cceef7edf1e5c8856f67e27ba999e0f.jpg');
            background-repeat: no-repeat;
            background-size: cover;
            height: 530px;
            width: 100%;
            border-radius: 10px;
            flex-wrap: wrap;

        }

        .banner_content {
            padding: 22px;
        }

        .banner p {
            color: #fff;
            font-size: 50px;
            /* font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; */
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            font-weight: 600;
            width: 700px;
            text-align: end;

        }

        .banner span {
            color: gold;
            text-transform: uppercase;
        }
    </style>
</head>

<?php
$dadosUsuario = $_SESSION['dadosUsuario'];

$id = $dadosUsuario['id'];

include_once "src/conexao.php";

$query = "SELECT nome FROM olimpo.perfis WHERE id = :id";

$dbh = Conexao::getConexao();

$stmt= $dbh->prepare($query);
$stmt->bindParam(":id",$id);
$stmt->execute();
$nomePerfis = $stmt->fetch();


?>

<body>

    <div class="redirects">
        <a href="../index.php" title="Tela Inicial"><img src="assets/img/home.svg" height="40px"></a>
        <a href="pesquisarUsuario.php" title="Pesquisar usuário"><img src="assets/img/search.svg" height="40px"></a>
        <a href="../exercicios/index.php" title="Exercicios"><img src="assets/img/excercise.png" height="40px"></a>
        <a href="../fichaDeTreino/index.php" title="Fichas de treino"><img src="assets/img/ficha-treino.png" height="40px"></a>
        <a href="../auth/logout.php" title="Efetuar logout"><img src="assets/img/exit.svg" height="40px"></a>
        <a href="../authCREF/index.php" title="Autenticar CREF"><img src="assets/img/autenticar.svg" height="40px"></a>
        <a href="listAdmin.php" title="Painel de usuários"><img src="assets/img/usuarios.svg" height="40px"></a>
    </div>
    <div class="wrapper">
        <h1><?=$nomePerfis['nome']?></h1>
        <section>
            <article class="info_user">
                <h2><?=$dadosUsuario['nome']?></h2>
                <img id="fotoUsuario"
                            <?php if(empty($dadosUsuario['foto'])){ ?>
                                <img src="assets/img/usuarioGenerico.jpg" id="fotoUsuario" >

                            <?php }else{ ?>
                                <img src="../assets/img/usuarios/<?=$dadosUsuario['foto']?>" id="fotoUsuario" >
                                
                            <?php } ?>
            </article>
        </section>
        <main>
            <section>
                <article class="banner">
                    <div class="banner_content">
                        <p>O melhor dia para <span>começar<br></span> é <span>hoje!</span></p>
                    </div>
                </article>
            </section>

        </main>
    </div>
</body>

</html>