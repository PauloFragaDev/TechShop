<?php
include_once "../model/UserTech.php";
include_once "../model/ProductTech.php";
if (session_status() === PHP_SESSION_NONE) session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Payment</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/bodyPages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
</head>
<body>
<?php include_once "templates/nav2.php";
if (empty($_SESSION['cesta'])) { ?>
    <div class="alert alert-info d-flex justify-content-center">
        <strong>Info! </strong> Su cesta esta vacia.
    </div>
    <?php
} else {
?>
<section>
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col">
                <p><span class="h2">Carrito de Compra </span><span class="h4">(1 item in your cart)</span></p>

                <div class="card mb-4">
                    <div class="card-body p-4">
                        <?php foreach ($_SESSION['cesta'] as $item) { ?>
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="uploads/products/<?php echo $item->getFilename(); ?>.jpg"
                                         class="img-fluid" alt="Generic placeholder image">
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">Name</p>
                                        <p class="lead fw-normal mb-0"><?php echo $item->getName(); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">Brand</p>
                                        <p class="lead fw-normal mb-0"><i class="fas fa-circle me-2"
                                                                          style="color: #fdd8d2;"></i>
                                            <?php echo $item->getBrand(); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">Price</p>
                                        <p class="lead fw-normal mb-0"><?php echo $item->getPrice(); ?></p>
                                    </div>
                                </div>
                                <div class="col-md-2 d-flex justify-content-center">
                                    <div>
                                        <p class="small text-muted mb-4 pb-2">Eliminar</p>
                                        <p class="lead fw-normal mb-0">
                                            <a href="../controllers/order/deleteItemCarrito.php?id=<?php echo $item->getIdProduct(); ?>"
                                               style="text-decoration: none;">
                                                <button type="button" class="btn"
                                                ><i class="bi bi-trash" style="color: black"
                                                    onmouseover="this.style.color='blueviolet'"
                                                    onmouseout="this.style.color='black'"></i>
                                                </button>
                                            </a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="card mb-5">
                    <div class="card-body p-4">

                        <div class="float-end">
                            <p class="mb-0 me-5 d-flex align-items-center">
                                <span class="small text-muted me-2">Order total:</span> <span
                                        class="lead fw-normal"><?php echo $_SESSION['totalMount'] ?></span>
                            </p>
                        </div>

                    </div>
                </div>
                <form method="post" action="../controllers/order/payController.php">
                    <div class="d-flex justify-content-end">
                        <a href="../controllers/homeController.php">
                            <button type="button" class="btn btn-light btn-lg me-2">Continuar Comprando</button>
                        </a>
                        <button type="submit" class="btn btn-lg btn2" name="btnSave"
                                style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                                onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">
                            Pagar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php } ?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>
</html>
