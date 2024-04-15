<?php
include_once "../../model/UserTech.php";
include_once "../../model/services/UserTechService.php";
include_once "../../model/Order.php";
include_once "../../model/services/OrderService.php";
include_once "../../model/Carrito.php";
include_once "../../model/services/CarritoService.php";
include_once "../../conf.php";
include_once '../../PHPMailer-master/src/PHPMailer.php';
include_once '../../PHPMailer-master/src/Exception.php';
include_once '../../PHPMailer-master/src/SMTP.php';
include_once '../../model/services/Mailer.php';
include_once '../../model/services/MailService.php';

if (session_status() === PHP_SESSION_NONE) session_start();

if (!$_POST) {
    header("Location: ../../views/addUser.php");
    exit();
}

$name = $_POST['fullname'];
$email = $_POST['email'];
$pass = $_POST['password'];

$_SESSION['errorsAddUser'] = array();

if (empty($_POST['email'])) {
    $_SESSION['errorsAddUser']['emailEmpty'] = "El campo Email esta vacio.";
}
if (empty($_POST['fullname'])) {
    $_SESSION['errorsAddUser']['passEmpty'] = "El campo Password esta vacio.";
}
if (empty($_POST['password'])) {
    $_SESSION['errorsAddUser']['fullNameEmpty'] = "El campo Full Name esta vacio.";
}

if (empty($_FILES['image']['name'])) {
    $_SESSION['errorsAddUser']['imageEmpty'] = "No ha seleccionado una imagen.";
}

if (!empty(UserTechService::getUserByEmail($email))) {
    $_SESSION['errorsAddUser']['emailDuplicate'] = "El Email esta en uso.";
}

if ($_FILES['image']['type'] != "image/png") {
    $_SESSION['errorsAddUser']['extensioImg'] = "La extension no es png.";
}

if (count($_SESSION['errorsAddUser']) > 0) {
    header('Location: ../../views/signup.php');
    exit();
}

$target_dir = "../../views/uploads/profiles/";
$target_file = $target_dir . basename($_FILES['image']['name']);
$check = getimagesize($_FILES['image']['tmp_name']);

if (!$check) {
    echo 'hi ha hagut un error';
}

$resultat = move_uploaded_file($_FILES['image']['tmp_name'], $target_file);

$filename = explode(".", $_FILES['image']['name']);

$pepper = hash_hmac("sha256", $pass, getPepper());

$pass_hashed = password_hash($pepper, PASSWORD_BCRYPT);

$user = new UserTech($email, $pass_hashed, $name, $filename[0]);
$user->setVerified(1);

UserTechService::addUser($user);
$aux = UserTechService::getUserByEmail($email);
$user->setIdUser($aux->getIdUser());
$user->setToken(bin2hex(random_bytes(30)));
MailService::sendVerifyEmail($user);
CarritoService::addCarrito($aux->getIdUser());
OrderService::addOrder($aux->getIdUser());

header("Location: listUsersController.php");
exit();