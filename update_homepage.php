<?php

require 'includes/_header.php';

$confSQL = Config::get('conf_accueil');

try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}
//CONNEXION A LA DB

foreach($_POST['maj_titre'] as $carte_id => $titre) {
    if(!empty($titre)) {
        $titre = htmlspecialchars($titre);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre un titre", 'danger');
    }
    if(!empty($_POST['maj_description'][$carte_id])) {
        $description = htmlspecialchars($_POST['maj_description'][$carte_id]);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre une description", 'danger');
    }
    if(!empty($_POST['maj_actif'][$carte_id])) {
        $activation_bouton = $_POST['maj_actif'][$carte_id] == 'off' ? 0 : 1;
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "On ne sait pas si tu veux activer la carte", 'danger');
    }
    if(!empty($_POST['maj_bouton'][$carte_id])) {
        $bouton = htmlspecialchars($_POST['maj_bouton'][$carte_id]);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre un nom au bouton", 'danger');
    }
    if(!empty($_POST['maj_lien'][$carte_id])) {
        $lien = htmlspecialchars($_POST['maj_lien'][$carte_id]);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre un lien", 'danger');
    }

    $carte = array(
        'carte_id' => $carte_id,
        'carte_titre' => $titre,
        'carte_description' => $description,
        'carte_activation_bouton' => $activation_bouton,
        'carte_bouton' => $bouton,
        'carte_lien' => $lien
    );

    $update = $DB->prepare('UPDATE payicam_carte
        SET carte_titre = :carte_titre,
        carte_description = :carte_description,
        carte_activation_bouton = :carte_activation_bouton,
        carte_bouton = :carte_bouton,
        carte_lien = :carte_lien
        WHERE carte_id = :carte_id');
    $update->execute($carte);

    if(!empty($_FILES['input_image_carte']['name'][$carte_id])) {
        upload_image('input_image_carte', 'carte', $carte_id, true);
    }
}

foreach($_FILES['input_image_slide']['name'] as $slide_id => $name) {
    if(!empty($_FILES['input_image_slide']['name'][$slide_id])) {
        upload_image('input_image_slide', 'slide', $slide_id, true);
    }
}
    
Functions::setFlashAndRedirect('index_admin.php', "Modification effectuée");