<?php

require 'includes/_header.php';
$Auth->allow('super-admin');

if(!empty($_POST['title'])) {
    $title = htmlspecialchars($_POST['title']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : T'as oublié de mettre un titre", 'danger');
}
if(!empty($_POST['description'])) {
    $description = htmlspecialchars($_POST['description']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : T'as oublié de mettre une description", 'danger');
}
if(!empty($_POST['active_button'])) {
    $active_button = $_POST['active_button'] == 'off' ? 0 : 1;
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : On ne sait pas si tu veux activer la carte", 'danger');
}
if(!empty($_POST['button_title'])) {
    $button_title = htmlspecialchars($_POST['button_title']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : T'as oublié de mettre un nom au bouton", 'danger');
}
if(!empty($_POST['target'])) {
    $target = htmlspecialchars($_POST['target']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : T'as oublié de mettre un lien", 'danger');
}
if(empty($_FILES['file']['name'])) {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : Il n'y a pas d'image", 'danger');
}

$photo_url = upload_image('file', 'carte');
$new_carte = array(
    'title' => $title,
    'description' => $description,
    'active_button' => $active_button,
    'button_title' => $button_title,
    'target' => $target,
    'photo_url' => $photo_url,
);

$add_carte = $accueil_db->prepare('INSERT INTO cartes(title, description, active_button, button_title, target, photo_url) VALUES (:title, :description, :active_button, :button_title, :target, :photo_url)');
$add_carte->execute($new_carte);
$carte_id = $accueil_db->lastInsertId();

Functions::setFlashAndRedirect('index_admin.php', "Ajout effectué");