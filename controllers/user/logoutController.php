<?php
if(session_status() === PHP_SESSION_NONE) session_start();

unset($_SESSION['userLogged']);
unset($_SESSION['userEdit']);

header('Location: /controllers/user/signInController.php');