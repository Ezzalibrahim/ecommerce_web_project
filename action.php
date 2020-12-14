<?php
session_start();
require('connect_bd.php');

?>


<?php
// Add product to Cart(Ligne)
if (isset($_POST['product_id'])) {

    // redirct if not login 
    if (!isset($_SESSION['name'])) :
?>
        <script>
            window.location = "login.php";
        </script>
<?php
        return;
    endif;
    $product_id = $_POST['product_id'];
    $product_price = $_POST['product_price'];
    $quantity = 1;

    $query = $pdo_con->prepare("SELECT id_article FROM ligne  WHERE id_article = ? AND commande_id = ?");
    $query->bindParam(1, $product_id);
    $query->bindParam(2, $_SESSION['commande_id']);
    $query->execute();
    $result = $query->rowCount();

    if ($result == 0) {

        // Insert in ligne
        $query_ligne = $pdo_con->prepare('INSERT INTO ligne(commande_id , id_article , quantite , prix_unit)  VALUES(?,?,?,?)');
        $query_ligne->bindParam(1, $_SESSION['commande_id']);
        $query_ligne->bindParam(2, $product_id);
        $query_ligne->bindParam(3, $quantity);
        $query_ligne->bindParam(4, $product_price);

        $query_ligne->execute();

        echo '
            <div class="alert alert-success alert-dismissible">
            <strong>Item Added To Your Cart</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
        ';
    } else {
        echo '
        <div class="alert alert-danger alert-dismissible">
        <button type="button" class="close" data-dismiss="alert">&times; </button>
        <strong>Item Already Added To Your Cart</strong>
        </div>
    ';
    }
}

// Count cart item
if (isset($_GET['cartitem'])) {
    $query_count = $pdo_con->prepare("SELECT * FROM ligne WHERE commande_id = ?");
    $query_count->bindParam(1, $_SESSION['commande_id']);
    $query_count->execute();
    $cart_counter = $query_count->rowCount();

    echo $cart_counter;
}

// remove a Product
if (isset($_GET['remove'])) {
    $id = $_GET['remove'];
    $delete_query = $pdo_con->prepare("DELETE FROM ligne WHERE id_article = ? AND commande_id = ?");
    $delete_query->bindParam(1, $id);
    $delete_query->bindParam(2, $_SESSION['commande_id']);
    $delete_query->execute();

    header('location:cart.php');
}

// clear Cart
if (isset($_GET['clear'])) {
    $delete_all_query = $pdo_con->prepare("DELETE  FROM ligne WHERE commande_id = ?");
    $delete_all_query->bindParam(1, $_SESSION['commande_id']);
    $delete_all_query->execute();
    header('location:cart.php');
}



if (isset($_POST['product_quantity'])) {
    $cart_id_upadte = $_POST['cart_id'];
    $product_quantity_upadte = $_POST['product_quantity'];
    $product_price_upadte = $_POST['product_price'];

    $total_price_upadte = $product_quantity_upadte * $product_price_upadte;

    $update_query = $pdo_con->prepare("UPDATE ligne SET quantite=? , prix_unit=? WHERE id=? ");
    $update_query->bindParam(1, $product_quantity_upadte);
    $update_query->bindParam(2, $total_price_upadte);
    $update_query->bindParam(3, $cart_id_upadte);
    $update_query->execute();
}
