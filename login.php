<?php
session_start();
require('./connect_bd.php');

if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/cart.css">
    <link rel="stylesheet" href="./css/admin.css">
    <title>Login</title>
</head>

<body class="container">

    <div class="row mt-5 ">
        <div class="col-md-6 mt-5 col-sm-12 mr-auto">
            <div class="card card-body bg-light mt-3">
                <h2 class="text-center"> Login An Account</h2>
                <p class="text-center">Please fill out this form to Login </p>
                <form action="login.php" method="POST">
                    <div class="form-group">
                        <label for="email">Email <sup>*</sup> : </label>
                        <input type="email" name="email" class="form-control form-control-md">
                    </div>
                    <div class="form-group">
                        <label for="password">Password <sup>*</sup> : </label>
                        <input type="password" name="password" class="form-control form-control-md">
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
        <div class="col-md-6 mt-5 col-sm-12 ml-auto">
            <img src="./images/login_form.png" height="100%" width="95%" alt="login form image" srcset="">
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
                    $_SESSION['name'] = $result['nom'];
                    $_SESSION['id'] = $result['id'];

                    // Insert in Commande 
                    $query_commande = $pdo_con->prepare('INSERT INTO commande (id_client) VALUES(?)');
                    $query_commande->bindParam(1, $_SESSION['id']);
                    $query_commande->execute();

                    // Get id commande to use it in isertion of ligne
                    $query_commande_get_id = $pdo_con->prepare('SELECT * FROM commande WHERE id_client = ? ORDER BY date_commande DESC LIMIT 1');
                    $query_commande_get_id->bindParam(1, $_SESSION['id']);
                    $query_commande_get_id->execute();

                    $commande_id = $query_commande_get_id->fetch();

                    $_SESSION['commande_id'] = $commande_id['id'];
                    echo "<script> location.href='index_bootstrap.php'; </script>";
                    exit;
                } else {
                    echo "<script> alert('Email Or password Incorrect'); </script>";
                }
            }
        }
    }

    ?>