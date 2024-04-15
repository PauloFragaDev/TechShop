<?php

include_once "../model/UserTech.php";

if (session_status() === PHP_SESSION_NONE) session_start();

unset($_SESSION['userEdit']);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Users</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/bodyPages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
</head>
<body>
<?php

include_once 'templates/nav2.php';

?>
<section class="vh-100">
    <div class="container h-75">
        <h1>Users</h1> <br>
        <table class="table table-dark table-striped align-middle" style="border: solid ghostwhite 1px">
            <thead>
            <tr>
                <th scope="col">I-Profile</th>
                <th scope="col">Nombre</th>
                <th scope="col">Email</th>
                <th scope="col">Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($_SESSION['usuarios'] as $user) {
                ?>
                <tr>
                    <th><img class="rounded mx-auto d-block"
                             src="uploads/profiles/<?php echo $user->getFileName(); ?>.png" alt="" width="100"
                             height="100"></th>
                    <td><?php echo $user->getFullname(); ?></td>
                    <td><?php echo $user->getEmail(); ?></td>
                    <td>
                        <?php if ($user->getEmail() != "admin@admin.com"){ ?>
                        <a href="../controllers/user/editUserController.php?email=<?php echo $user->getEmail(); ?>">
                            <button type="button" class="btn btn-success mx-auto d-block"><span
                                        class="material-symbols-outlined">edit</span></button>
                        </a>
                        <br>
                        <a href="../controllers/user/deleteUserController.php?id=<?php echo $user->getIdUser(); ?>">
                            <button type="button" class="btn btn-danger mx-auto d-block text-white"><span
                                        class="material-symbols-outlined">delete</span></button>
                        </a>
                        <?php } ?>
                    </td>

                </tr>
                <?
            }
            ?>
            </tbody>
        </table>
        <a href="../controllers/user/addUserController.php" style="text-decoration: none">
        <button type="button" class="btn mx-auto d-block"
                style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                onmouseover="this.style.background='blueviolet', this.style.color='white'"
                onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">Add User
        </button>
        </a>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>
</html>
