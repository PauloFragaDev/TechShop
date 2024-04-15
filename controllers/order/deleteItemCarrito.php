<?php
include_once "../../model/UserTech.php";
include_once "../../model/Carrito.php";
include_once "../../model/Order.php";
include_once "../../model/services/CarritoService.php";
include_once "../../model/services/OrderService.php";
include_once "../../model/services/CarritoItemService.php";

if (session_status() === PHP_SESSION_NONE) session_start();
$carrito = CarritoService::getCarritoUser($_SESSION['userLogged']->getIdUser());
$order = OrderService::getOrderUser($_SESSION['userLogged']->getIdUser());
CarritoItemService::deleteItem($_GET['id'],$carrito->getIdCarrito(),$order->getIdOrder());

header('LOCATION: payController.php');
exit();