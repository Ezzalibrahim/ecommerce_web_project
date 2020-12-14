<?php

use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Location;

require '../connect_bd.php';
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
                <h2 class="text-center"> Create An Account</h2>
                <p class="text-center">Please fiil out this form to register with us</p>
                <form action="register.php" method="POST">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="nom">Nom <sup>*</sup> : </label>
                                <input type="text" name="nom" class="form-control form-control-lg" require>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="prenom">Prénom <sup>*</sup> : </label>
                                <input type="text" name="prenom" class="form-control form-control-lg " require>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="age">Age <sup>*</sup> : </label>
                                <input type="number" name="age" class="form-control form-control-lg " require>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="ville">Ville <sup>*</sup> : </label>
                                <input type="text" name="ville" class="form-control form-control-lg " require>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse <sup>*</sup> : </label>
                        <input type="text" name="adresse" class="form-control form-control-lg " require>
                    </div>
                    <div class="form-group">
                        <label for="email">Email <sup>*</sup> : </label>
                        <input type="email" name="email" class="form-control form-control-lg" require>
                    </div>
                    <div class="form-group">
                        <label for="password">Password <sup>*</sup> : </label>
                        <input type="password" name="password" class="form-control form-control-lg" require>
                    </div>
                    <div class="form-group">
                        <label for="confirm_password">Confirme Password <sup>*</sup> :</label>
                        <input type="password" name="confirm_password" class="form-control form-control-lg " require>
                    </div>
                    <div class="row">
                        <div class="col">
                            <input type="submit" name="register" value="Register" class="btn btn-success btn-block" require>
                        </div>
                        <div class="col">
                            <a href="login.php" class="btn btn-light btn-block">Have An Account ? Login</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    function getClientByEmail($pdo_con, $email)
    {
        $stetm = $pdo_con->prepare('SELECT * FROM client WHERE email = ?');
        $stetm->bindParam(1, $email);
        $stetm->execute();
        $count = $stetm->rowCount();
        return $count ? false : true;
    }
    function checkInput()
    {
        if (
            $_POST['nom'] != "" && $_POST['prenom'] != "" && $_POST['age'] != "" && $_POST['ville'] != ""
            && $_POST['adresse'] != "" && $_POST['email'] != "" && $_POST['password'] != ""
        )
            return true;
        else
            return false;
    }


    // Client Register 
    if (isset($_POST['register']) && checkInput()) {

        if ($_POST['password'] === $_POST['confirm_password']) {
            if (getClientByEmail($pdo_con, $_POST['email'])) {
                $stetm = $pdo_con->prepare('INSERT INTO client VALUES ("",?,?,?,?,?,?,?)');

                $stetm->bindParam(1, $_POST['nom']);
                $stetm->bindParam(2, $_POST['prenom']);
                $stetm->bindParam(3, $_POST['age']);
                $stetm->bindParam(4, $_POST['adresse']);
                $stetm->bindParam(5, $_POST['ville']);
                $stetm->bindParam(6, $_POST['email']);
                $stetm->bindParam(7, password_hash($_POST['password'], PASSWORD_DEFAULT));

                $stetm->execute();
                echo "<script> location.href='login.php'; </script>";
                exit;
            } else {
                echo "<script> alert('This Email Alredy exist'); </script>";
            }
        } else {
            echo "<script> alert('an input is empty Or a problem in password'); </script>";
        }
    }
    ?>