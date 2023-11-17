<?php

$corpo = '
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Corpo do email</title>
</head>
<style>
    *{
        font-family: "Ubuntu", sans-serif, Arial, Helvetica;
        font-weight: 600;
    }

    .body{
        background: linear-gradient(to right, #f0f0f0, #ede5c1, #ebdba8);
        font-family: "Ubuntu", sans-serif, Arial, Helvetica;
        font-weight: 600;

    }

    .logo_olimpo{
        max-height: 140px;
    }


    .main{
        font-family: "Ubuntu", sans-serif, Arial, Helvetica;
        font-weight: 600;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        
    }

    .mensagem{
        
    }

    
    .bt_acao{
    font-family: "Ubuntu", sans-serif, Arial, Helvetica;;
    font-size: 1.2em;
    font-weight: 600;
    background-color: goldenrod;
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
        font-family: "Ubuntu", sans-serif, Arial, Helvetica;
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
';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require_once '../src/plugins/PHPMailer/src/PHPMailer.php';
require_once '../src/plugins/PHPMailer/src/SMTP.php';
require_once '../src/plugins/PHPMailer/src/Exception.php';


$mail = new PHPMailer(true);

try{
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->IsSMTP();
    $mail->SMTPAuth = true;
    // $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; //caso dê errado tentar este
    $mail->Host = 'smtp-mail.outlook.com';
    $mail->Port = 587;
    $mail->Username = 'olimpo_training@outlook.com';            // Change here
    $mail->Password = "2023_PCC";            // Change here
    $mail->setFrom('olimpo_training@outlook.com', 'Olimpo Training');    // Change here remetente
    $mail->addAddress('olimpo_training@outlook.com');           // Change here destinatário
    $mail->isHTML(true);
    $mail->CharSet = 'utf-8';
    $mail->Subject = 'Conta autenticada';
    $mail->Body = $corpo;
    $mail->AltBody = "Texto alternativo ao original!.";

    echo $mail->Send();
    echo 'Email enviado com sucesso!';


}catch(Exception $e){
    echo "Não foi possível enviar a mensagem. Mailer error: {$mail->ErroInfo()}";
}