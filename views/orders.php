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
    <title>Orders</title>
    <link rel="icon" href="assets/logo.png">
    <link rel="stylesheet" href="css/bodyPages.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<?php include_once "templates/nav2.php" ?>

<section class="">
    <div class="container h-100 py-5">
        <h1>Orders</h1> <br>
        <table class="table table-dark table-striped align-middle" id="table1" style="border: solid ghostwhite 1px;">
            <thead>
            <tr>
                <th scope="col">Imagen</th>
                <th scope="col">Usuario</th>
                <th scope="col">Producto</th>
                <th scope="col">Precio Unidad</th>
                <th scope="col">Precio Total</th>
                <th scope="col">Fecha</th>
            </tr>
            </thead>
            <tbody>
            <?php
            foreach ($_SESSION['facturas'] as $factura) {
                ?>
                <tr>
                    <th><img class="rounded mx-auto d-block"
                             src="uploads/products/<?php echo $factura[0] ?>.jpg" alt="" width="100"
                             height="100"></th>
                    <td><?php echo $factura[1] ?></td>
                    <td><?php echo $factura[2] ?></td>
                    <td><?php echo $factura[3] ?></td>
                    <td><?php echo $factura[4] ?>€</td>
                    <td><?php echo $factura[5] ?></td>
                </tr>
                <?
            }
            ?>
            </tbody>
        </table>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
        crossorigin="anonymous"></script>
</body>
</html>
