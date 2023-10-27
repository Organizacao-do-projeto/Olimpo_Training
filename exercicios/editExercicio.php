<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Editar exercicio </title>
</head>
<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/teste5/layouts/header.php";
?>

<a href="admPanelExercicios.php"><img height="60px" src="../views/assets/img/voltar.svg"></a>

<?php

isset($_POST['idEdit']) ? $idEdit = $_POST['idEdit'] : redirecionaInvalido();
// $idEdit = 6;


include_once "src/conexao.php";

//conexão para resgatar os valores do banco e colocar nos inputs
$dbhValues = Conexao::getConexao();

$queryValues = "SELECT * FROM olimpo.exercicios WHERE idExercicios = :idExercicios; ";

$stmtValues = $dbhValues->prepare($queryValues);
$stmtValues->bindParam(':idExercicios',$idEdit);
$stmtValues->execute();
$fetchValues = $stmtValues->fetch();




isset($_POST['nomeExercicio']) ? $nomeExercicio = $_POST['nomeExercicio'] : $nomeExercicio = "";
isset($_POST['atividadeFisica']) ? $atividadeFisica = $_POST['atividadeFisica'] : $atividadeFisica = "";
isset($_POST['linkTutorial']) ? $linkTutorial = $_POST['linkTutorial'] : $linkTutorial = "" ;
isset($_POST['descricao']) ? $descricao = $_POST['descricao'] : $descricao = "";
isset($_FILES['animacao']) ? $animacao = $_FILES['animacao'] : $animacao = "";


if(!empty($nomeExercicio && $atividadeFisica && $linkTutorial && $descricao)){
    
    $patternYT = '#^https://www.youtube.com/embed/(.*)#';
    
    $result = preg_match($patternYT,$linkTutorial,$matches);
    
    if($result):
        
        $linkExtraido = $matches[1];
        
            $nomeAnimacao = $animacao['name'];
            $caminhoExercicio = "animacoes/".$nomeAnimacao;
            $extensaoArquivo = pathinfo($animacao['name'], PATHINFO_EXTENSION);
            $tamanhoPermitido = 150000000;
            
            include_once "src/conexao.php";
            
            $dbh = Conexao::getConexao();


            //verifica se o valor do arquivo está vazio, se vazio puxa query que não tem update do arquivo
            if($animacao['size'] > 0){
                //query de adiocinar com o video
                $queryEditExercicio = "UPDATE olimpo.exercicios SET nome = :nome, ativ_fisica = :ativ_fisica, link_tutorial = :link_tutorial, descricao = :descricao, nome_arq = :nome_arq WHERE idExercicios = :idExercicios";
                $addVideo = true;
            }else{
                $queryEditExercicio = "UPDATE olimpo.exercicios SET nome = :nome, ativ_fisica = :ativ_fisica, link_tutorial = :link_tutorial, descricao = :descricao WHERE idExercicios = :idExercicios";
                //query de adicionar sem o video
                $addVideo = false;
            }
                
                if(verificaFormato($extensaoArquivo) or !$addVideo){
                    //verifica tamanho do arquivo
                    if($animacao['size'] < $tamanhoPermitido or !$addVideo){
                        move_uploaded_file($animacao['tmp_name'], $caminhoExercicio);
                        
                        $stmtexercicios = $dbh->prepare($queryEditExercicio);
                        $stmtexercicios->bindParam(':nome', $nomeExercicio);
                        $stmtexercicios->bindParam(':ativ_fisica', $atividadeFisica);
                        $stmtexercicios->bindParam(':link_tutorial', $linkExtraido);
                        $stmtexercicios->bindParam(':descricao', $descricao);
                        //significa que modificou o arquivo
                        if($addVideo){
                            $stmtexercicios->bindParam(':nome_arq', $nomeAnimacao);
                            unlink('animacoes/'.$fetchValues['nome_arq']);
                        }
                        $stmtexercicios->bindParam(':idExercicios',$idEdit);
                        $stmtexercicios->execute();


                        echo "Exercicio Editado com suesso!";
                    
                        }else{
                            echo "Tamanho excedido!";
                        }
                    }else{
                        echo "Formato não permitido!";
                    };

            else:
                echo "O link inserido não é valido<br>";
                echo "Vá no video do youtube, clique em compartilhar>incorporar e pegue o link que contem https://www.youtube.com/embed/";
            endif;

        }elseif(isset($_POST['nomeExercicio'])){
            echo "<p><font color='red'>Algum campo está em branco!</font></p>";
        };
        

        
    function verificaFormato($extensaoAqv){

    $arrayFormatosAceitos = [ "gif","mov","mp4","webm" ];
    $permitido = false;

    foreach($arrayFormatosAceitos as $formato){
        if($extensaoAqv == $formato){
            $permitido = true;
        }
    }

    return $permitido;
    
}



function redirecionaInvalido(){
    
    header("Location:admPanelExercicios.php?msg=Nenhum exericio foi selecionado para ser editado.");

}


?>


<body>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="nomeExercicio">Nome do exercicio: </label>
        <input type="text" name="nomeExercicio" placeholder="Flexão" value="<?=$fetchValues['nome']?>"><br/>
        <label for="atividadeFisica">Atividade física: </label>
        <select name="atividadeFisica" id="selectAtv">
            <option value="ACADEMIA">Academia</option>
            <option value="CALISTENIA">Calistenia</option>
            <option value="AEROBICO">Aeróbico</option>
            <option value="CROSSFIT">Crossfit</option>
            <option value="BOXE">Boxe</option>
        </select><br/>
        <label for="linkTuorial">Link do tutorial: </label>
        <input type="url" name="linkTutorial" placeholder="Insira um link do youtube" pattern="https://www.youtube.com/embed/.*" size="100" required value="https://www.youtube.com/embed/<?=$fetchValues['link_tutorial']?>"><br/>
        <label for="descricao">Descrição do exercício:</label><br/>
        <textarea name="descricao" placeholder="Insira os detalhes sobre o exericio."><?=$fetchValues['descricao']?></textarea><br/>
        <label for="animacao">Video de animação:</label><br/>
        <input type="file" name="animacao" accept=".gif,.mp4,.mov,.webm" id="animacao" onchange="pressed()" title="Escolha um video porfavor"><label id="fileLabel"><?=$fetchValues['nome_arq']?></label><br/>
        <input type="submit" value="Enviar">
    </form>

<style>
    input[type=file]{
        width: 122px;
        color: transparent;
    }
</style>
<script>

<?php echo 'document.getElementById("selectAtv").value = "'.$fetchValues['ativ_fisica'].'";'; ?>
     

window.pressed = function(){
    var a = document.getElementById('animacao');
    if(a.value == "")
    {
        fileLabel.innerHTML = "Escolha um arquivo";
    }
    else
    {
        var theSplit = a.value.split('\\');
        fileLabel.innerHTML = theSplit[theSplit.length-1];
    }
};
</script>
</body>
</html>
             
<?=$dbh=null;