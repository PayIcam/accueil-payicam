<?php

require_once 'includes/_header.php';

try {
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

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
	'email' => $_SESSION['login'],
	'visibility' => '0'
);

$add_object = $DB->prepare('INSERT INTO item(name, description, quantity, email, visibility) VALUES(:name, :description, :quantity, :email, :visibility)');
$add_object->execute($new_object);

header ('location: reservation.php');

?>