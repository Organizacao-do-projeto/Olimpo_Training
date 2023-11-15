<?php

    $usuario = $_SESSION['dadosUsuario'] ?? null;
    if (!$usuario) {
        session_destroy();
        header("location: ../index.php?error=Usuário sem permissão!");
        exit;
    }