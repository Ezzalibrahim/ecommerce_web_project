<?php
require('connect_bd.php');

// get client and orders and product
$stetm =   $pdo_con->prepare("SELECT DISTINCT client.nom , client.id FROM client , commande WHERE client.id = commande.id_client ");
$stetm->execute();
$data = array();

while ($row = $stetm->fetch(PDO::FETCH_ASSOC)) {
    $get_commande = $pdo_con->prepare('SELECT COUNT(*) AS total_commande FROM commande WHERE id_client = ?');
    $get_commande->bindParam(1, $row['id']);
    $get_commande->execute();
    $total_commande = $get_commande->fetch(PDO::FETCH_ASSOC);

    $data[] = [
        "nom" => $row['nom'],
        "total_commande" => $total_commande['total_commande'],
    ];
}

echo json_encode($data);
