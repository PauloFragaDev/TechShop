<?php
include_once "../../model/Carrito.php";
include_once "../../model/Order.php";
include_once "../../model/ProductTech.php";
include_once "../../model/CarritoItem.php";
include_once "../../model/Factura.php";
include_once "../../model/UserTech.php";
include_once "../../model/services/CarritoService.php";
include_once "../../model/services/OrderService.php";
include_once "../../model/services/ProductTechService.php";
include_once "../../model/services/CarritoItemService.php";
include_once "../../model/services/FacturaService.php";

if (session_status() === PHP_SESSION_NONE) session_start();

$carrito = CarritoService::getCarritoUser($_SESSION['userLogged']->getIdUser());
$order = OrderService::getOrderUser($_SESSION['userLogged']->getIdUser());
$items = CarritoItemService::getByUser($order->getIdOrder(),$carrito->getIdCarrito());

$_SESSION['cesta'] = array();
$_SESSION['totalMount'] = 0;

foreach ($items as $key => $itemCar){
    $product = ProductTechService::getProductById($itemCar->getIdProducto());
    $_SESSION['cesta'][$key] = $product;
    $_SESSION['totalMount'] = $_SESSION['totalMount'] + $product->getPrice();
}

if (!$_POST && !$_GET){
    header('LOCATION: ../../views/payment.php');
    exit();
}

if ($_POST){
    $factura = new Factura($carrito->getIdCarrito(),$order->getIdOrder(),$_SESSION['totalMount']);
    FacturaService::addFactura($factura);
    OrderService::addOrder($_SESSION['userLogged']->getIdUser());
    $_SESSION['payComplete'] = array();
    $_SESSION['payComplete']['pay'] = "Se realizo la compra";
    header('Location: ../homeController.php');
    exit();
}

if ($_GET){
    $_SESSION['errorHome'] = array();
    $product = ProductTechService::getProductById($_GET['id']);
    if (!empty(CarritoItemService::checkProduct($_GET['id'],$carrito->getIdCarrito(),$order->getIdOrder()))){
        $_SESSION['errorHome']['productExist'] = "El producto ya esta en tu cesta";
        header('Location: ../homeController.php');
        exit();
    }
    $item = new CarritoItem($carrito->getIdCarrito(),$product->getIdProduct(),$order->getIdOrder());
    CarritoItemService::createItem($item);
    header('LOCATION: payController.php');
    exit();
}