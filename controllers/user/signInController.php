<?php
include_once "../../model/UserTech.php";
include_once "../../model/services/UserTechService.php";
include_once "../../conf.php";
if(session_status() === PHP_SESSION_NONE) session_start();

if (!$_POST){
    header("Location: ../../views/signin.php");
    exit();
}

$email = $_POST['email'];
$password = $_POST['password'];

$_SESSION['errorsSignIn'] = array();

if (empty($_POST['email'])) {
    $_SESSION['errorsSignIn']['emailEmpty'] = "El campo Email esta vacio.";
}
if (empty($_POST['password'])) {
    $_SESSION['errorsSignIn']['fullNameEmpty'] = "El campo Password esta vacio.";
}
if (empty(UserTechService::getUserByEmail($email))){
    $_SESSION['errorsSignIn']['emailNoResolve'] = "Email erroneo.";
}
if (count($_SESSION['errorsSignIn'])>0) {
    header('Location: ../../views/signin.php');
    exit();
}

$user = UserTechService::getUserByEmail($email);

$pepper = getPepper();
$p_peppered = hash_hmac('sha256', $password,$pepper);

if (!password_verify($p_peppered,$user->getPassword())){
    $_SESSION['errorsSignIn']['passwordError'] = "Password Incorrecto.";
    header('Location: ../../views/signIn.php');
    exit();
}

$_SESSION['userLogged'] = $user;
header('Location: ../../views/home.php');
exit();