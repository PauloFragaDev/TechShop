<?php

include_once "../model/services/ProductTechService.php";
include_once "../model/ProductTech.php";

if(session_status() === PHP_SESSION_NONE) session_start();

$_SESSION['products'] = ProductTechService::getAllProducts();

if (!$_POST){
    header("Location: ../views/home.php");
}