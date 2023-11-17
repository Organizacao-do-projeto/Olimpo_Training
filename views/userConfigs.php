<?php
session_start();

include_once __DIR__.'/../auth/restrito.php';

$dadosUsuario = $_SESSION['dadosUsuario'];

$id = $dadosUsuario['id'];

include_once "src/conexao.php";

$query = "SELECT nome FROM olimpo.perfis WHERE id = :id";

$dbh = Conexao::getConexao();

$stmt= $dbh->prepare($query);
$stmt->bindParam(":id",$id);
$stmt->execute();
$nomePerfis = $stmt->fetch(PDO::FETCH_BOTH);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="../assets/css/boot.css" rel="stylesheet">
    <title>Configurações da conta</title>
</head>
<body>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
?>
<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>
<main>
<h1>Configurações da conta</h1>

    <nav>
        <ul>
            <li>
                <a class="bts_usr_configs" href="../auth/logout.php" title="realizar logout">Realizar logout</a>
            </li>
            <li>
                <a class="bts_usr_configs" href="../<?php 
                if($nomePerfis['nome'] == 'COMUM'){
                    echo "usuarioComum"; 
                }else if($nomePerfis['nome'] == 'ALUNO' ){
                    echo "usuarioAluno";
                }else{
                    echo "usuarioPersonal"; 
                }?>/update.php?id=<?=$dadosUsuario['id']?>" title="Editar conta">Editar conta</a>
            </li>
            <li>
                <form method="POST" action="../<?php 
                if($nomePerfis['nome'] == 'COMUM'){
                    echo "usuarioComum"; 
                }else if($nomePerfis['nome'] == 'ALUNO' ){
                    echo "usuarioAluno";
                }else{
                    echo "usuarioPersonal"; 
                }?>/delete.php?id=<?=$dadosUsuario['id']?>&foto=<?=$dadosUsuario['foto']?>" >
                    <button type="button" class="bts_usr_configs" title="Excluir conta" onclick="swalConfirm(this,'Excluir conta', 'Tem certeza que deseja excluir sua conta?')"><font color="red">Excluir conta</font></button>
                </form>
            </li>
        </ul>
    </nav>
</main>
</body>
<style>

body{
    width: 100vw;
    height: 75vh;
}

main{
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
    flex-direction: column;

}

main h1{
    margin-bottom: 60px;
}

main ul{
    list-style: none;
}


main .bts_usr_configs{

    justify-content: center;
    align-items: center;
    display: flex;
    width: 360px;   
    height: 50px;
    margin: 5px;
    justify-content: start;
    padding: 5px 0px;
    text-align: center;
    text-decoration: none;
    font-size: 2.1rem;
    color: black;
    font-weight: 600;
    border-radius: 10px;
    background: #fff;
    border: 1px solid rgba(0, 0, 0, 0.2);
    display: inline-block;
    opacity: 0.6;
    cursor: pointer;
}


main a:hover,button:hover {
    opacity: 1;
}
</style>
</html>
<?php //include_once __DIR__.'/../assets/script/sweetAlert.php'; ?>