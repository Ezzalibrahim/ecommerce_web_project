<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/cart.css">
    <link rel="stylesheet" href="../css/admin.css">
    <title>Document</title>
</head>

<body>

    <table class="table table-bordered table-striped text-center mt-2">
        <thead>
            <tr>
                <td colspan="7">
                    <h4 class="text-center text-info m-0">
                        The last Orders
                    </h4>
                </td>
            </tr>
            <tr>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Total Price</th>
                <th>Date Order</th>
                <th>
                    <a href="action.php?clear=all" onclick="return confirm('Are You Sure To Clear Your Cart');" class="badge badge-danger p-2 ">Delete Order</a>
                </th>
            </tr>
        </thead>
        <tbody>
            <?php
            require('../connect_bd.php');
            $query = $connection->prepare("SELECT *,ligne.id AS ligneId FROM product , ligne , commande , client 
            WHERE product.id = ligne.id_article AND ligne.commande_id = commande.id AND client.id = commande.id_client ");
            $query->execute();
            $cart_data = $query->get_result();

            $total_price = 0;

            while ($row_cart = $cart_data->fetch_assoc()) :

            ?>
                <tr>
                    <td>
                        <p class="mt-1">
                            <?= $row_cart['nom'] ?>
                        </p>
                    </td>
                    <td>
                        <p class="mt-1">
                            <?= $row_cart['prenom'] ?>
                        </p>
                    </td>
                    <td>
                        <p class="mt-1">
                            <?= $row_cart['product_name'] ?>
                        </p>
                    </td>
                    <td>
                        <p class="mt-1">
                            <?= $row_cart['quantite'] ?>
                        </p>
                    </td>
                    <td>
                        <b>$</b><?= number_format($row_cart['product_price'], 2) ?>
                    </td>
                    <td>
                        <b>$</b><?= number_format($row_cart['product_price'] * $row_cart['quantite'], 2) ?>
                    </td>
                    <td>
                        <p class="mt-1">
                            <?= $row_cart['date_commande'] ?>
                        </p>
                    </td>
                    <td>
                        <a href="manage_orders.php?delete_id=<?= $row_cart['ligneId'] ?>" class="text-white mt-4 badge badge-danger lead p-2" onclick="return confirm('Are You Sure To Delete this Ordr');"><b>Delete</b></a>
                    </td>
                </tr>
            <?php
            endwhile; ?>
        </tbody>
    </table>
    <?php
    if (isset($_GET['delete_id'])) {
        echo ('<h1>DELETE WORK' . $_GET['delete_id'] . ' h</h1>');

        $delete_ligne_id = $_GET['delete_id'];
        $query = $connection->prepare("DELETE FROM ligne WHERE id = ?");
        $query->bind_param("i", $delete_ligne_id);
        $query->execute();
    }
    ?>

    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/cart.js"></script>
</body>

</html>