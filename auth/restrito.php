<?php

    $usuario = $_SESSION['dadosUsuario'] ?? null;
    if (!$usuario) {
        session_destroy();
        header("location: ../index.php?error=Usuário sem permissão!");
        exit();
    }

    function isPersonal($perfil){
        if($perfil != 'PERSONAL-TRAINER' || $perfil != 'ADMINISTRADOR'){
            header('Location: ../index.php?error=Você não é um Personal trainer.');        
            exit();
        };
    }

    function isPersonalAuth($autenticado){
        if($autenticado != 1 ){
            header('Location: ../index.php?error=Você ainda não foi autenticado na plataforma.');        
            exit();
        };
    }

    function isAluno($perfil){
        if( $perfil != 'ALUNO' || $perfil != 'ADMINISTRADOR' ){
            header('Location: ../index.php?error=Você não tem permissão para acessar esse site.');
            exit();
        };
    }

    function isAdministrador($perfil){
        if( $perfil != 'ADMINISTRADOR' ){
            header('Location: ../index.php?error=Você não tem permissão para acessar esse site.');
            exit();
        };
    }
