<?php
session_start();
require('../connect_bd.php');




if (!isset($_SESSION['name'])) {

    echo "<script>window.open('login.php','_self')</script>";
} else {

    $count_products_query = $pdo_con->prepare('SELECT * FROM `product` ');
    $count_products_query->execute();
    $count_products = $count_products_query->rowCount();


    $count_client_query = $pdo_con->prepare('SELECT * FROM client ');
    $count_client_query->execute();
    $count_clients = $count_client_query->rowCount();


    $count_pending_orders = $pdo_con->prepare('SELECT * FROM commande');
    $count_pending_orders->execute();
    $count_commande = $count_pending_orders->rowCount();

    // SELECT SUM(prix_unit) FROM `ligne` 

    $count_pending_orders_moeny = $pdo_con->prepare('SELECT SUM(prix_unit) as total FROM ligne ');
    $count_pending_orders_moeny->execute();
    $count_ordrs_moeny = $count_pending_orders_moeny->fetch(PDO::FETCH_ASSOC);

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
        <title>Admin-Section | Dashboard</title>
    </head>

    <body>
        <div class="row">
            <!-- 1 row Starts -->

            <div class="col-lg-12">
                <!-- col-lg-12 Starts -->

                <ol class="breadcrumb">
                    <!-- breadcrumb Starts -->

                    <li class="active">

                        <i class="fas fa-dashboard"></i> Dashboard

                    </li>

                </ol><!-- breadcrumb Ends -->

            </div><!-- col-lg-12 Ends -->

        </div><!-- 1 row Ends -->


        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class=" card ">
                    <div class="card-header bg-primary">
                        <div class="row">
                            <div class="float-right col-xs-3">
                                <i class="fas fa-tasks fa-4x"> </i>
                            </div>
                            <div class="ml-2 pl-4 pt-3 col-xs-8">
                                Products :
                                <b> <?php echo $count_products; ?> </b>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- col-lg-3 col-md-6 Ends -->


            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card">
                    <div class="card-header bg-success">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fas fa-comments fa-4x"> </i>
                            </div>
                            <div class="col-xs-8 ml-2 pl-4 pt-3">
                                Customers :
                                <b> <?php echo $count_clients; ?> </b>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- col-lg-3 col-md-6 Ends -->


            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card ">
                    <div class="card-header bg-warning">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fas fa-shopping-cart fa-4x"> </i>
                            </div>
                            <div class="col-xs-8 ml-2 pl-4 pt-3">
                                Commandes :
                                <b>
                                    <?php echo $count_commande; ?>
                                </b>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- col-lg-3 col-md-6 Ends -->

            <div class="col-lg-3 col-md-6 col-sm-6">
                <div class="card ">
                    <div class="card-header bg-danger">
                        <div class="row">
                            <div class="col-xs-3">
                                <i class="fas fa-wallet fa-4x"></i>
                            </div>
                            <div class="col-xs-8 ml-2 pl-4 pt-3">
                                Orders :
                                <b class="huge"> $<?php echo $count_ordrs_moeny['total']; ?> </b>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- 2 row Ends -->

        <div id="chart-container">
            <canvas id="mycanvas">
                <!-- Desplay Cliane adn Commande -->
            </canvas>
        </div>
    <?php } ?>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
    <script src="../js/dashboard.js"></script>
    </body>

    </html>