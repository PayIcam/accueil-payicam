<?php

require 'includes/_header.php';
$Auth->allow('super-admin');

if(!empty($_POST['alt'])) {
    $alt = htmlspecialchars($_POST['alt']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de slide : T'as oublié de mettre un alt", 'danger');
}
if(empty($_FILES['file']['name'])) {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de slide : Il n'y a pas d'image", 'danger');
}

$url = upload_image('file', 'carte');
$new_slide = [
    'url' => $url,
    'alt' => $alt,
];

$add_slide = $accueil_db->prepare('INSERT INTO slides(url, alt) VALUES (:url, :alt)');
$add_slide->execute($new_slide);

Functions::setFlashAndRedirect('index_admin.php', "Ajout effectué");