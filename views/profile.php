<?php

include_once "../model/UserTech.php";
include_once "../model/ProductTech.php";
include_once "../model/Order.php";
include_once "../model/Repair.php";

if (session_status() === PHP_SESSION_NONE) session_start();

?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $_SESSION['userLogged']->getFullname(); ?></title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/bodyPages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php include_once 'templates/nav2.php'; ?>
<section id="section" style="background-color: #eee;">
    <form method="post" action="../controllers/user/profileController.php" enctype="multipart/form-data">
        <div class="container py-5">
            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4">
                        <div class="card-body text-center">
                            <img src="uploads/profiles/<?php echo $_SESSION['userLogged']->getFilename(); ?>.png"
                                 style="width: 150px;">
                            <input name="image" class="selectImage" type="file" style="display: none">
                            <h5 class="my-3"><?php echo $_SESSION['userLogged']->getFullname(); ?></h5>
                            <div class="d-flex justify-content-center mb-2">
                                <button type="button" class="btn btn-lg" id="editButton"
                                        style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                                        onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                        onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">
                                    Editar
                                </button>
                                <button type="submit" class="btn btn-lg btn2" name="btnSave"
                                        style="display:none;background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                                        onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                        onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">
                                    Guardar
                                </button>
                                <button type="button" class="btn btn-outline-danger ms-1" id="deleteButton">Delete
                                </button>
                                <button type="reset" class="btn btn-outline-danger ms-1 btn2" style="display: none">
                                    Reset
                                </button>
                            </div>
                            <div class="smallText" style="display: flex; justify-content: center">
                                <small style="color: red; font-weight: bold">
                                    <?php
                                    if (isset($_SESSION['errorsProfiles'])) {
                                        foreach ($_SESSION['errorsProfiles'] as $error) {
                                            echo isset($error) ? $error : null; ?>
                                            <br>
                                            <?
                                        }
                                    }
                                    ?>
                                </small>
                            </div>
                            <?php unset($_SESSION['errorsProfiles']); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <input class="text-muted mb-0 input" type="text"
                                           style="border: none; text-decoration: none;"
                                           disabled
                                           value="<?php echo $_SESSION['userLogged']->getFullname(); ?>"
                                           name="fullnameProfile">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <input class="text-muted mb-0 input" type="email"
                                           style="border: none; text-decoration: none;"
                                           disabled
                                           value="<?php echo $_SESSION['userLogged']->getEmail(); ?>"
                                           name="emailProfile">
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <input class="text-muted mb-0 input" type="password" id="passIn"
                                           style="border: none; text-decoration: none; width: 400px" disabled
                                           value="<?php echo $_SESSION['userLogged']->getPassword(); ?>"
                                           name="passwordProfile">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body ">
                                    <table class="table table-striped align-middle">
                                        <thead>
                                        <p class="mb-4"><span class="text-primary font-italic me-1">Orders</span></p>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Name</th>
                                            <th>Precio</th>
                                            <th>Fecha</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($_SESSION['ordersUser'] as $order) { ?>
                                            <tr>
                                                <th>
                                                    <img src="uploads/products/<?php echo $order[1] ?>.jpg"
                                                         style="width: 50px;"></th>
                                                <td>
                                                    <p class="mb-1"
                                                       style="font-size: .77rem;"><?php echo $order[2] ?></p></td>
                                                <td><p class="mb-1"
                                                       style="font-size: .77rem;"><?php echo $order[3] ?>€</p></td>
                                                <td><p class="mb-1"
                                                       style="font-size: .77rem;"><?php echo $order[4] ?></p></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card mb-4 mb-md-0">
                                <div class="card-body">
                                    <table class="table table-striped align-middle">
                                        <thead>
                                        <p class="mb-4"><span class="text-primary font-italic me-1">Repair Products</span></p>
                                        <tr>
                                            <th>Imagen</th>
                                            <th>Name</th>
                                            <th>Status</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php if (!empty($_SESSION['repairsUser'])){ ?>
                                        <?php foreach ($_SESSION['repairsUser'] as $repair) { ?>
                                            <tr>
                                                <th>
                                                    <img src="uploads/products/<?php echo $repair[0]->getFilename() ?>.jpg"
                                                         style="width: 50px;"></th>
                                                <td>
                                                    <p class="mb-1"
                                                       style="font-size: .77rem;"><?php echo $repair[0]->getName() ?></p></td>
                                                <td><p class="mb-1"
                                                       style="font-size: .77rem;"><?php echo $repair[1] ?></p></td>
                                            </tr>
                                        <?php } ?>
                                        </tbody>
                                    <?php } ?>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</section>
<div class="alertaMsg" style="display: none">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="card text-center">
            <div class="card-body">
                <h5 class="card-title">Eliminar Cuenta</h5>
                <p class="card-text">Usted esta seguro de eliminar su cuenta?</p>
                <button type="button" class="btn btn-outline-success" id="confirmButton">Si</button>
                <a href="profile.php" style="text-decoration: none">
                    <button type="button" class="btn btn-outline-danger">No</button>
                </a>
            </div>
        </div>
    </div>
</div>
<div class="confirmEmail" style="display: none">
    <div class="h-100 d-flex align-items-center justify-content-center">
        <div class="card text-center">
            <div class="card-body">
                <form method="post" action="../controllers/user/profileController.php">
                    <h5 class="card-title">Introduce tu email para confirmar</h5>
                    <div class="small text-muted mt-2">No hay vuelta atras</div>
                    <input type="email" name="emailDeleter"> <br><br>
                    <a href="../controllers/user/profileController.php" style="text-decoration: none">
                        <button type="submit" name="btnDeleteUser" class="btn btn-outline-warning">Eliminar</button>
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="js/profileScript.js"></script>
</body>
</html>
