<?php
require('connect_bd.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/swiper.min.css">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/24379c859d.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/style.css">
    <title>Ecom-Ensa</title>
</head>

<body>

    <?php require('navbar.php'); ?>

    <div class="swiper-container">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide" style="background-image: url('./images/slide1.jpg');">
                <div class="slider_contante">
                    <h3>SPECIAL OFFER TODAY</h3><br>
                    <h1>Summer Offer 2020 <br> Collection</h1>
                    <button class="btn btn-success">Shop Now</button>
                    <!-- <button class="btn btn-primary">Click Me</button> -->
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url('./images/slide2.jpg');">
                <div class="slider_contante">
                    <h3>SPECIAL OFFER TODAY</h3><br>
                    <h1>Summer Offer 2020 <br> Collection</h1>
                    <button class="btn btn-success">Shop Now</button>
                    <!-- <button class="btn btn-primary">Click Me</button> -->
                </div>
            </div>
            <div class="swiper-slide" style="background-image: url('./images/slide3.png');">
                <!-- <img src="./images/slide3.jpg" alt=""> -->
                <div class="slider_contante">
                    <h3>SPECIAL OFFER TODAY</h3><br>
                    <h1>Summer Offer 2020 <br> Collection</h1>
                    <button class="btn btn-success">Shop Now</button>
                    <!-- <button class="btn btn-primary">Click Me</button> -->
                </div>
            </div>

        </div>
        <!-- If we need pagination -->
        <div class="swiper-pagination"></div>

        <!-- If we need navigation buttons -->
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>

    </div>
    <div class="shop_by_category container">
        <div class="shop_by_category">
            <h2>Shop By Category </h2>
            <div class="line"></div>
        </div>

        <div class="row">
            <div class="mt-3 col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card ">
                    <div class="card-header categorie-title text-center">
                        <h3>Wearable Tech</h3>
                    </div>
                    <img class="card-img-top p-1 category-image" height="200px" src="./images/smart2.jpg" alt="Bologna">
                    <div class="card-body text-center">
                        <a href="all_products.php?categorie=wearable tech"" class=" btn btn-danger">Watch More</a>
                    </div>
                </div>
            </div>

            <!-- 2 -->
            <div class="mt-3 col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card ">
                    <div class="card-header categorie-title text-center">
                        <h3> Camera</h3>
                    </div>
                    <img class="card-img-top p-1" height="200px" src="./images/camera3.jpg" alt="Bologna">
                    <div class="card-body text-center">
                        <a href="all_products.php?categorie=camera" class="btn btn-danger">Watch More</a>
                    </div>
                </div>
            </div>

            <!-- 3 -->
            <div class="mt-3 col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card ">
                    <div class="card-header categorie-title text-center">
                        <h3>HeadPhone</h3>
                    </div>
                    <img class="card-img-top p-1" height="200px" src="./images/camera5.jpg" alt="Bologna">
                    <div class="card-body text-center">
                        <a href="all_products.php?categorie=headphone" class="btn btn-danger">Watch More</a>
                    </div>
                </div>
            </div>

            <!-- 4 -->
            <div class="mt-3 col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card ">
                    <div class="card-header categorie-title text-center">
                        <h3>Cell Phone</h3>
                    </div>
                    <img class="card-img-top p-1" height="200px" src="./images/phone1.jpg" alt="Bologna">
                    <div class="card-body text-center">
                        <a href="all_products.php?categorie=cell phone" class="btn btn-danger">Watch More</a>
                    </div>
                </div>
            </div>
            <!-- Computers 5 -->

            <div class="mt-3 col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card ">
                    <div class="card-header categorie-title text-center">
                        <h3>Computers</h3>
                    </div>
                    <img class="card-img-top p-1" height="200px" src="./images/pc3.jpg" alt="Bologna">
                    <div class="card-body text-center">
                        <a href="all_products.php?categorie=computers" class="btn btn-danger">Watch More</a>
                    </div>
                </div>
            </div>
            <!-- Tablet 6 -->

            <div class="mt-3 col-12 col-sm-6 col-md-4 col-lg-3">
                <div class="card ">
                    <div class="card-header categorie-title text-center">
                        <h3>Tablet</h3>
                    </div>
                    <img class="card-img-top p-1" height="200px" src="./images/category6.jpg" alt="Bologna">
                    <div class="card-body text-center">
                        <a href="all_products.php?categorie=tablet" class="btn btn-danger">Watch More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section>

        <div class="container">
            <div class="shop_by_popular">
                <h2>Popular Products </h2>
                <div class="line"></div>
                <div id="message"></div>

            </div>
            <div class="row">
                <!-- use card -->
                <?php
                $products_query = $pdo_con->prepare("SELECT * FROM product WHERE product_price BETWEEN 100 AND 4000 LIMIT 8");
                // $products_query->bindParam(1, '100');
                // $products_query->bindParam(2, '4000');
                $products_query->execute();
                while ($popular_product = $products_query->fetch()) :
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mt-2">
                        <div class=" card product-top p-2">
                            <!-- <img src="./images/camera1.jpg" class="card-img-top m-1" alt="" srcset=""> -->
                            <div class="card-img-top">
                                <img class="card-img-top m-1" height="150px" width="150px" src="data:image/jpg;base64, <?= base64_encode($popular_product['product_image']) ?>" />
                            </div>
                            <div class="card-body">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-seccess">
                                        <a href="product.php?product_id=<?= $popular_product['id'] ?>">
                                            <img src="./font_svg/eye-regular.svg" class="fas"></img></a>
                                    </button>

                                    <form action="" class="form-submit">
                                        <input type="hidden" class="product_id" value="<?= $popular_product['id'] ?>">
                                        <input type="hidden" class="product_price" value="<?= $popular_product['product_price'] ?>">
                                        <button type="button" class="btn btn-secondary additembtn">
                                            <img src="./font_svg/cart-plus-solid.svg" class="fas"></img>
                                        </button>
                                    </form>

                                </div>
                                <p class="card-title text-center"><?= $popular_product['product_name'] ?></p>
                                <h4 class="card-text text-center text-success"> <b>$</b> <?= $popular_product['product_price'] ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        </div>
    </section>


    <div class="container-fluid mt-5 mb-3">
        <a href="all_products.php">
            <img src="./images/pub.jpg" width="100%" alt="" srcset="">
        </a>
    </div>

    <section>

        <div class="container">
            <div class="shop_by_popular">
                <h2>New Products </h2>
                <div class="line"></div>
                <div class="message"></div>

            </div>
            <div class="row">
                <!-- use card -->
                <?php
                $products_query = $pdo_con->prepare("SELECT * FROM product LIMIT 8");
                $products_query->execute();
                while ($popular_product = $products_query->fetch()) :
                ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 mt-2">
                        <div class=" card product-top p-2">
                            <!-- <img src="./images/camera1.jpg" class="card-img-top m-1" alt="" srcset=""> -->
                            <div class="card-img-top">
                                <img class="card-img-top m-1" height="150px" width="150px" src="data:image/jpg;base64, <?= base64_encode($popular_product['product_image']) ?>" />
                            </div>
                            <div class="card-body">
                                <div class="overlay-right">
                                    <button type="button" class="btn btn-seccess">
                                        <a href="product.php?product_id=<?= $popular_product['id'] ?>">
                                            <img src="./font_svg/eye-regular.svg" class="fas"></img></a>
                                    </button>

                                    <form action="" class="form-submit">
                                        <input type="hidden" class="product_id" value="<?= $popular_product['id'] ?>">
                                        <input type="hidden" class="product_price" value="<?= $popular_product['product_price'] ?>">
                                        <button type="button" class="btn btn-secondary additembtn">
                                            <img src="./font_svg/cart-plus-solid.svg" class="fas"></img>
                                        </button>
                                    </form>

                                </div>
                                <p class="card-title text-center"><?= $popular_product['product_name'] ?></p>
                                <h4 class="card-text text-center text-success"> <b>$</b> <?= $popular_product['product_price'] ?></h4>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

            </div>
        </div>
    </section>



    <!--  Section Features -->
    <section class="features-section">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6 features-box">
                    <img src="./font_svg/original.svg" alt="" srcset="">
                    <div class="features-text">
                        <p>
                            <b>
                                100% Original items
                            </b>
                            Are Availble In Our Store
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 features-box">
                    <img src="./font_svg/return.svg" alt="" srcset="">
                    <div class="features-text">
                        <p>
                            <b>Return within 30 Days
                            </b>
                            Of Receving Your Oreders
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 features-box">
                    <img src="./font_svg/free-shipping.svg" alt="" srcset="">
                    <div class="features-text">
                        <p>
                            <b>
                                Get Free Delivery Every
                            </b>
                            Order On More Than price
                        </p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 features-box">
                    <img src="./font_svg/payment.svg" alt="" srcset="">
                    <div class="features-text">
                        <p>
                            <b>
                                Play Online through multiple
                            </b>
                            Payment options
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- Footer section and Scripts -->
    <?php require('footer.php'); ?>


</body>

</html>