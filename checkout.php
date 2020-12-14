<?php
session_start();
require('connect_bd.php');

$total2 = 0;
$num_item = 0;

$sql2 = "SELECT product_name , quantite , prix_unit 
FROM ligne , product
WHERE ligne.id_article = product.id
AND ligne.commande_id = ?";

$sql_get =  $pdo_con->prepare($sql2);

$sql_get->bindParam(1, $_SESSION['commande_id']);

$sql_get->execute();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/cart.css">
    <title>Checkout</title>
</head>

<body>
    <?php
    require('navbar.php')
    ?>

    <div class="m-auto container row">
        <div class="col-md-5 order-md-2 mt-5">
            <h4 class="d-flex justify-content-between align-items-center mt-5">
                <span class="text-muted">Your cart</span>
            </h4>
            <ul class="list-group mb-3 mt-4">

                <?php
                while ($row_item = $sql_get->fetch()) :
                    $total2  += $row_item['prix_unit'];
                ?>
                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                        <div>
                            <h6 class="my-0"><?= $row_item['product_name'] ?></h6>
                            <small class="text-muted">Quantity : <b><?= $row_item['quantite'] ?></b> </small>
                        </div>
                        <b class="">$<?= number_format($row_item['prix_unit'], 2) ?> </b>
                    </li>
                <?php
                endwhile;
                ?>
                <li class="list-group-item d-flex justify-content-between">
                    <span>Total (USD)</span>
                    <strong>$<?php echo number_format($total2, 2); ?></strong>
                </li>
            </ul>

            <div class="input-group">
                <input type="text" class="form-control" placeholder="Enter Coupon Code">
                <div class="input-group-append">
                    <button type="button" class="btn btn-secondary">Apply</button>
                </div>
            </div>
        </div>
        <div class="col-md-7 order-md-1 mt-5">
            <h4 class="mb-3 text-center"> Enter Your Informations </h4>
            <form id="shipping_information">
                <div class="row">
                    <div class="col-md-6 mb-3 form-group">
                        <label for="firstName">First name</label>
                        <input type="text" class="form-control" id="firstName" placeholder="First name">
                        <div class="invalid-feedback">
                            Please enter your first name .
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 form-group">
                        <label for="lastName">Last name</label>
                        <input type="text" class="form-control" id="lastName" placeholder="Last name">
                        <div class="invalid-feedback">
                            Please enter your last name .
                        </div>
                    </div>
                </div>

                <div class="mb-3 form-group">
                    <label for="phone">Phone number</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="phone" placeholder="Phone number">
                        <div class="invalid-feedback" style="width: 100%;">
                            Please enter Your Phone number.
                        </div>
                    </div>
                </div>

                <div class="mb-3 form-group">
                    <label for="email">Email <span class="text-muted">(Optional)</span></label>
                    <input type="email" class="form-control" placeholder="example@example.com">
                    <div class="invalid-feedback">
                        Please enter a valid email address for shipping updates.
                    </div>
                </div>

                <div class="mb-3 form-group">
                    <label for="address">Address</label>
                    <input type="text" class="form-control" id="address" placeholder="Sidi Youssef Agadir">
                    <div class="invalid-feedback">
                        Please enter your shipping address.
                    </div>
                </div>

                <div class="mb-3 form-group">
                    <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                    <input type="text" class="form-control" id="address2" placeholder="Sidi Youssef Agadir">
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3 form-group">
                        <label for="city">City</label>
                        <input type="text" class="form-control" id="city" placeholder="Agadir">
                        <div class="invalid-feedback">
                            Please provide a valid city.
                        </div>
                    </div>
                    <div class="col-md-6 mb-3 form-group">
                        <label for="zip">Zip Code</label>
                        <input type="text" class="form-control" id="zip" placeholder="123456">
                        <div class="invalid-feedback">
                            Please enter your Zip code .
                        </div>
                    </div>
                </div>
                <hr class="mb-4">

                <h4 class="mb-3">Payment</h4>
                <div class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-12"> <span>CREDIT/DEBIT CARD PAYMENT</span> </div>
                                    <div class="col-md-12 float-right" style="float: right;"> <img src="https://img.icons8.com/color/36/000000/visa.png"> <img src="https://img.icons8.com/color/36/000000/mastercard.png"> <img src="https://img.icons8.com/color/36/000000/amex.png"> </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="cc_number" class="control-label">CARD NUMBER</label>
                                    <input id="cc_number" type="text" class="input-lg form-control cc-number" autocomplete="cc-number" placeholder="0123 4567 8910 1112" required>
                                    <div class="invalid-feedback">
                                        Please Enter a valid card Number.
                                    </div>
                                    <span class="text-success" id="valid_number"></span>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cc_exp" class="control-label">CARD EXPIRY</label>
                                            <input id="cc_exp" type="text" class="input-lg form-control cc-exp" autocomplete="cc-exp" placeholder="12/21" required>
                                            <div class="invalid-feedback">
                                                Please enter your Card Expiry .
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="cc_cvc" class="control-label">CARD CVC</label>
                                            <input id="cc_cvc" type="number" class="input-lg form-control cc-cvc" autocomplete="off" placeholder="123" required>
                                            <div class="invalid-feedback">
                                                Please enter your Card CVC.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input value="Make Payment" id="submit_payment" type="submit" class="btn btn-success btn-lg form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>

    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <div class="container">


    </div>
    <?php
    require('footer.php')
    ?>

    <script src="./js/checkout.js"></script>
</body>

</html>