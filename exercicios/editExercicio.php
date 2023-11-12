<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Editar exercicio </title>
</head>
<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";
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
    
    header("Location:admPanelExercicios.php?eroor=Nenhum exericio foi selecionado para ser editado.");

}


?>
<style>
    input[type=file]{
        width: 157px;
        color: transparent;
        margin-right: 173px;
    }

    *{
    padding: 0;
    margin: 0;
    box-sizing: border-box;
    text-decoration: none;
    font-size: 1em;
   font-family: 'Ubuntu', sans-serif, Arial, Helvetica;,'Ubuntu', sans-serif;
    }
    

    h1{
    text-align: center;
    font-weight: 400;
    margin-top: 15px;
    color: black;
    font-size: 50px;
    font-style: normal;
    font-weight: 500;
    line-height: 110%; /* 143px */
    letter-spacing: -1.625px;
    }

    .container{
    max-width: 1200px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    
    }

    form{
    display: flex;
    flex-wrap: wrap;
    
    }

    .form-group{
    flex: 1;
    margin-bottom: 15px;
    margin: 10px ;
    width: 90%;
    
      
    }

    .form-group_btn{
    flex: 1;
    margin-bottom: 15px;
    margin: 10px;
    width: 90%;
    justify-content: end;
    align-items: end;
    display: flex;
     
    }

    #Enviar{
    background-color: #7CFC00;;
    border:none;
    color: black;
    font-size: 16px;
    padding: 10px 20px;
    border-radius: 5px;
    opacity: 0.8;
    cursor: pointer;
    }

    #Enviar:hover{
        opacity: 1;
    }

    .form-group input{
    border: 1px solid #ccc;
    padding: 8px;
    border-radius: 5px;
    font-size: 16px;
    box-sizing: border-box;
    
    
    }
    label{
        display: block;
        margin-bottom: 5px;
    }

    .container h1{
        color:#333;
        font-size: 2rem;
        text-align: center;
        margin-bottom: 20px;
        font-weight: 300;
    }

    select{
        width: 80%;
        padding: 8px;
        font-size: 15px;
        border: 1px solid #ccc;
    }

    textarea{
        width: 700px;
        height: 300px;
    }

</style>

<body>

    <h1>Cadastrar exercicio</h1>
    <section class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomeExercicio">Nome do exercicio: </label>
                <input type="text" name="nomeExercicio" placeholder="Flexão" value="<?=$fetchValues['nome']?>"><br/>
            </div>
            <div class="form-group">
                <label for="atividadeFisica">Atividade física: </label>
                <select name="atividadeFisica" id="selectAtv">
                    <option value="Academia">Academia</option>
                    <option value="Calistenia">Calistenia</option>
                    <option value="Aeróbico">Aeróbico</option>
                    <option value="Crossfit">Crossfit</option>
                    <option value="Boxe">Boxe</option>
                </select><br/>
            </div>
            <div class="form-group">
                <label for="linkTuorial">Link do tutorial: </label>
                <input type="url" name="linkTutorial" placeholder="Insira um link do youtube" pattern="https://www.youtube.com/embed/.*" size="100" required value="https://www.youtube.com/embed/<?=$fetchValues['link_tutorial']?>"><br/>
            </div>
            <div class="form-group">
            <label for="animacao">Video de animação:</label><br/>
                <input type="file" name="animacao" accept=".gif,.mp4,.mov,.webm" id="animacao" onchange="pressed()" title="Escolha um video porfavor"><label id="fileLabel"><?=$fetchValues['nome_arq']?></label><br/>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição do exercício:</label><br/>
                <textarea name="descricao" placeholder="Insira os detalhes sobre o exericio."><?=$fetchValues['descricao']?></textarea><br/>
            </div><br>
            <input type="hidden" name="idEdit" value="<?=$_POST['idEdit']?>">
            <div class="form-group_btn">
            <input type="submit" id="Enviar" value="Enviar">
            </div>
        </form>
    </section>

<script>    

<?php echo 'document.getElementById("selectAtv").value = "'.$fetchValues['ativ_fisica'].'";
            document.getElementById("natureza").value = "'.$C.'"     ;'; ?>
     

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
<?php
        // $path = getenv('DOCUMENT_ROOT');
        // include_once $path."/Olimpo_Training/teste5/layouts/header.php";
?>
</html>
             
<?=$dbh=null;