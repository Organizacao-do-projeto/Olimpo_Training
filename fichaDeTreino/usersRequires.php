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

<body>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/teste5/layouts/header.php";
?>
<a href="index.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>
<h1>Serviços pendentes</h1>
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
                    <td><img class="userPhoto" src="../usuarios/assests/img/<?= $userRequire['foto'];?>" alt="Foto do usuário"></td>
                    <td><?= $userRequire['nome'];?></td>
                    <td><?= $userRequire['saldo_solici'];?></td>
                    <td class="td__operacao">
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
* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  background: #f1f1f1;
  padding: 5px;
  min-height: 100vh;
}

header {
  padding: 25px;
  text-align: center;
  background-color: cornflowerblue;
  color: #ddd;
}

header h1 {
  font-size: 30px;
}

nav {
  overflow: hidden;
  background-color: #333;
}

nav a {
  float: left;
  display: block;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 18px;
  text-decoration: none;
}

nav a:hover {
  background-color: #ddd;
  color: #000;
  font-weight: 600;
}

main h1 {
  margin-top: 20px;
  text-align: center;
  font-size: 2rem;
}

table {
  font-family: arial, sans-serif;
  width: 100%;
  border-collapse: collapse;
}


td,
th {
  border: 1px solid #dddddd;
  text-align: center;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}

td a1 {
  color: rgb(87, 87, 207);

}

.section__btn {
  display: flex;
  justify-content: flex-end;
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
