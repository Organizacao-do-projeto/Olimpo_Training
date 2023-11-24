<?php

    $usuario = $_SESSION['dadosUsuario'] ?? null;
    if (!$usuario) {
        session_destroy();
        header("location: ../index.php?error=Faça o login!");
        exit();
    }

    // redireciona se precisar, senão só verifica se é o tipo de usuario
    function isPersonal($perfil, $autenticado, $redirect = false ){
        if($perfil != "PERSONAL-TRAINER" && $perfil != "ADMINISTRADOR"){
            if($redirect){
                header('Location: ../index.php?error=Ops! Você não é um Personal trainer.');        
                exit();
            }else{
                return false;
            }
        }else{
            if($perfil == "ADMINISTRADOR") $autenticado = 1;
            return isPersonalAuth($autenticado, $redirect);
        };
    }

    function isPersonalAuth($autenticado, $redirect){
        //colocar uma condição de autenticado
        if($autenticado != 1 ){
            // verifica se precisa redirecionar
            if($redirect){
                header('Location: ../index.php?error=Você ainda não foi autenticado na plataforma.');        
                exit();
            }else{
                return false;
            }
        }else{//é autenticado
            return true;
        };

    }

    function isAluno($perfil, $redirect = false){
        if($perfil != 'ALUNO' && $perfil != 'ADMINISTRADOR'){
            if($redirect){
                header('Location: ../index.php?error=Sem permissão para acessar essa página.');        
                exit();
            }else{
                return false;
            }
        }else{
            return true;
        };
    }

    function isAdmin($perfil, $redirect = false){
        if($perfil != 'ADMINISTRADOR'){
            if($redirect){
                header('Location: ../index.php?error=Sem permissão para acessar essa página.');
                exit();
            }else{
                return false;
            }
        }else{
            return true;
        };
    }
