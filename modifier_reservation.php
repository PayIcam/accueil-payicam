<?php

require_once 'includes/_header.php';

try {
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

$requete_reservations = $DB->query("SELECT * FROM reservation");
$reservations = $requete_reservations->fetchAll();

$update = $DB->prepare('UPDATE reservation SET status=:status WHERE reservation_id=:reservation_id');
$update->execute(array('status' => $_POST['reservation_status'], 'reservation_id' => $_POST['reservation_id']));

header('Location: reservation_admin.php');

?>