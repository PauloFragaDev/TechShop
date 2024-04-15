<?php
include_once "../../model/Repair.php";
include_once "../../model/services/RepairService.php";
if(session_status() === PHP_SESSION_NONE) session_start();

$repair = RepairService::getRepairById($_GET['idRepair']);

if ($repair->getStatus() == 'enviado'){
    $repair->setStatus("entregado");
}
if ($repair->getStatus() == 'reparacion'){
    $repair->setStatus("enviado");
}

$newRepair = new Repair($repair->getIdUser(),$repair->getIdProduct(),$repair->getIdPedido(),$repair->getStatus());
$newRepair->setIdRepair($repair->getIdRepair());
RepairService::updateRepair($newRepair);

header('Location: ../product/listProductsController.php');
exit();