<head>
    <style>
        .nav-link {
            color: white;
        }

        .nav-link:hover {
            text-decoration: underline blueviolet 2px;
        }
    </style>
</head>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark p-4">
    <a class="navbar-brand" href="../controllers/homeController.php">
        <img src="assets/logo.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        Tech Store
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse " id="navbarNav">
        <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
            <?php if (!isset($_SESSION['userLogged'])) { ?>
                <li class="nav-item active">
                    <a class="nav-link" href="../controllers/homeController.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/user/signUpController.php">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="../controllers/user/signInController.php">Login</a>
                </li>
            <?php } else {
                if ($_SESSION['userLogged']->getEmail() != 'admin@admin.com') { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/homeController.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/repair/addRepairController.php">Reparar</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/order/payController.php">Payment</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/user/logoutController.php">Logout</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/user/profileController.php"><img alt="" style="width: 40px;" class="img-fluid" src="uploads/profiles/<?php echo $_SESSION['userLogged']->getFilename(); ?>.png"/></a>
                    </li>
                <?php } else { ?>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/homeController.php">Home</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/user/listUsersController.php">Users</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/product/listProductsController.php">Products & Repairs</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/order/listFacturasController.php">Facturas</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="../controllers/user/logoutController.php">Logout</a>
                    </li>
                <?php }
            } ?>
        </ul>
    </div>
</nav>