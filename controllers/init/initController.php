<?php

include_once "../../model/services/InitService.php";

if(session_status() === PHP_SESSION_NONE) session_start();

InitService::dropTables();
InitService::createTables();
InitService::foreignKeysTables();
InitService::createUsers();
InitService::createProducts();
InitService::createPaySystem();
unset($_SESSION['userLogged']);

header("Location: ../homeController.php");