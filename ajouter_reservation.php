<?php

require_once 'includes/_header.php';

try {
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

$new_reservation = array(
	'mail' => $_SESSION['login'],
	'quantity' => htmlspecialchars($_POST['reservation_quantity']),
	'start_date' => htmlspecialchars($_POST['reservation_start_date']),
	'end_date' => htmlspecialchars($_POST['reservation_end_date']),
	'status' => 'W',
	'item' => htmlspecialchars($_POST['object_id'])
);

$add_reservation = $DB->prepare('INSERT INTO reservation(email, quantity, start_date, end_date, status, item_id) VALUES(:mail, :quantity, :start_date, :end_date, :status, :item)');
$add_reservation->execute($new_reservation);

Functions::setFlashAndRedirect('Réservation effectuée', 'success', 'reservation.php');
