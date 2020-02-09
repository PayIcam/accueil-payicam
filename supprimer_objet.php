<?php

require_once 'includes/_header.php';

try {
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

$createur = $DB->prepare('SELECT email FROM item WHERE item_id=:item_id');
$createur->execute(array('item_id' => $_GET['object_id']));
$createur = $createur->fetch()['email'];

if ($Auth->getUser()['email'] !== $createur) {
	Functions::setFlashAndRedirect('Vous ne pouvez pas supprimer les objets des autres', 'danger', 'reservation.php');
}

$delete = $DB->prepare('UPDATE item SET visibility=:visibility WHERE item_id=:item_id');
$delete->execute(array('visibility' => 1, 'item_id' => $_GET['object_id']));

header ('location: reservation.php');

?>