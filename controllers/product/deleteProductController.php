<?php

include_once "../../model/services/ProductTechService.php";

if (session_status() === PHP_SESSION_NONE) session_start();

$idProduct = $_GET['id'];

ProductTechService::deleteProduct($idProduct);

header('Location: listProductsController.php');