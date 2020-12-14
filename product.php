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
    <link rel="stylesheet" href="./css/style_product.css">
    <title>Ecom-Ensa</title>
</head>

<body>
    <?php
    require('navbar.php');
    $stetm = $pdo_con->prepare('SELECT * FROM product WHERE id = ?');
    $stetm->bindParam(1, $_GET['product_id']);
    $stetm->execute();

    $result = $stetm->fetch();
    ?>
    <div id="message" class="ml-4 m-4"></div>
    <section class="product container-fluid">
        <div class="container">
            <div class="row mt-3">
                <div class="col-md-6 col-sm-12 product_img">
                    <img id="image_product" height="80%" width="100%" class="p-5" src="data:image/jpg;base64, <?= base64_encode($result['product_image']) ?>" />

                </div>
                <div class="col-md-6 col-sm-12 description">
                    <h2><?php echo $result['product_name']; ?></h2>
                    <hr class="linee">
                    <h4>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Aspernatur voluptatibus totam corrupti
                        eveniet. Dolor laborum fugit, vero, aliquid nostrum eius rem, asperiores repudiandae at numquam
                        id dicta nobis. Officiis, nisi.
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Qui, et eligendi? Atque serunt error
                        voluptas accusantium nostrum vero laboriosam beatae, ut voluptatem
                        quae est aperiam.
                    </h4>
                    <hr>
                    <div class="product_price">
                        <label for="">Price:</label><span class="price">$<?php echo $result['product_price']; ?></span>
                    </div>
                    <div class="product_brand">
                        <label for="" class="brand">Categorie: &emsp;&emsp;&emsp;<?php echo  $result['categorie']; ?></label>
                    </div>
                    <div class="stock">
                        <label for="">Availability:</label><span class="stock_number">In Stock</span>
                    </div>
                    <hr>
                    <form action="" class="form-submit">
                        <input type="hidden" class="product_id" value="<?= $result['id'] ?>">
                        <input type="hidden" class="product_price" value="<?= $result['product_price'] ?>">
                        <a class="m-2 mr-2 btn btn-info text-center additembtn">Add to Cart</a>
                    </form>
                </div>
            </div>
        </div>

    </section>

    <div class="container mt-5 ">
        <div class="related-product">
            <h2>Realted Product</h2>
            <hr class="line mt-4">
        </div>
        <div class="row  mt-3">
            <?php
            $products_query = $pdo_con->prepare("SELECT * FROM product WHERE categorie = ? LIMIT 6 ");
            $products_query->bindParam(1, $result['categorie']);
            $products_query->execute();

            while ($row = $products_query->fetch()) :
            ?>
                <div class="col-lg-3 col-12 col-md-4 col-sm-6">
                    <div class="card">
                        <div class="card-body p-2 mb-2 mt-3 border-primary">
                            <img class="card-img-top p-4" src="data:image/jpg;base64, <?= base64_encode($row['product_image']) ?>" />
                            <p class="text-center mt-2"><b><?= $row['product_name'] ?></b> </p>
                            <h5 class="text-center text-success"><b>$<?= number_format($row['product_price'], 2) ?></b> </h5>
                            <div class="card-fotter p-1">
                                <form action="" class="form-submit">
                                    <input type="hidden" class="product_id" value="<?= $row['id'] ?>">
                                    <input type="hidden" class="product_price" value="<?= $row['product_price'] ?>">
                                    <div class="row">
                                        <a class="col ml-2 mr-2 btn btn-info btn-sm text-center additembtn">Add to Cart</a>
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


    <?php require('./footer.php'); ?>
</body>

</html>