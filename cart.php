<?php
require('connect_bd.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/cart.css">
    <title>Cart</title>
</head>

<body>
    <?php
    require('navbar.php');
    ?>


    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 ">
                <div class="table-responsive mt-2">
                    <table class="table table-bordered table-striped text-center item-total">
                        <thead>
                            <tr>
                                <td colspan="7">
                                    <h4 class="text-center text-info m-0">
                                        Products In Your Cart
                                    </h4>
                                </td>
                            </tr>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>
                                    <a href="action.php?clear=all" onclick="return confirm('Are You Sure To Clear Your Cart');" class="badge badge-danger p-2 ">Clear Cart</a>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $total_price = 0;

                            $query_ligne = $pdo_con->prepare('SELECT *,ligne.id as ligneId FROM ligne , product 
                            WHERE ligne.id_article = product.id
                            AND ligne.commande_id = ?');

                            $query_ligne->bindParam(1, $_SESSION['commande_id']);
                            $query_ligne->execute();
                            while ($row_cart = $query_ligne->fetch()) :


                                // $query = $connection->prepare("SELECT * FROM cart");
                                // $query_image_product = $connection->prepare("SELECT * FROM product WHERE id=? ");
                                // $query->execute();
                                // $cart_data = $query->get_result();


                                // while ($row_cart = $cart_data->fetch_assoc()) :
                                //     $query_image_product->bind_param("i", $row_cart['product_id']);
                                //     $query_image_product->execute();
                                //     $result = $query_image_product->get_result();
                                //     $r = $result->fetch_assoc();
                            ?>
                                <tr>
                                    <input type="hidden" name="" class="cart_id" value="<?= $row_cart['ligneId'] ?>">
                                    <td>
                                        <img class="" height="100px" width="100px" src="data:image/jpg;base64, <?= base64_encode($row_cart['product_image']) ?>" />
                                    </td>
                                    <td>
                                        <?= $row_cart['product_name']  ?>
                                    </td>
                                    <td> <b>$</b><?= number_format($row_cart['product_price'], 2) ?></td>
                                    <input type="hidden" class="product_price" value="<?= $row_cart['product_price'] ?>">
                                    <td>
                                        <input type="number" style="width:60px" value="<?= $row_cart['quantite'] ?>" class="form-control item_quantity">
                                    </td>
                                    <td><b>$</b><?= number_format($row_cart['prix_unit'], 2) ?></td>
                                    <td>
                                        <a href="action.php?remove=<?= $row_cart['id'] ?>" class="text-white mt-4 badge badge-danger lead p-2" onclick="return confirm('Are You Sure To Delete Your Item');"><b>X</b></a>
                                    </td>
                                </tr>

                            <?php
                                $total_price += $row_cart['prix_unit'];
                            endwhile; ?>
                        </tbody>
                        <tr>
                            <td colspan="2">
                                <a href="index.php" class="btn btn-info">
                                    <!-- <img src="./font_svg/cart-plus-solid.svg" height="30px" alt=""> -->
                                    Continue Shopping</a>
                            </td>
                            <td colspan="2"> <b>Grand Total</b></td>
                            <td> <b>$ <?= number_format($total_price, 2) ?></b> </td>
                            <td colspan="1">
                                <a href="checkout.php" class="btn btn-info <?= ($total_price > 0) ? "" : "disabled"; ?>">
                                    <!-- <img src="./font_svg/cart-plus-solid.svg" alt=""> -->
                                    Checkout
                                </a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script src="./js/jquery.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/cart.js"></script>
</body>

</html>