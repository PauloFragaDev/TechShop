<?php
include_once "../../model/ProductTech.php";
include_once "../../model/services/ProductTechService.php";
if(session_status() === PHP_SESSION_NONE) session_start();

if (!$_POST){
    header("Location: ../../views/addProduct.php");
    exit();
}

$filename = explode(".",$_FILES['image']['name']);
$_SESSION['errorsAddProduct'] = array();

if (empty($_POST['name'])) {
    $_SESSION['errorsAddProduct']['nameEmpty'] = "El campo Name esta vacio.";
}
if (empty($_POST['brand'])) {
    $_SESSION['errorsAddProduct']['brandEmpty'] = "El campo Brand esta vacio.";
}
if (empty($_POST['price'])) {
    $_SESSION['errorsAddProduct']['priceEmpty'] = "El campo Price esta vacio.";
}

if (empty($_FILES['image']['name'])){
    $_SESSION['errorsAddProduct']['imageEmpty'] = "No ha seleccionado una imagen.";
}

if (!empty(ProductTechService::checkFile($filename[0]))){
    $_SESSION['errorsAddProduct']['filenameDuplicate'] = "Ya hay una imagen igual.";
}

if (count($_SESSION['errorsAddProduct'])>0) {
    header('Location: ../../views/addProduct.php');
    exit();
}

$target_dir = "../../views/uploads/products/";
$target_file = $target_dir . basename($_FILES['image']['name']);
$check = getimagesize($_FILES['image']['tmp_name']);

if(!$check){
    echo 'hi ha hagut un error';
}
$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
$product = new ProductTech($_POST['brand'],$_POST['name'],$_POST['price'],$filename[0]);
ProductTechService::addProduct($product);
header('Location: listProductsController.php');
exit();