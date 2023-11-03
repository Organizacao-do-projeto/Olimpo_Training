<?php
//session_start();
// $dadosUsuario = $_SERVER['dadosUsuario'];
$dadosUsuario = array();
$dadosUsuario['tipo'] = 'PERSONAL-TRAINER';
//$dadosUsuario['tipo'] = 'ADMINISTRADOR';

//verifica se pode entrar nesta tela
// if($dadosUsuario['tipo'] != 'ADMINISTRADOR' || $dadosUsuario['tipo'] != 'PERSONAL-TRAINER'):
//     header("Location: index.php?msg=Você não tem permissão para criar ficha de treino.");
//     exit;
// endif;

// $idPerso_trainer = $dadosUsuario['id'];

$idPerso_trainer = 1;

include_once "src/conexao.php";

$dbh = Conexao::getConexao();

//seleciona todos se for adm e seleciona apenas os do personal caso seja personal trainer
if($dadosUsuario['tipo'] == 'ADMINISTRADOR'){
    
    $query = "SELECT * FROM olimpo.usuarios  WHERE saldo_solici > 0;";
    $stmt = $dbh->prepare($query);
    
}else if($dadosUsuario['tipo'] == 'PERSONAL-TRAINER'){
    
    $query = "SELECT * FROM olimpo.usuarios WHERE idPerso_trainer = :idPerso_trainer AND saldo_solici > 0 ; ";
    $stmt = $dbh->prepare($query);  
    $stmt->bindParam(":idPerso_trainer", $idPerso_trainer);
}

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
                <th>Saldo de fichas</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <?php if ($quantidadeRegistros == "0"): ?>
                <tr>
                    <td colspan="4">Não existem usuários com fichas pendentes.</td>
                </tr>
            <?php else: ?>
                <?php foreach($usersRequires as $userRequire): ?>
                <tr>
                    <td><img class="userPhoto" <?php
                    
                    if(empty($userRequire['foto'])){
                      echo "src='../views/assets/img/usuarioGenerico.jpg'";
                    }else{
                      echo "src='../usuarios/assests/img/usuarios/".$userRequire['foto']."'";
                    };

                     ?> alt="Foto do usuário"></td>
                    <td><?= $userRequire['nome'];?></td>
                    <td><?= $userRequire['saldo_solici'];?></td>
                    <td>
                        <a class="btnalterar" href="newFicha.php?id=<?=$userRequire['id'];?>">Criar ficha</a>
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
