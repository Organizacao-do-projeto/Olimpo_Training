<!-- documentação sobre o sweet alert https://sweetalert.js.org/guides/#installation -->
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tese Sweet alert</title>
</head>
<?php include_once __DIR__.'/../assets/script/sweetAlert.php' ?>
<body>
    <br/>
    <br/>
    <br/>
    <br/>
    <form method="GET">
        <input type="hidden" name="error" value="Ficha de treino não foi encontrada!">
        <button type="button" onclick="swalConfirm(this)">Chama fio</button>
    </form>
</body>
<style>
    *{
        font-family: 'Ubuntu', sans-serif, Arial, Helvetica;
    }


</style>

</html>