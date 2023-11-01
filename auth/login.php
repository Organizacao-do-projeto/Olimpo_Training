<?php
session_start();
require_once __DIR__ . '/../src/dao/usuariodao.php';

$email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
$password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_SPECIAL_CHARS);

$passwordCrypto = md5($password);

// var_dump($email, $password, $passwordCrypto); exit;

$dao = new UsuarioOl(); /*Alteração no Usuario*/
$usuario = $dao->login($email, $passwordCrypto);

var_dump($usuario);

if (!$usuario) {
    header("location: ../index.php?error=Login ou senha inválidos!");
    exit;
}
// $_SESSION['dadosUsuario'] = array(  /*Alteração no direcionamento para a tabela "usuarios" */
//     'id' => $usuario['id'],
//     'nome' => $usuario['nome'],
//     'email' => $usuario['email'],
//     'perfil' => $usuario['idPerfis'],
//     'foto' => $usuario['foto']

// );
$_SESSION['dadosUsuario'] = $usuario;

header("location: ../views/index.php");
 /*Alteração no Destino*/


