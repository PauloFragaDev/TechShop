<?php
include_once "../../model/UserTech.php";
include_once "../../model/services/UserTechService.php";
include_once "../../model/ProductTech.php";
include_once "../../model/services/ProductTechService.php";
include_once "../../model/Factura.php";
include_once "../../model/services/FacturaService.php";

if (session_status() === PHP_SESSION_NONE) session_start();

$_SESSION['facturas'] = FacturaService::getFacturas();


header('Location: ../../views/orders.php');