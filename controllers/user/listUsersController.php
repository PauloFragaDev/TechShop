<?php
include_once "../../model/services/UserTechService.php";
include_once "../../model/UserTech.php";

if(session_status() === PHP_SESSION_NONE) session_start();

$_SESSION['usuarios'] = UserTechService::getAllUsers();


header("Location: ../../views/users.php");