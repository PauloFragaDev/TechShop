<?php

include_once "../../model/services/ProductTechService.php";
include_once "../../model/services/UserTechService.php";
include_once "../../model/ProductTech.php";
include_once "../../model/UserTech.php";
include_once "../../model/Repair.php";
include_once "../../model/services/RepairService.php";

if(session_status() === PHP_SESSION_NONE) session_start();
unset($_SESSION['products']);
unset($_SESSION['repairs']);
$_SESSION['products'] = ProductTechService::getAllProducts();
$arrayAux = RepairService::getAllRepairs();
foreach ($arrayAux as $key => $repair){
    $producto = ProductTechService::getProductById($repair->getIdProduct());
    $user = UserTechService::getUserById($repair->getIdUser());
    $_SESSION['repairs'][$key] = array($producto,$user,$repair);
}

header("Location: ../../views/products.php");