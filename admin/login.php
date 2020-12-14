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
    <title>Admin-Section | Manage Products</title>
</head>

<body>
    <?php
    require('../navbar_admin.php');

    ?>
    <div class="row">
        <div class="col-md-6 mx-auto">
            <div class="card card-body bg-light mt-3">
                <h2 class="text-center"> Login An Account</h2>
                <p class="text-center">Please fill out this form to Login </p>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email <sup>*</sup> : </label>
                        <input type="email" name="email" class="form-control form-control-lg">
                    </div>
                    <div class="form-group">
                        <label for="password">Password <sup>*</sup> : </label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>

                    <div class="row">
                        <div class="col">
                            <input type="submit" name="login" value="login" class="btn btn-success btn-block">
                        </div>
                        <div class="col">
                            <a href="register.php" class="btn btn-light btn-block">Have't An Account ? Register</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_POST['login'])) {
        if ($_POST['email'] != "" && $_POST['password'] != "") {
            $stetm = $pdo_con->prepare('SELECT * FROM client WHERE email = ?');
            $stetm->bindParam(1, $_POST['email']);
            $stetm->execute();
            $result = $stetm->fetch();
            if ($stetm->rowCount()) {
                if (password_verify($_POST['password'], $result['password'])) {
                    session_start();
                    $_SESSION['name'] = $result['nom'];
                    echo '<h1>' . $_SESSION['name'] . '</h1>';
                    echo "<script> location.href='index.php'; </script>";
                    exit;
                }
            } else {
            }
        }
    }

    ?>