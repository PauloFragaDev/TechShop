<?php

if (session_status() === PHP_SESSION_NONE) session_start();

unset($_SESSION['userLogged']);

header('Location: controllers/init/initController.php');