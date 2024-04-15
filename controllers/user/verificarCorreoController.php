<?php
include_once "../../model/UserTech.php";
if(session_status() === PHP_SESSION_NONE) session_start();
include_once "../../model/services/UserTechService.php";

UserTechService::setTokenById($_GET['token'], $_GET['id']);

header('Location: ../homeController.php');
exit();