<?php
include_once "../../model/ProductTech.php";
include_once "../../model/services/ProductTechService.php";
if(session_status() === PHP_SESSION_NONE) session_start();


if (!$_POST){
    $_SESSION['editProduct'] = ProductTechService::getProductById($_GET['id']);
    header('Location: ../../views/editProduct.php');
    exit();
}

$_SESSION['errorsEditProduct'] = array();

$name = $_POST['name'];
$brand = $_POST['brand'];
$price = $_POST['price'];

if (empty($_POST['name'])) {
    $_SESSION['errorsEditProduct']['nameEmpty'] = "El campo Name esta vacio.";
}
if (empty($_POST['brand'])) {
    $_SESSION['errorsEditProduct']['brandEmpty'] = "El campo Brand esta vacio.";
}
if (empty($_POST['price'])) {
    $_SESSION['errorsEditProduct']['priceEmpty'] = "El campo Price esta vacio.";
}

if (count($_SESSION['errorsEditProduct']) > 0) {
    header('Location: editProductController.php');
    exit();
}

if (empty($_FILES['image']['name'])) {
    $filename = $_SESSION['editProduct']->getFilename();
    $product = new ProductTech($brand,$name,$price,$filename);
    $product->setIdProduct($_SESSION['editProduct']->getIdProduct());
    ProductTechService::updateProduct($product);
    header('Location: listProductsController.php');
    exit();
}

$filename = explode(".",$_FILES['image']['name']);

if (!empty(ProductTechService::checkFile($filename[0]))){
    $_SESSION['errorsAddProduct']['filenameDuplicate'] = "Ya hay una imagen igual.";
    header('Location: ../../views/editProduct.php');
    exit();
}

$target_dir = "../../views/uploads/products/";
$target_file = $target_dir . basename($_FILES['image']['name']);
$check = getimagesize($_FILES['image']['tmp_name']);

if(!$check){
    echo 'hi ha hagut un error';
}
$resultat = move_uploaded_file($_FILES['image']['tmp_name'],$target_file);
$product = new ProductTech($brand,$name,$price,$filename[0]);
$product->setIdProduct($_SESSION['editProduct']->getIdProduct());
ProductTechService::updateProduct($product);
header('Location: listProductsController.php');
exit();