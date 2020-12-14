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


    <!-- Modal -->

    <!-- Button trigger modal -->
    <button type="button" data-toggle="modal" data-target="#addproduct" class="btn btn-info mr-2">Add Product</button>
    <!-- end btn model -->
    <div class="modal fade mt-5" id="addproduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="text" name="name" class="form-control form-control" placeholder="Product Name" require>
                        </div>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" name="photo" class="custom-file-input" require>
                                <label class="custom-file-label">Choose image Product ....</label>
                            </div>
                        </div>
                        <div class="form-group mt-4">
                            <select name="product_categorie" class="form-control" id="">
                                <option selected disabled>Select Gatrgorie Product</option>
                                <option value="wearable tech"> Wearable Tech </option>
                                <option value="camera"> Camera</option>
                                <option value="headphone"> HeadPhone</option>
                                <option value="cell phone">Cell Phone </option>
                                <option value="computers">Computers </option>
                                <option value="tablet"> Tablet</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="number" name="price" class="form-control " placeholder="Product Price" require>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <input type="submit" name="add_product" class="btn btn-primary" value="Add Product" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--End Model Add Product  -->

    <?php

    if (isset($_POST['add_product'])) {

        $con = new PDO("mysql:host=localhost:3308;dbname=store", "root", "");

        $product_categorie = $_POST['product_categorie'];
        $product_name = $_POST['name'];
        $product_price = $_POST['price'];
        $data = file_get_contents($_FILES['photo']['tmp_name']);

        $stetm = $con->prepare('INSERT INTO product VALUES ("",?,?,?,?,"")');

        $stetm->bindParam(1, $product_name);
        $stetm->bindParam(2, $product_price);
        $stetm->bindParam(3, $data);
        $stetm->bindParam(4, $product_categorie);

        $stetm->execute();
    }
    ?>

    <table class="table table-bordered table-striped text-center mt-2 ">
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
                <th>Categorie</th>
                <th>Price</th>
                <th>Edit</th>
                <th>Delete</th>
                <!-- <th>
                    <a href="action.php?clear=all" onclick="return confirm('Are You Sure To Clear Your Cart');" class="badge badge-danger p-2 ">Clear Cart</a>
                </th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            require('../connect_bd.php');
            $query = $connection->prepare("SELECT * FROM product");
            // $query_image_product = $connection->prepare("SELECT * FROM product");
            $query->execute();
            $cart_data = $query->get_result();

            while ($row_cart = $cart_data->fetch_assoc()) :
                // $query_image_product->bind_param("i", $row_cart['product_id']);
                // $query_image_product->execute();
                // $result = $query_image_product->get_result();
                // $r = $result->fetch_assoc();
            ?>
                <tr>
                    <td>
                        <img height="80px" width="60px" src="data:image/jpg;base64, <?= base64_encode($row_cart['product_image']) ?>" />
                    </td>
                    <td>
                        <p class="mt-4">
                            <?= $row_cart['product_name']  ?>
                        </p>
                    </td>
                    <td>
                        <p class="mt-4">
                            <?= $row_cart['categorie']  ?>
                        </p>
                    </td>
                    <td>
                        <p class="mt-4">
                            <b>$</b><?= number_format($row_cart['product_price'], 2) ?>
                        </p>
                    </td>
                    <td>
                        <a class="text-white mt-3 btn btn-success lead " href="editProduct.php?id=<?= $row_cart['id'] ?>">Edit</a>
                    </td>
                    <td>
                        <a class="text-white mt-4 badge badge-danger lead p-2" onclick="return confirm('Are You Sure To Delete this Product');" href="editProduct.php?delete_id=<?= $row_cart['id'] ?>"><b>Delete</b></a>
                    </td>
                </tr>
            <?php
            endwhile; ?>
        </tbody>
        <?php
        if (isset($_POST['remove_product'])) {

            // $con = new PDO("mysql:host=localhost:3308;dbname=store", "root", "");
            // $product_categorie = $_POST['product_categorie'];
            echo ('<h1>  word </h1>');
        }
        ?>
    </table>


    <script src="../js/jquery.js"></script>
    <script src="../js/bootstrap.min.js"></script>
</body>

</html>