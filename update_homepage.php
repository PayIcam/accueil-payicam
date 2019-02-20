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
        upload_image('input_image_carte', 'carte', $carte_id);
    }
}

foreach($_FILES['input_image_slide']['name'] as $slide_id => $name) {
    if(!empty($_FILES['input_image_slide']['name'][$slide_id])) {
        upload_image('input_image_slide', 'slide', $slide_id);
    }
}
    
Functions::setFlashAndRedirect('index_admin.php', "Modification effectuée");

////////////////////////////////////// Fonction pour l'upload d'images
function upload_image($index, $type, $id=null) {
    if(!in_array($type, ['slide', 'carte'])) {
        Functions::setFlashAndRedirect('index_admin.php', "Le type renseigné n'existe pas", "warning");
    }
    global $DB;

    $extensions = array('.png', '.jpeg', '.gif');
    $dossier = 'img/';

    $name = empty($id) ? $_FILES[$index]['name'] : $_FILES[$index]['name'][$id];

    $extension = strrchr($name, '.');
    if(!in_array($extension, $extensions)) {
        Functions::setFlashAndRedirect('index_admin.php', "Une des images n'est pas du bon format (jpeg/png/gif)", "warning");
    }
    $fichier = $dossier . $type . '_' . $id . $extension;

    $tmp_name = empty($id) ? $_FILES[$index]['tmp_name'] : $_FILES[$index]['tmp_name'][$id];

    if(move_uploaded_file($tmp_name, $fichier)) {
        if($type=='slide') {
            $requete_update_slide = $DB->prepare("UPDATE payicam_accueil_slide SET slide_image=:fichier WHERE slide_id=:id");
        }
        elseif($type=='carte') {
            $requete_update_slide = $DB->prepare("UPDATE payicam_carte SET carte_photo=:fichier WHERE carte_id=:id");
        }
        else {
            die("Le type d'image est incorrect");
        }
        $requete_update_slide->execute(array("fichier" => $fichier, "id" => $id));
    }
    else {
        Functions::setFlashAndRedirect('index_admin.php', "Pour une raison inconnue, l'upload n'a pas fonctionné", "warning");
    }
}