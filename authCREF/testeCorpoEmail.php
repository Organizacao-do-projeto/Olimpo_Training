<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corpo do email</title>
</head>
<style>
    *{
        font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
        font-weight: 600;
    }

    .body{
        background: linear-gradient(to right, #f0f0f0, #ede5c1, #ebdba8);
        font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
        font-weight: 600;

    }

    .logo_olimpo{
        max-height: 140px;
    }


    .main{
        font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        
    }

    .mensagem{
        
    }

    
    .bt_acao{
    font-family: 'Ubuntu', sans-serif, Arial, Helvetica;;
    font-size: 1.2em;
    font-weight: 600;
    background-color: radial-gradient(circle at 10% 20%, rgb(255, 200, 124) 0%, rgb(252, 251, 121) 90%);
    border: transparent;
    border-radius: 10px;
    height: 30px;
    color: black;
    cursor: pointer;
    margin: 20px;
    padding: 13px;
    box-shadow: 7px 7px 13px 0px rgba(50, 50, 50, 0.22);
    text-decoration: none;

    }

    .footer,.header{
        background: goldenrod;
        width: 100%;
        height: 40px;
        color: white;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8em;
        font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
        font-weight: 600;
    }

</style>
<body>
    <div class="body">
        <div class="header">
        </div>
        <div class="main">
            <h1>Conta autenticada</h1>
            <p class="mensagem">
            Parabéns, Seu CREF foi autenticado com sucesso!
            </p>
            <a class="bt_acao" href="http://localhost/Olimpo_Training/index.php">Começe agora!</a>
        </div>
        <div class="footer">
            Todos direitos reservardos a Olimpo Training®️
        </div>
    </div>

</body>
</html>
