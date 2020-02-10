<?php

require_once 'includes/_header.php';

$requete_reservations = $accueil_payicam->query("SELECT * FROM reservation");
$reservations = $requete_reservations->fetchAll();

$update = $accueil_payicam->prepare('UPDATE reservation SET status=:status WHERE reservation_id=:reservation_id');
$update->execute(array('status' => $_GET['reservation_status'], 'reservation_id' => $_GET['reservation_id']));

header('Location: reservation_admin.php');

?>