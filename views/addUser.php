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
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/bodyPages.css">
    <link rel="icon" href="assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php include_once 'templates/nav2.php'; ?>
<section class="vh-100">
    <div class="container h-75">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-9">
                <h1 class="text-black mb-4">Add User</h1>
                <div class="card" style=";border: blueviolet solid; border-radius: 15px;">
                    <div class="card-body">
                        <form method="post" action="../controllers/user/addUserController.php"
                              enctype="multipart/form-data">
                            <div class="row align-items-center pt-4 pb-3">
                                <div class="col-md-3 ps-5">
                                    <label for="fullname" class="form-label">Full Name</label>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="text" class="form-control form-control-lg" id="fullname"
                                           name="fullname"/>
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <label for="email" class="form-label">Email</label>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="email" class="form-control form-control-lg" id="email" name="email"
                                           placeholder="example@example.com">
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <label for="pass" class="form-label">Password</label>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input type="password" class="form-control form-control-lg" id="pass"
                                           name="password">
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="row align-items-center py-3">
                                <div class="col-md-3 ps-5">
                                    <h6 class="mb-0">Upload Image Profile</h6>
                                </div>
                                <div class="col-md-9 pe-5">
                                    <input class="form-control form-control-lg" id="formFileLg" type="file"
                                           name="image"/>
                                    <div class="small text-muted mt-2">Sube tu foto de perfil. Tamaño maximo 5 MB</div>
                                </div>
                            </div>
                            <hr class="mx-n3">
                            <div class="px-5 py-4">
                                <button type="submit" id="btnProduct" class="btn btn-lg"
                                        style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                                        onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                        onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">
                                    Add User
                                </button>
                                <button type="reset" class="btn btn-lg btn-outline-danger">Reset</button>
                            </div>
                        </form>
                        <div class="smallText" style="display: flex; justify-content: center">
                            <small style="color: red; font-weight: bold">
                                <?php
                                if (isset($_SESSION['errorsSignUp'])){
                                    foreach ($_SESSION['errorsSignUp'] as $error) {
                                        echo isset($error) ? $error : null; ?>
                                        <br>
                                        <?
                                    }
                                }
                                ?>
                            </small>
                        </div>
                        <?php unset($_SESSION['errorsSignUp']); ?>
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
