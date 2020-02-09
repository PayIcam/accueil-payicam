<?php

require_once 'includes/_header.php';

if (!empty($_POST['object_name'])) {
    $name = htmlspecialchars($_POST['object_name']);
} else {
    die("Il manque un nom à l'objet.");
}

if (!empty($_POST['object_quantity'])) {
    $quantity = htmlspecialchars($_POST['object_quantity']);
} else {
    die("Il manque une quantité à l'objet");
}

$new_object = array(
	'name' => htmlspecialchars($_POST['object_name']),
	'description' => htmlspecialchars($_POST['object_description']),
	'quantity' => htmlspecialchars($_POST['object_quantity']),
	'email' => $Auth->getUser()['email'],
	'visibility' => '0'
);

$add_object = $accueil_db->prepare('INSERT INTO item(name, description, quantity, email, visibility) VALUES(:name, :description, :quantity, :email, :visibility)');
$add_object->execute($new_object);

Functions::setFlashAndRedirect('Objet ajouté', 'success', 'reservation.php');

?>