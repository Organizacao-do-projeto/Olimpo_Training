<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Adicionar Exercício </title>
</head>

<?php
        $path = getenv('DOCUMENT_ROOT');
        include_once $path."/Olimpo_Training/layouts/header.php";

isset($_POST['nomeExercicio']) ? $nomeExercicio = $_POST['nomeExercicio'] : $nomeExercicio = "";
// $nomeExercicio = isset($_POST['nomeExercicio']) ?? "";
isset($_POST['atividadeFisica']) ? $atividadeFisica = $_POST['atividadeFisica'] : $atividadeFisica = "";
isset($_POST['linkTutorial']) ? $linkTutorial = $_POST['linkTutorial'] : $linkTutorial = "" ;
isset($_POST['descricao']) ? $descricao = $_POST['descricao'] : $descricao = "";
isset($_FILES['animacao']) ? $animacao = $_FILES['animacao'] : $animacao = "";



if(!empty($nomeExercicio && $atividadeFisica && $linkTutorial && $descricao) && $animacao['size'] > 0){
    
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
            
            $query = " SELECT * FROM olimpo.exercicios WHERE nome_arq = :nome_arq ; ";
            
            $stmt = $dbh->prepare($query);
            $stmt->bindParam(":nome_arq", $nomeAnimacao);
            $stmt->execute();
            $stmt->fetch();
            $qntRegistros = $stmt->rowCount();

            //verifica se já existe no banco de dados
            if($qntRegistros <= 0){
                
                if(verificaFormato($extensaoArquivo)){
                    //verifica tamanho do arquivo
                    if($animacao['size'] < $tamanhoPermitido){
                        move_uploaded_file($animacao['tmp_name'], $caminhoExercicio);

                        $queryAddExercicio = "INSERT INTO olimpo.exercicios ( nome, ativ_fisica, link_tutorial, descricao, nome_arq)
                        VALUES( :nome, :ativ_fisica, :link_tutorial, :descricao, :nome_arq );";

                        $stmtexercicios = $dbh->prepare($queryAddExercicio);
                        $stmtexercicios->bindParam(':nome', $nomeExercicio);
                        $stmtexercicios->bindParam(':ativ_fisica', $atividadeFisica);
                        $stmtexercicios->bindParam(':link_tutorial', $linkExtraido);
                        $stmtexercicios->bindParam(':descricao', $descricao);
                        $stmtexercicios->bindParam(':nome_arq', $nomeAnimacao);
                        $stmtexercicios->execute();

                        echo "Exercício adicionado com sucesso!";
                    
                        }else{
                            echo "Tamanho excedido!";
                        }
                    }else{
                        echo "Não permitido!";
                    };
                }else{
                    echo "Arquivo já existe no site!";
                }

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


?>
<style>
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

<a href="admPanelExercicios.php" alt="voltar"><img height="60px" src="../views/assets/img/voltar.svg"></a>

    <h1>Cadastrar Exercício</h1>
    <section class="container">
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nomeExercicio">Nome do Exercício: </label>
                <input type="text" name="nomeExercicio" placeholder="Flexão"><br/>
            </div>
            <div class="form-group">
                <label for="atividadeFisica">Atividade Física: </label>
                <select name="atividadeFisica">
                    <option value="Academia">Academia</option>
                    <option value="Calistenia">Calistenia</option>
                    <option value="Aeróbico">Aeróbico</option>
                    <option value="Crossfit">Crossfit</option>
                    <option value="Boxe">Boxe</option>
                </select><br/>
            </div>
            <div class="form-group">
                <label for="linkTuorial">Link do Tutorial: </label>
                <input type="url" name="linkTutorial" placeholder="Insira um link do youtube" pattern="https://www.youtube.com/embed/.*" size="100" required><br/>
            </div>
            <div class="form-group">
                <label for="animacao">Video de Animação:</label><br/>
                <input type="file" name="animacao" accept=".gif,.mp4,.mov,.webm" ><br/>
            </div>
            <div class="form-group">
                <label for="descricao">Descrição do Exercício:</label><br/>
                <textarea name="descricao" placeholder="Insira os detalhes sobre o exericio."></textarea><br/>
            </div><br>
            <div class="form-group_btn">
            <input type="submit" id="Enviar" value="Enviar">
            </div>
        </form>
    </section>
    
</body>

<?php
        // $path = getenv('DOCUMENT_ROOT');
        // include_once $path."/Olimpo_Training/teste5/layouts/footer.php";
?>
</html>
             
<?=$dbh=null;