<?php
include_once "../model/UserTech.php";

if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit User</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/bodyPages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php

include_once 'templates/nav2.php';

?>
<section class="vh-100">
    <div class="container h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="text-black mb-4">Edit User</h1>
                <div class="card" style=";border: blueviolet solid; border-radius: 15px;">
                    <div class="card-body">
                        <form method="post" action="../controllers/user/editUserController.php"
                              enctype="multipart/form-data">
                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <label for="fullname" class="form-label">Full Name</label>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="text" class="form-control form-control-lg" id="fullname"
                                           value="<?php echo $_SESSION['userEdit']->getFullname(); ?>" name="fullname"/>
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                                           value="<?php echo $_SESSION['userEdit']->getEmail(); ?>">
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <label for="oldPassword" class="form-label">Old Password</label>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="password" class="form-control form-control-lg" id="oldPassword"
                                           name="oldPassword">
                                </div>
                            </div>
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <label for="newPassword" class="form-label">New Password</label>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="password" class="form-control form-control-lg" id="newPassword"
                                           name="newPassword">
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0"><img class="rounded mx-auto d-block"
                                                          src="uploads/profiles/<?php echo $_SESSION['userEdit']->getFilename(); ?>.png" alt="" width="100"
                                                          height="100"></h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input class="form-control form-control-lg" id="image" type="file"
                                           name="image" accept="image/png"/>
                                    <div class="small text-muted mt-2">(Seleccione para cambiar de foto de perfil o deje la que tiene)</div>
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="px-5 py-4">
                                <button type="submit" class="btn btn-lg"
                                        style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                                        onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                        onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">Editar
                                </button>
                                <button type="reset" class="btn btn-lg btn-outline-danger">Reset</button>
                            </div>
                        </form>
                        <div class="smallText" style="display: flex; justify-content: center">
                            <small style="color: red; font-weight: bold">
                                <?php
                                if (isset($_SESSION['errorsEditUser'])) {
                                    foreach ($_SESSION['errorsEditUser'] as $error) {
                                        echo isset($error) ? $error : null; ?>
                                        <br>
                                        <?
                                    }
                                }
                                ?>
                            </small>
                        </div>
                        <?php unset($_SESSION['errorsEditUser']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>
</html>
