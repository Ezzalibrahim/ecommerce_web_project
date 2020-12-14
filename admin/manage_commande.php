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
                        Our Commande
                    </h4>
                </td>
            </tr>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Adresse</th>
                <th>Ville</th>
                <th>Date Commande</th>
                <th>Delete Commande</th>
                <!-- <th>
                    <a href="action.php?clear=all" onclick="return confirm('Are You Sure To Clear Your Cart');" class="badge badge-danger p-2 ">Clear Cart</a>
                </th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            require('../connect_bd.php');
            $query = $connection->prepare("SELECT * FROM client , commande WHERE commande.id_client = client.id ");
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
                            <?= $row_cart['adresse'] ?>
                        </p>
                    </td>
                    <td>

                        <p class="mt-1">
                            <?= $row_cart['ville'] ?>
                        </p>
                    </td>
                    <td>

                        <p class="mt-1">
                            <?= $row_cart['date_commande'] ?>
                        </p>
                    </td>
                    <td>
                        <a href="manage_commande.php?delete_id=<?= $row_cart['id'] ?>" class="text-white mt-1 badge badge-danger lead p-2" onclick="return confirm('Are You Sure To Delete this Commande');"><b>Delete</b></a>
                    </td>
                </tr>
            <?php
            endwhile; ?>
        </tbody>
    </table>

    <?php
    if (isset($_GET['delete_id'])) {
        echo ('<h1>DELETE WORK' . $_GET['delete_id'] . ' </h1>');

        $delete_commande_id = $_GET['delete_id'];
        $query = $connection->prepare("DELETE FROM commande WHERE id = ?");
        $query->bind_param("i", $delete_commande_id);
        $query->execute();
    }
    ?>
    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <script src="../js/cart.js"></script>
</body>

</html>