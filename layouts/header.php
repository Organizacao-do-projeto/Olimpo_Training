<?php

    //força a página a usar UTF-8 por PHP
    ini_set('default_charset', 'utf-8');

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@300;400;500&display=swap" rel="stylesheet">
    <link href="css/boot.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/fonticon.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/modal.css">
    <link rel="stylesheet" href="../assets/css/login.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/boot.css">
</head>
<!-- incluindo sweet alert para aparecer as mensagens -->
<?php include_once __DIR__.'/../assets/script/sweetAlert.php'; ?>
<body>
    <!--DOBRA CABEÇALHO-->

    <header class="main_header">
        <div class="main_header_content">
            <a href="/Olimpo_Training/views/index.php">
                <img src="../assets/img/logos/logo_borda.png" alt="Olimpo Training" title="Olimpo Training"></a>
            <h4>Olimpo Training</h4>

            <nav class="main_header_content_menu">
                <ul>
                    <li><a href="/Olimpo_Training/views/index.php">Home</a></li>
                    <li><a href="/Olimpo_Training/exercicios/index.php">Exercícios</a></li>
                    <li><a href="/Olimpo_Training/fichaDeTreino/index.php">Treinos</a></li>
                    <li><a href="/Olimpo_training/views/sele.html">Cadastre-se</a></li>
                    <li><a href="/Olimpo_Training/auth/logout.php" class="modal-link">Logout</a></li>
                </ul>
            </nav>
        </div>
</header>
    <!--POP LOGIN-->
    <?php if (isset($_GET['msg']) || isset($_GET['error'])) : ?>
                        <div align="center" class="<?= (isset($_GET['error']) ? 'msg__success' : 'msg__error') ?>">
                            <p><font color="red"><?= $_GET['msg'] ?? $_GET['error'] ?></font></p>
                        </div>
    <?php endif; ?>


    <div class="overlay"></div>
    <div class="modal">
        <div class="div_login">
            <h1>Login</h1>
            <br>
            <form action="auth/login.php" method="post">
                <input type="email" name="email" placeholder="Nome" class="input" required>
                <br><br>
                <input type="password" name="password" placeholder="Senha" class="input" required>
                <br><br>
                <button class="button">Enviar</button>
            </form>
        </div>
    </div>
</body>

</html>