<?php

include_once "../../model/UserTech.php";
include_once "../../model/ProductTech.php";
include_once "../../model/Repair.php";
include_once "../../model/services/UserTechService.php";
include_once "../../conf.php";
include_once "../../model/services/FacturaService.php";
include_once "../../model/services/RepairService.php";
include_once "../../model/services/ProductTechService.php";

if (session_status() === PHP_SESSION_NONE) session_start();
unset($_SESSION['ordersUser']);
unset($_SESSION['repairsUser']);
$_SESSION['ordersUser'] = FacturaService::getProductFacturaByUserId($_SESSION['userLogged']->getIdUser());
$arrayAux = RepairService::getRepairUser($_SESSION['userLogged']->getIdUser());
foreach ($arrayAux as $key => $repair){
    $producto = ProductTechService::getProductById($repair->getIdProduct());
    $_SESSION['repairsUser'][$key] = array($producto,$repair->getStatus());
}

if (!$_POST) {
    header('Location: ../../views/profile.php');
    exit();
}

$_SESSION['errorsProfiles'] = array();

if (isset($_POST['btnSave'])) {
    $name = $_POST['fullnameProfile'];
    $email = $_POST['emailProfile'];
    $password = $_POST['passwordProfile'];

    if (empty($_POST['emailProfile'])) {
        $_SESSION['errorsProfiles']['emailEmpty'] = "El campo Email esta vacio.";
    }
    if (empty($_POST['fullnameProfile'])) {
        $_SESSION['errorsProfiles']['fullnameEmpty'] = "El campo Fullname esta vacio.";
    }
    if (!empty(UserTechService::getUserByEmail($email)) && $_POST['emailProfile'] != $_SESSION['userLogged']->getEmail()) {
        $_SESSION['errorsProfiles']['emailUsed'] = "El Email esta en uso.";
    }

    if (count($_SESSION['errorsProfiles']) > 0) {
        header('Location: ../../views/profile.php');
        exit();
    }

    if (empty($_POST['passwordProfile'])) {
        if (empty($_FILES['image']['name'])) {
            $filename = $_SESSION['userLogged']->getFilename();
            $user = new UserTech($email, $_SESSION['userLogged']->getPassword(), $name, $filename);
            $user->setIdUser($_SESSION['userLogged']->getIdUser());
            UserTechService::updateUser($user);
            $_SESSION['userLogged'] = UserTechService::getUserByEmail($email);
            header('Location: profileController.php');
            exit();
        }
        $target_dir = "../../views/uploads/profiles/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        $filename = explode(".", $_FILES['image']['name']);

        $user = new UserTech($email, $_SESSION['userLogged']->getPassword(), $name, $filename[0]);
        $user->setIdUser($_SESSION['userLogged']->getIdUser());
        UserTechService::updateUser($user);
        $_SESSION['userLogged'] = UserTechService::getUserByEmail($email);
        header('Location: profileController.php');
        exit();
    }
    $pepper = getPepper();
    $p_peppered = hash_hmac('sha256', $password, $pepper);
    if (password_verify($p_peppered, $_SESSION['userLogged']->getPassword())) {
        $_SESSION['errorsProfiles']['passwordSame'] = "No introduzca la misma contraseña";
        header('Location: ../../views/profile.php');
        exit();
    }
    $pass_hashed = password_hash($p_peppered, PASSWORD_BCRYPT);
    if (!empty($_FILES['image']['name'])) {

        $target_dir = "../../views/uploads/profiles/";
        $target_file = $target_dir . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

        $filename = explode(".", $_FILES['image']['name']);

        $user = new UserTech($email, $pass_hashed, $name, $filename[0]);
        $user->setIdUser($_SESSION['userLogged']->getIdUser());
        UserTechService::updateUser($user);
        $_SESSION['userLogged'] = UserTechService::getUserByEmail($email);
        header('Location: profileController.php');
        exit();
    }

    $filename = $_SESSION['userLogged']->getFilename();
    $user = new UserTech($email, $pass_hashed, $name, $filename);
    $user->setIdUser($_SESSION['userLogged']->getIdUser());
    UserTechService::updateUser($user);
    $_SESSION['userLogged'] = UserTechService::getUserByEmail($email);
    header('Location: profileController.php');
    exit();
}

if (isset($_POST['btnDeleteUser'])) {
    $emailDelete = $_POST['emailDeleter'];
    if ($emailDelete != $_SESSION['userLogged']->getEmail()) {
        $_SESSION['errorsProfiles']['differentEmail'] = 'No ha introducido el email correctamente.';
        header('LOCATION: ../../views/profile.php');
        exit();
    }
    UserTechService::deleteUser($_SESSION['userLogged']->getIdUser());
    header('LOCATION: logoutController.php');
    exit();
}
