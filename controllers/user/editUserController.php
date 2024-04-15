<?php

include_once "../../model/UserTech.php";
include_once "../../model/services/UserTechService.php";
include_once "../../conf.php";

if (session_status() === PHP_SESSION_NONE) session_start();

if (!$_POST) {
    $emailUserGet = $_GET['email'];
    $user = UserTechService::getUserByEmail($emailUserGet);
    $_SESSION['userEdit'] = $user;
    header("Location: ../../views/editUser.php");
    exit();
}

$_SESSION['errorsEditUser'] = array();

$name = $_POST['fullname'];
$email = $_POST['email'];
$oldPass = $_POST['oldPassword'];
$newPass = $_POST['newPassword'];

if (empty($_POST['email'])) {
    $_SESSION['errorsEditUser']['emailEmpty'] = "El campo Email esta vacio.";
}
if (empty($_POST['fullname'])) {
    $_SESSION['errorsEditUser']['fullnameEmpty'] = "El campo Fullname esta vacio.";
}

if (!empty(UserTechService::getUserByEmail($email)) && $_POST['email'] != $_SESSION['userEdit']->getEmail()) {
    $_SESSION['errorsEditUser']['emailUsed'] = "El Email esta en uso.";
}

if (empty($_POST['oldPassword']) && !empty($_POST['newPassword'])) {
    $_SESSION['errorsEditUser']['emptyOldPass'] = "Necesita introducir su antigua contraseña para poder cambiarla.";
}

if (!empty($_POST['oldPassword']) && empty($_POST['newPassword'])) {
    $_SESSION['errorsEditUser']['emptyNewPass'] = "Necesita introducir una nueva contraseña para cambiarla.";
}

if (count($_SESSION['errorsEditUser']) > 0) {
    header('Location: ../../views/editUser.php');
    exit();
}

if (empty($_POST['oldPassword']) && empty($_POST['newPassword'])) {
    if (empty($_FILES['image']['name'])) {
        $filename = $_SESSION['userEdit']->getFilename();
        $user = new UserTech($email, $_SESSION['userEdit']->getPassword(), $name, $filename);
        $user->setIdUser($_SESSION['userEdit']->getIdUser());
        UserTechService::updateUser($user);
        header('Location: listUsersController.php');
        exit();
    }

    $target_dir = "../../views/uploads/profiles/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $filename = explode(".", $_FILES['image']['name']);

    $user = new UserTech($email, $_SESSION['userEdit']->getPassword(), $name, $filename[0]);
    $user->setIdUser($_SESSION['userEdit']->getIdUser());
    UserTechService::updateUser($user);

    header('Location: listUsersController.php');
    exit();
}

$pepper = getPepper();
$p_peppered = hash_hmac('sha256', $newPass, $pepper);
$p_peppered2 = hash_hmac('sha256', $oldPass, $pepper);

if (!password_verify($p_peppered2, $_SESSION['userEdit']->getPassword())) {
    $_SESSION['errorsEditUser']['noEqualsPasswords'] = "La contraseña no coincide con la del usuario.";
    header('Location: ../../views/editUser.php');
    exit();
}
if (password_verify($p_peppered, $_SESSION['userEdit']->getPassword())) {
    $_SESSION['errorsEditUser']['passwordSame'] = "No introduzca la misma contraseña";
    header('Location: ../../views/editUser.php');
    exit();
}

$pass_hashed = password_hash($p_peppered, PASSWORD_BCRYPT);

if (!empty($_FILES['image']['name'])) {
    $target_dir = "../../views/uploads/profiles/";
    $target_file = $target_dir . basename($_FILES['image']['name']);
    move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

    $filename = explode(".", $_FILES['image']['name']);

    $user = new UserTech($email, $pass_hashed, $name, $filename[0]);
    $user->setIdUser($_SESSION['userEdit']->getIdUser());
    UserTechService::updateUser($user);

    header('Location: listUsersController.php');
    exit();
}

$filename = $_SESSION['userEdit']->getFilename();
$user = new UserTech($email, $pass_hashed, $name, $filename);
$user->setIdUser($_SESSION['userEdit']->getIdUser());
UserTechService::updateUser($user);
header('Location: listUsersController.php');
exit();
