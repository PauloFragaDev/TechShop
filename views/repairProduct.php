<?php
include_once "../model/UserTech.php";
include_once "../model/ProductTech.php";
include_once "../model/Order.php";
include_once "../model/Repair.php";
if(session_status() === PHP_SESSION_NONE) session_start();
?>

<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Repair Product</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/bodyPages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php include_once 'templates/nav2.php';
if (empty($_SESSION['userRepairs'])) { ?>
    <div class="alert alert-info d-flex justify-content-center">
        <strong>Info! </strong> No tiene ningun producto a reparar.
    </div>
    <?php
} else {
?>
<section class="">
    <div class="container h-100 py-5">
        <h1>Reparar Producto</h1> <br>
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
            foreach ($_SESSION['userRepairs'] as $product) {
                ?>
                <tr>
                    <td><img class="rounded mx-auto d-block"
                             src="uploads/products/<?php echo $product[0]->getFileName(); ?>.jpg" alt="" width="100"
                             height="100"></td>
                    <td><?php echo $product[0]->getBrand(); ?></td>
                    <td><?php echo $product[0]->getName(); ?></td>
                    <td><?php echo $product[0]->getPrice(); ?>€</td>
                    <td>
                        <a style="text-decoration: none" href="../controllers/repair/addRepairController.php?idProducto=<?php echo $product[0]->getIdProduct();?>&idPedido=<?php echo $product[1];?>">
                            <button type="button" class="btn btn-success mw-auto d-block "><span
                                        class="material-symbols-outlined" style="text-decoration: none">Reparar</span></button>
                        </a>
                    </td>
                </tr>
                <?
            }
            ?>
            </tbody>
        </table>
    </div>
</section>
<?php
}
?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>
</html>
