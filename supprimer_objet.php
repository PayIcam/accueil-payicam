<?php

require_once 'includes/_header.php';

$createur = $accueil_db->prepare('SELECT email FROM item WHERE item_id=:item_id');
$createur->execute(array('item_id' => $_GET['object_id']));
$createur = $createur->fetch()['email'];

if ($Auth->getUser()['email'] !== $createur) {
	Functions::setFlashAndRedirect('Vous ne pouvez pas supprimer les objets des autres', 'danger', 'reservation.php');
}

$delete = $accueil_db->prepare('UPDATE item SET visibility=:visibility WHERE item_id=:item_id');
$delete->execute(array('visibility' => 1, 'item_id' => $_GET['object_id']));

header ('location: reservation.php');

?>