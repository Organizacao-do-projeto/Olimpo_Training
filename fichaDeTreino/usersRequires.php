<?php
session_start();
$dadosUsuario = $_SESSION['dadosUsuario'];

include_once __DIR__.'/../auth/restrito.php';

include_once __DIR__.'/../src/databases/conexao.php';
include_once __DIR__.'/../src/dao/crefdao.php';

$autenticado = new CREF();

//verifica se o usuário é personal
if(!isPersonal($dadosUsuario['perfil'], $autenticado->getAuthCREF($dadosUsuario['id']))){
    header('Location: ../index.php?error=Voce não tem permissão para criar treinos.');
}


// include_once "src/conexao.php";

$dbh = Conexao::getConexao();


$query = "SELECT * FROM olimpo.usuarios  WHERE saldo_treinos > 0;";
$stmt = $dbh->prepare($query);

$stmt->execute();
$usersRequires = $stmt->fetchAll();
$quantidadeRegistros =  $stmt->rowCount();


?>

<hr>

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
    <link rel="stylesheet" href="../assets/css/nav.css">
    <link rel="stylesheet" href="../assets/css/list_format.css">

  <title>Selceionar usuário</title>
</head>
<body>

<?php
      $path = getenv('DOCUMENT_ROOT');
      include_once $path."/Olimpo_Training/layouts/header.php";
?>
<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>
<h1 class="titulo" >Selecione o usuário</h1>
</main>
<section>
    <table >
        <thead>
            <tr>
                <th>Foto</th>
                <th>Nome</th>
                <th>Saldo de treinos</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php if ($quantidadeRegistros == "0"): ?>
                <tr>
                    <td colspan="4">Não existem usuários com treinos pendentes.</td>
                </tr>
            <?php else: ?>
                <?php foreach($usersRequires as $userRequire): ?>
                <tr>
                    <td><img class="userPhoto" <?php
                    
                    if(empty($userRequire['foto'])){
                      echo "src='../assets/img/usuarios/usuarioGenerico.jpg'";
                    }else{
                      echo "src='../assets/img/usuarios/".$userRequire['foto']."'";
                    };

                     ?> alt="Foto do usuário"></td>
                    <td><?= $userRequire['nome'];?></td>
                    <td><?= $userRequire['saldo_treinos'];?></td>
                    <td>
                      <form action="newFicha.php" method="POST">
                        <input type="hidden" name="usuarioAddTreino" value="<?=$userRequire['id']?>">
                        <button type="submit" class="btnalterar">Criar Treino</button>
                      </form>
                    </td>
                </tr>
                <?php endforeach;
                endif; $dbh = null; ?>
        </tbody>
    </table>
</section>
</main>
</body>
<style>


a{
  text-decoration: none;
}


.btn {
  border: none;
  padding: 10px;
  margin: 10px;
  width: 120px;
  height: 35px;
  background-color: rgb(87, 87, 207);
  color: #fff;
  text-align: center;
  text-decoration: none;
  font-weight: 600;
  border-radius: 3px;
}

.btnalterar {
  border: none;
  width: 120px;
  height: 33px;
  padding: 5px 0px;
  background-color: rgb(1, 165, 42);
  color: #fff;
  text-align: center;
  text-decoration: none;
  font-size: 1.1rem;
  font-weight: 600;
  border-radius: 3px;
  display: inline-block;  
}

.btnexcluir {
  border: none;
  width: 100px;
  padding: 5px 0px;
  background-color: rgb(182, 51, 46);
  color: #fff;
  text-align: center;
  text-decoration: none;
  font-size: .8rem;
  font-weight: 600;
  border-radius: 3px;
  display: inline-block;  
}

.userPhoto{
  border-radius: 50%;
  box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
  padding: 5px;
  margin: 20px;
  width: 90px;
  height: 90px;
  border: 5px solid rgba(253, 237, 15, 0.3);
  transition: all 0.3s ease-out;

}
</style>
</html>
