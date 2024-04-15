<?php
include_once "../../model/UserTech.php";
include_once "../../model/Repair.php";
include_once "../../model/ProductTech.php";
include_once "../../model/services/FacturaService.php";
include_once "../../model/services/ProductTechService.php";
include_once "../../model/services/RepairService.php";

if (session_status() === PHP_SESSION_NONE) session_start();

if (!$_GET) {
    unset($_SESSION['userRepairs']);
    $arrayAuxRep = RepairService::getRepairUser($_SESSION['userLogged']->getIdUser());
    $arrayFacTemp = FacturaService::getProductFacturaByUserId($_SESSION['userLogged']->getIdUser());
    foreach ($arrayFacTemp as $key => $fac) {
        $tempX = 0;
        $producto = ProductTechService::getProductById($fac[0]);
        foreach ($arrayAuxRep as $repair) {
            if ($repair->getIdPedido() == $fac[5] && $repair->getIdProduct() == $producto->getIdProduct()) {
                $tempX = 1;
                break;
            }
        }
        if ($tempX == 0) {
            $_SESSION['userRepairs'][$key] = array($producto, $fac[5]);
        }
    }
    header('Location: ../../views/repairProduct.php');
    exit();
}
$repair = new Repair($_SESSION['userLogged']->getIdUser(), $_GET['idProducto'], $_GET['idPedido'], 'reparacion');
RepairService::addRepair($repair);
header('Location: addRepairController.php');
exit();