<?php
$hostname = "localhost:3308";
$username = "root";
$pass = "";
$dbname = "store";
$connection = mysqli_connect($hostname, $username, $pass, $dbname);


$pdo_con = new PDO("mysql:host=localhost:3308;dbname=store", "root", "");
if (mysqli_connect_error($connection)) {
    echo "connection error" . mysqli_connect_error();
    die();
}

$query = "SELECT * FROM  ";
