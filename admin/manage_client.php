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
                        Our Client
                    </h4>
                </td>
            </tr>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Age</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Delete Client</th>
                <!-- <th>
                    <a href="action.php?clear=all" onclick="return confirm('Are You Sure To Clear Your Cart');" class="badge badge-danger p-2 ">Clear Cart</a>
                </th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            require('../connect_bd.php');
            $query = $connection->prepare("SELECT * FROM client");
            $query->execute();
            $cart_data = $query->get_result();
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
                            <?= $row_cart['age'] ?>
                        </p>
                    </td>
                    <td>

                        <p class="mt-1">
                            <?= $row_cart['adresse'] ?>
                        </p>
                    </td>
                    <td>

                        <p class="mt-1">
                            <?= $row_cart['ville'] ?>
                        </p>
                    </td>
                    <td>
                        <a href="manage_client.php?delete_id=<?= $row_cart['id'] ?>" class="text-white mt-1 badge badge-danger lead p-2" onclick="return confirm('Are You Sure To Delete this Client');"><b>Delete</b></a>
                    </td>
                </tr>
            <?php
            endwhile; ?>
        </tbody>
    </table>

    <?php
    if (isset($_GET['delete_id'])) {
        echo ('<h1>DELETE WORK' . $_GET['delete_id'] . ' h</h1>');

        $delete_client_id = $_GET['delete_id'];
        $query_image_product = $connection->prepare("DELETE FROM client WHERE id = ?");
        $query_image_product->bind_param("i", $delete_client_id);
        $query_image_product->execute();
        //header('location:manage_client.php');
        // redirect('manage_client.php');
    }
    ?>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/cart.js"></script>
</body>

</html>