<?php

require_once 'includes/_header.php';

$new_reservation = array(
	'mail' => $Auth->getUser()['email'],
	'quantity' => htmlspecialchars($_POST['reservation_quantity']),
	'start_date' => htmlspecialchars($_POST['reservation_start_date']),
	'end_date' => htmlspecialchars($_POST['reservation_end_date']),
	'status' => 'W',
	'item' => htmlspecialchars($_POST['object_id'])
);

$add_reservation = $accueil_db->prepare('INSERT INTO reservation(email, quantity, start_date, end_date, status, item_id) VALUES(:mail, :quantity, :start_date, :end_date, :status, :item)');
$add_reservation->execute($new_reservation);

Functions::setFlashAndRedirect('Réservation effectuée', 'success', 'reservation.php');
