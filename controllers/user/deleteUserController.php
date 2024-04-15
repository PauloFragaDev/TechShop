<?php

include_once "../../model/services/UserTechService.php";
if (session_status() === PHP_SESSION_NONE) session_start();
$idUser = $_GET['id'];

UserTechService::deleteUser($idUser);

header('Location: listUsersController.php');