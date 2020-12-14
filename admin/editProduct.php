<?php
require('../connect_bd.php');
?>
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
    <?php
    if (isset($_GET['delete_id'])) {
        echo ('<h1>DELETE WORK</h1>');

        $delete_product_id = $_GET['delete_id'];
        $query_image_product = $connection->prepare("DELETE  FROM product WHERE id = ?");
        $query_image_product->bind_param("i", $delete_product_id);
        $query_image_product->execute();
        header('location:manage_product.php');
    }
    ?>
    <?php
    if (isset($_GET['id'])) {

        $product_id = $_GET['id'];

        $query_image_product = $connection->prepare("SELECT * FROM product WHERE id = ?");
        $query_image_product->bind_param("i", $product_id);
        $query_image_product->execute();
        $result = $query_image_product->get_result();
        $r = $result->fetch_assoc();
    }
    ?>
    <!-- Model Edit Product Start -->
    <form action="" method="POST" class="m-5" enctype="multipart/form-data">
        <div class="form-group">
            <input type="text" name="name" value="<?php echo $r['product_name']; ?>" class="form-control form-control" placeholder="Product Name" require>
        </div>
        <div class="input-group">
            <div class="custom-file">
                <input type="file" name="photo" class="custom-file-input">
                <label class="custom-file-label">Choose image Product ....</label>
            </div>
        </div>
        <div class="form-group mt-4">
            <select name="product_categorie" class="form-control" id="" value="<?php echo $r['categorie']; ?>" require>
                <option selected disabled>Select Gatrgorie Product</option>
                <option <?php if ($r['categorie'] == "wearable tech") echo 'selected'; ?> value="wearable tech"> Wearable Tech </option>
                <option <?php if ($r['categorie'] == "camera") echo 'selected'; ?> value="camera"> Camera</option>
                <option <?php if ($r['categorie'] == "headphone") echo 'selected'; ?> value="headphone"> HeadPhone</option>
                <option <?php if ($r['categorie'] == "cell phone") echo 'selected'; ?> value="cell phone">Cell Phone </option>
                <option <?php if ($r['categorie'] == "computers") echo 'selected'; ?> value="computers">Computers </option>
                <option <?php if ($r['categorie'] == "tablet") echo 'selected'; ?> value="tablet"> Tablet</option>
            </select>
        </div>
        <div class="form-group">
            <input type="number" name="price" value="<?php echo $r['product_price']; ?>" class="form-control " placeholder="Product Price" require>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <input type="submit" name="edit_product" class="btn btn-primary" value="Edit Product" />
        </div>
    </form>
    <?php
    if (isset($_POST['edit_product'])) {

        $con = new PDO("mysql:host=localhost:3308;dbname=store", "root", "");

        $product_categorie = $_POST['product_categorie'];
        $product_name = $_POST['name'];
        $product_price = $_POST['price'];


        if (isset($_FILES['photo']) && !empty($_FILES['photo']['name'])) {
            echo '<h1> Not Empty </h1>';
            $data = file_get_contents($_FILES['photo']['tmp_name']);
            $stetm = $con->prepare('UPDATE product SET product_name = ? ,product_price = ?, product_image = ? , categorie = ?  WHERE id = ?');
            $stetm->bindParam(1, $product_name);
            $stetm->bindParam(2, $product_price);
            $stetm->bindParam(3, $data);
            $stetm->bindParam(4, $product_categorie);
            $stetm->bindParam(5, $product_id);
        } else {
            echo '<h1>  Empty </h1>';
            $stetm = $con->prepare('UPDATE product SET product_name = ? ,product_price = ?, categorie = ?  WHERE id = ?');

            $stetm->bindParam(1, $product_name);
            $stetm->bindParam(2, $product_price);
            $stetm->bindParam(3, $product_categorie);
            $stetm->bindParam(4, $product_id);
        }
        $product_id = $_GET['id'];




        $stetm->execute();
    }
    ?>


    <!--End Model Add Product  -->



    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>