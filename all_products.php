<?php
require "connect_bd.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="./css/index.css">
    <title>Ecom-Ensa</title>
</head>

<body>
    <?php
    require('navbar.php');
    ?>
    <?php
    if (isset($_GET['searchitem'])) {
        $products_query = $pdo_con->prepare("SELECT * FROM product WHERE `product_name` LIKE ? OR `categorie` LIKE ? ");
        $valuetosearch = '%' . $_GET['searchitem'] . '%';
        $products_query->bindParam(1, $valuetosearch);
        $products_query->bindParam(2, $valuetosearch);
    } else if (isset($_GET['categorie'])) {
        $products_query = $pdo_con->prepare("SELECT * FROM product WHERE categorie = ?");
        $products_query->bindParam(1, $_GET['categorie']);
    } else {
        $products_query = $pdo_con->prepare("SELECT * FROM product");
    }

    ?>
    <div class="row mt-2 ">
        <div class="col-sm-3">
            <button type="button" class="btn btn-lg ml-3 mt-3 btn-outline-primary filter">
                <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-filter" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M6 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm-2-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                </svg> Fillter</button>

        </div>
        <div class="col-sm-9">
            <h1>Resultes</h1>
        </div>
    </div>
    <div class="wrapper">
        <!-- col-md-4 col-sm-4 col-lg-4 -->
        <div class="wrapper-filter line-buttom">
            <form class="submit-form">
                <label for=""><strong>&emsp; Price :</strong></label>
                <div class="row  line-buttom ">
                    <div class="ml-3 mb-2 col-sm-5">
                        <input type="text" name="min" class="form-control " placeholder="min">
                    </div>
                    <div class="col-sm-6 mb-2">
                        <input type="text" name="max" class="form-control" placeholder="max">
                    </div>
                </div>
                <label for=""><strong>&emsp; Brand :</strong></label><br>
                <div class="row  line-buttom ">
                    <div class="ml-3 col-sm-8 ">
                        <input type="text" name="brand" class="form-control mb-2 " placeholder="Brand">
                    </div>
                </div>
                <label for=""><strong>&emsp; Categorie :</strong></label><br>
                <div class="row line-buttom ">
                    <div class="ml-3 col-sm-8">
                        <input type="text" name="categorie" class="form-control mb-2" placeholder="Categorie ">
                    </div>
                </div>
                <input href="all_products.php?Price=<?php echo isset($_GET['min']) ? $_GET['min'] : '';  ?>" id="filter" class="form-controle btn btn-success text-white ml-3 mt-3 " type="submit" value="Filter">
            </form>
            <?php

            if (isset($_GET['min']) && isset($_GET['max']) && isset($_GET['brand']) && isset($_GET['categorie'])) {

                //SELECT * FROM `product` WHERE `product_price` BETWEEN '10' AND '200' AND `product_name` LIKE *%came%* OR categorie =   
                if (strlen($_GET['min']) > 0 && strlen($_GET['max']) > 1) {
                    $products_query = $pdo_con->prepare("SELECT * FROM product WHERE product_price BETWEEN ? AND ?");
                    $products_query->bindParam(1, $_GET['min']);
                    $products_query->bindParam(2, $_GET['max']);
                }
            }
            ?>
        </div>
        <div class="container-fluid wrapper-product ">
            <div id="message"></div>
            <div class="row  mt-3">
                <?php
                $products_query->execute();
                $count_product = $products_query->rowCount();
                if ($count_product == 0) {
                    echo '<h1 class="text-center w-100 m-5"> Product Unavailabel  </h1>';
                    echo "<h3 class=\"text-center w-100 m-5 \"> sorry we can't seem to find the product you-are looking for</h3>";
                } else {
                }
                while ($row = $products_query->fetch()) :
                ?>
                    <!-- <img src="./images/notfound.PNG" alt="" height="100%" width="100%" srcset=""> -->
                    <div class="product_container  col-md-3  col-12  col-sm-6 mb-2">
                        <div class="card">
                            <div class="card-body p-2 mb-2 mt-3 border-primary">
                                <div class="card-img-top">
                                    <img class="card-img-top p-3" height="200px" src="data:image/jpg;base64, <?= base64_encode($row['product_image']) ?>" />
                                </div>
                                <p class="text-center mt-2"><b><?= $row['product_name'] ?></b> </p>
                                <h4 class="text-center text-info"><b>$<?= number_format($row['product_price'], 2) ?></b> </h4>
                                <div class="card-fotter p-1">
                                    <form action="" class="form-submit">
                                        <input type="hidden" class="product_id" value="<?= $row['id'] ?>">
                                        <input type="hidden" class="product_price" value="<?= $row['product_price'] ?>">
                                        <div class="row">
                                            <a href="index.php?addtocart=<?= $row['id'] ?>" class="col ml-2 mr-2 btn btn-info btn-sm text-center additembtn ">Add to Cart</a>
                                            <a href="product.php?product_id=<?= $row['id'] ?>" class="col ml-2 mr-2 btn btn-primary btn-sm text-center text-white">View More</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    </div>



    <?php
    require('footer.php');
    ?>
    <script src="./js/index.js"></script>

</body>

</html>