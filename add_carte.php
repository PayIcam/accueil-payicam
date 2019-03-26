<?php

require 'includes/_header.php';
$Auth->allow('super-admin');

$confSQL = Config::get('conf_accueil');

try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

if(!empty($_POST['new_carte_titre'])) {
    $titre = htmlspecialchars($_POST['new_carte_titre']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : T'as oublié de mettre un titre", 'danger');
}
if(!empty($_POST['new_carte_description'])) {
    $description = htmlspecialchars($_POST['new_carte_description']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : T'as oublié de mettre une description", 'danger');
}
if(!empty($_POST['new_carte_activation'])) {
    $activation_bouton = $_POST['new_carte_activation'] == 'off' ? 0 : 1;
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : On ne sait pas si tu veux activer la carte", 'danger');
}
if(!empty($_POST['new_carte_bouton'])) {
    $bouton = htmlspecialchars($_POST['new_carte_bouton']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : T'as oublié de mettre un nom au bouton", 'danger');
}
if(!empty($_POST['new_carte_lien'])) {
    $lien = htmlspecialchars($_POST['new_carte_lien']);
} else {
    Functions::setFlashAndRedirect('index_admin.php', "Ajout de carte : T'as oublié de mettre un lien", 'danger');
}



$new_carte = array(
        'carte_titre' => $titre,
        'carte_description' => $description,
        'carte_activation_bouton' => $activation_bouton,
        'carte_bouton' => $bouton,
        'carte_lien' => $lien
    );

var_dump(!empty($_FILES['new_carte_photo']['name']));
var_dump($_FILES['new_carte_photo']['name']);
// die();

$add_carte = $DB->prepare('INSERT INTO payicam_carte(carte_titre, carte_description, carte_activation_bouton, carte_bouton, carte_lien) VALUES (:carte_titre, :carte_description, :carte_activation_bouton, :carte_bouton, :carte_lien)');
$add_carte->execute($new_carte);
$carte_id = $DB->lastInsertId();

if(!empty($_FILES['new_carte_photo']['name'])) {
    upload_image('new_carte_photo', 'carte', $carte_id);
}

die();

Functions::setFlashAndRedirect('index_admin.php', "Ajout effectuée");