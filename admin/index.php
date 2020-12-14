<?php
require('../connect_bd.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/24379c859d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Admin-Section | Manage Products</title>
</head>

<body>
    <?php

    require('../navbar_admin.php');
    ?>
    <?php
    if (isset($_SESSION['name'])) :
    ?>
        <!-- Admin Pade -->
        <div class="admin-wrapper">
            <!-- Left Sidebar -->
            <div class="left-sidebar">
                <div class="dashbord">
                    <div class="row mt-3">

                        <img src="../font_svg/dashbord.png" class="mt-2 ml-5 dashbord-icon" alt="" srcset="">
                        <button id="dashboard_admin" class=" btn mr-auto  mt-2 ">Dashbord</button>
                    </div>
                </div>
                <ul>
                    <li><a href="#" id="manage_product">Manage Products</a></li>
                    <li><a href="#" id="manage_client">Manage Client</a></li>
                    <li><a href="#" id="manage_commande">Manage Commande</a></li>
                    <li><a href="#" id="manage_ordes">Manage Orders</a></li>
                </ul>
            </div>
            <!-- End Left Sidebar -->

            <!-- Admin Contant -->
            <iframe src="dashboard.php" class="admin-contant" frameborder="0" id="admin_contant"></iframe>
            <!-- End Admin Contant -->
        </div>
        <!-- End Admin Pade -->
    <?php endif;

    if (!isset($_SESSION['name'])) {
        echo "<script> location.href='login.php'; </script>";
        exit;
    }

    ?>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="../js/admin.js"></script>
</body>

</html>