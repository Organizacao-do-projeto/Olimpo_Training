<style>
    main{
        height: 100vh;
        width: 100%;
        display: flex;
        justify-content: center;
        align-items: center;

    }

    .links{
        display: flex;
        justify-content: center;
        align-items: center;
        
    }

    .wraper_user_selcts{
        display: flex;
        justify-content: center;

    }

    .user_selects{
        text-decoration: none;
        width: 400px;
        height: 400px;
        display: flex;
        justify-content: center;
    }

</style>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/css/boot.css">
    <title>Selecionar listagem de usuario</title>
</head>
<body>
    <h1>Listar usuarios</h1>
    <main>

    <h2>Selecione o tipo de usuario</h2>


    <a href="../usuarioComum/index.php" class="user_selects">Comum</a>
    <a href="../usuarioAluno/index.php" class="user_selects">Aluno</a>
    <a href="../usuarioPersonal/index.php" class="user_selects">Personal</a>

    </main>
</body>
</html>