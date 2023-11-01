<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mostrar Fichas</title>
</head>
<style>
    
.showficha{
    width: 360px;
    height: 200px;
    background-color: green;
    color: white;
    border-radius: 5%;

}

</style>
<body>

<?php
echo "<h1>Fichas de Treino disponíveis</h1>";

//algoritmo para mostrar todas as registro da ficha de treino

require_once 'src/conexao.php';
$dbh = Conexao::getConexao();


$query = "SELECT * FROM olimpo.fichas_treino ";



$stmt = $dbh->prepare($query);
$stmt->execute();
$fichas = $stmt->fetchAll();



    foreach($fichas as $row): ?>

     <!-- 'Nome: '.$row['titulo']."<br>";
     'Data Criacao: '.$row['data_criacao'];
     "<br>"; -->
    <form action='detailsFicha.php' method="POST">
        <button type="submit" name="Enviar">
            <div class='showficha'>
                <h1><?=$row['titulo']?></h1>
                <p><?=$row['data_criacao']?></p>
            </div>
            <input type="hidden" name="idFichas_treino" value="<?=$row['idFichas_treino']?>">
        </button>
    </form>
<?php endforeach;


// forEach($_SESSION['sessaoFicha'] as $dados){

            
//     echo "<table width='100%' >
//             <tr>
//                 <td width='50%'>".$dados['nome']."</td>
//                 <td width='10%'>".$dados['series']."</td>
//                 <td width='10%'>".$dados['repeticoes'];
//                 $dados['modo'] == "TEMPO" ? $printModo = "s" : $printModo = ""; echo $printModo."</td>
//                 <td width='10%'>".$dados['carga']."</td>
//                 <td width='10%'>".$dados['intervaloSeries']."</td>
//             </tr>
//           </table>
//     ";

// }
?>


</body>
</html>