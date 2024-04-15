<?php
include_once "../model/UserTech.php";
include_once "../model/ProductTech.php";
include_once "../model/Repair.php";

if (session_status() === PHP_SESSION_NONE) session_start();

?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Products</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/bodyPages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0"/>
</head>
<body>
<?php include_once 'templates/nav2.php'; ?>

<section class="">
    <div class="container h-100 py-5">
        <h1>Products & Repairs</h1> <br>
        <button type="button" id="btnProduct" class="btn"
                style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                onmouseover="this.style.background='blueviolet', this.style.color='white'"
                onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">Products
        </button>
        <button type="button" id="btnRepair" class="btn"
                style="background: ghostwhite; color: blueviolet; border: blueviolet 1px solid;"
                onmouseover="this.style.background='blueviolet', this.style.color='white'"
                onmouseout="this.style.background='ghostwhite',this.style.color='blueviolet'">Repairs
        </button>
        <br><br>
        <table class="table table-dark table-striped align-middle" id="table1" style="border: solid ghostwhite 1px;">
            <thead>
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Marca</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($_SESSION['products'])) {
                foreach ($_SESSION['products'] as $product) {
                    ?>
                    <tr>
                        <td><img class="rounded mx-auto d-block"
                                 src="uploads/products/<?php echo $product->getFileName(); ?>.jpg" alt="" width="100"
                                 height="100"></td>
                        <td><?php echo $product->getBrand(); ?></td>
                        <td><?php echo $product->getName(); ?></td>
                        <td><?php echo $product->getPrice(); ?>€</td>
                        <td>
                            <a href="../controllers/product/editProductController.php?id=<?php echo $product->getIdProduct(); ?>">
                                <button type="button" class="btn btn-success mw-auto d-block "><span
                                            class="material-symbols-outlined">edit</span></button>
                            </a>
                            <br>
                            <a href="../controllers/product/deleteProductController.php?id=<?php echo $product->getIdProduct(); ?>">
                                <button type="button" class="btn btn-danger mw-auto d-block text-white"><span
                                            class="material-symbols-outlined">delete</span></button>
                            </a>
                        </td>
                    </tr>
                    <?
                }
            }
            ?>
            <tr>
                <td colspan="5" class="text-center">
                    <a href="../controllers/product/addProductController.php" style="text-decoration: none;">
                        <button type="button" class="btn"
                        ><span
                                    class="material-symbols-outlined" style="color: white"
                                    onmouseover="this.style.color='#00F7FF'"
                                    onmouseout="this.style.color='white'">add</span>
                        </button>
                    </a>
                </td>
            </tr>
            </tbody>
        </table>
        <table class="table table-dark table-striped align-middle" id="table2"
               style="border: solid ghostwhite 1px;">
            <thead>
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Nombre Usuario</th>
                <th scope="col">Nombre Producto</th>
                <th scope="col">Fecha Inicio</th>
                <th scope="col">Fecha Finalizacion</th>
                <th scope="col">Estado</th>
                <th scope="col">Accion</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if (!empty($_SESSION['repairs'])) {
                foreach ($_SESSION['repairs'] as $repair) {
                    ?>
                    <tr>
                        <th><img class="rounded mx-auto d-block"
                                 src="uploads/products/<?php echo $repair[0]->getFileName(); ?>.jpg" alt="" width="100"
                                 height="100"></th>
                        <td><?php echo $repair[1]->getFullname(); ?></td>
                        <td><?php echo $repair[0]->getName(); ?></td>
                        <td><?php echo $repair[2]->getCreated(); ?></td>
                        <td><?php echo $repair[2]->getModified(); ?></td>
                        <td><?php echo $repair[2]->getStatus(); ?></td>
                        <td>
                            <?php if ($repair[2]->getStatus() != 'entregado') { ?>
                                <a href="../controllers/repair/changeStatusController.php?idRepair=<?php echo $repair[2]->getIdRepair(); ?>"
                                   style="text-decoration: none">
                                    <button type="button" class="btn btn-success mw-auto d-block ">Change Status</button>
                                </a>
                            <?php } ?>
                        </td>
                    </tr>
                    <?
                }
            }
            ?>
            </tbody>
        </table>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
<script src="js/script.js"></script>
</body>
</html>
