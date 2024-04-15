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
    <title>Home</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/bodyPages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php include_once "templates/nav2.php" ?>
<div class="container">
    <div class="smallText" style="display: flex; justify-content: center">
        <small style="color: red; font-weight: bold">
            <br>
            <?php
            if (isset($_SESSION['errorHome'])) {
                foreach ($_SESSION['errorHome'] as $error) {
                    echo isset($error) ? $error : null; ?>
                    <br>
                    <?
                }
            }
            ?>
        </small>
        <?php unset($_SESSION['errorHome']); ?>
        <small style="color: green; font-weight: bold">
            <br>
            <?php
            if (isset($_SESSION['payComplete'])) {
                foreach ($_SESSION['payComplete'] as $error) {
                    echo isset($error) ? $error : null; ?>
                    <br>
                    <?
                }
            }
            ?>
        </small>
        <?php unset($_SESSION['payComplete']); ?>
        <small style="color: red; font-weight: bold">
            <br>
            <?php
            if (isset($_SESSION['userLogged'])) {
                if (empty($_SESSION['userLogged']->getToken())) { ?>
                    Tienes que verficar la cuenta para poder comprar
                    <?php
                }
            }
            ?>
        </small>
    </div>
    <div class="row row-cols-4">
        <?php foreach ($_SESSION['products'] as $product) { ?>
            <div class="col mt-3">
                <div class="card" style="width: 18rem; border: blueviolet 1px solid;">
                    <img src="uploads/products/<?php echo $product->getFilename(); ?>.jpg" class="card-img-top"
                         alt="...">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $product->getName(); ?></h5>
                        <p class="card-text">Brand: <?php echo $product->getBrand(); ?>
                            <br>Price: <?php echo $product->getPrice(); ?></p>
                        <?php if (isset($_SESSION['userLogged'])) {
                            if ($_SESSION['userLogged']->getEmail() == 'admin@admin.com') {
                                ?>
                                <a href="../controllers/product/editProductController.php?id=<?php echo $product->getIdProduct(); ?>"
                                   class="btn"
                                   style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                                   onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                   onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">Edit</a>
                                <a href="../controllers/product/deleteProductController.php?id=<?php echo $product->getIdProduct(); ?>"
                                   class="btn"
                                   style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                                   onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                   onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">Remove</a>
                            <?php } else if (!empty($_SESSION['userLogged']->getToken())) { ?>
                                <a href="../controllers/order/payController.php?id=<?php echo $product->getIdProduct(); ?>"
                                   class="btn"
                                   style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                                   onmouseover="this.style.background='blueviolet', this.style.color='white'"
                                   onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">Buy</a>
                            <?php }
                        } ?>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>
</html>
