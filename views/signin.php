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
    <title>LogIn</title>
    <link rel="icon" href="assets/logo.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php include_once 'templates/nav2.php'; ?>
<section class="vh-75 gradient-custom">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                <div class="card bg-dark text-white" style="border-radius: 1rem;">
                    <div class="card-body p-5 text-center">
                        <div class="mb-md-2 mt-md-4">
                            <form method="post" action="../controllers/user/signInController.php">
                                <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
                                <div class="form-outline form-white mb-4">
                                    <input type="email" id="email" name="email" class="form-control form-control-lg"/>
                                    <label class="form-label" for="email">Email</label>
                                </div>
                                <div class="form-outline form-white mb-4">
                                    <input type="password" id="password" name="password"
                                           class="form-control form-control-lg"/>
                                    <label class="form-label" for="password">Password</label>
                                </div>
                                <button type="submit" id="btnProduct" class="btn btn-lg px-5"
                                        style="background: #212529; color: blueviolet; border: blueviolet 1px solid;"
                                        onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                        onmouseout="this.style.background='#212529',this.style.color='blueviolet'">
                                    Login
                                </button>
                                <br>
                                <br>
                                <button type="reset" class="btn btn-outline-danger">Reset</button>

                            </form>
                            <div class="smallText" style="display: flex; justify-content: center">
                                <small style="color: red; font-weight: bold">
                                    <br>
                                    <?php
                                    if (isset($_SESSION['errorsSignIn'])) {
                                        foreach ($_SESSION['errorsSignIn'] as $error) {
                                            echo isset($error) ? $error : null; ?>
                                            <br>
                                            <?
                                        }
                                    }
                                    ?>
                                </small>
                                <?php unset($_SESSION['errorsSignIn']); ?>
                            </div>
                        </div>
                        <div>
                            <p class="mb-0">
                                No tienes cuenta?
                                <a href="../controllers/user/signUpController.php" class="text-white-50 fw-bold">
                                    Sign Up
                                </a>
                            </p>
                        </div>
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
