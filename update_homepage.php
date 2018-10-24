<?php

require 'config.php';

$confSQL = $_CONFIG['conf_accueil'];

try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

// Prise en compte de modifs dans les input sinon appel des anciennes donnees de la bdd
for($i = 1; $i<5; $i++){
    if(!empty($_POST['maj_titre_'.$i])) {
        ${'maj_titre_'.$i} = htmlentities($_POST['maj_titre_'.$i], ENT_QUOTES);
    } else {
        die("Il y a eu une erreur, un des champs n'est pas passé");
    }
    if(!empty($_POST['maj_description_'.$i])) {
        ${'maj_description_'.$i} = htmlentities($_POST['maj_description_'.$i], ENT_QUOTES);
    } else {
        die("Il y a eu une erreur, un des champs n'est pas passé");
    }
    if(!empty($_POST['carte_'.$i.'_bouton'])) {
        ${'carte_'.$i.'_activation_bouton'} = $_POST['carte_'.$i.'_bouton'] == 'on' ? 1 : 0;
    } else {
        die("Il y a eu une erreur, un des champs n'est pas passé");
    }
    if(!empty($_POST['maj_nom_bouton_'.$i])) {
        ${'maj_nom_bouton_'.$i} = htmlentities($_POST['maj_nom_bouton_'.$i], ENT_QUOTES);
    } else {
        die("Il y a eu une erreur, un des champs n'est pas passé");
    }
}

// Update des nouvelles infos modifiees dans la bdd
for($i = 1; $i<5; $i++) {
    $data = array("carte_titre" => ${'maj_titre_'.$i},
    "carte_description" => ${'maj_description_'.$i},
    "carte_activation_bouton" => ${'carte_'.$i.'_activation_bouton'},
    "carte_bouton" => ${'maj_nom_bouton_'.$i},
    "carte_id" => $i
    );

    $requete_update_cartes = $DB->prepare("UPDATE payicam_carte SET carte_titre=:carte_titre, carte_description=:carte_description, carte_activation_bouton=:carte_activation_bouton, carte_bouton=:carte_bouton WHERE carte_id=:carte_id");
    $requete_update_cartes->execute(array("carte_titre" => ${'maj_titre_'.$i}, "carte_description" => ${'maj_description_'.$i}, "carte_activation_bouton" => ${'carte_'.$i.'_activation_bouton'}, "carte_bouton" => ${'maj_nom_bouton_'.$i},  "carte_id" => $i));
}

// upload des images
upload_images();

header('Location: index_admin.php');
die();

////////////////////////////////////// Fonction pour l'upload d'images
function upload_images($dossier='img/') {
    global $_CONFIG, $DB;
    $confSQL = $_CONFIG['conf_accueil'];

    $extensions = array('.png','.PNG', '.gif','.GIF', '.jpg','.JPG', '.jpeg','.JPEG');

    foreach($_FILES as $key => $image_file) {
        if(empty($image_file['name'])) {
            continue;
        }

        $extension = strrchr($image_file['name'], '.');

        if(!in_array($extension, $extensions)) {
            $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
        }

        if(!isset($erreur)){
            $fichier = basename($image_file['name']);
            $fichier = strtr($fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
            $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);

            $explosion = explode("_", $key);
            $type = $explosion[2];
            $index = $explosion[3];

            if(move_uploaded_file($image_file['tmp_name'], $dossier . $fichier)) {
                if($type=='slide') {
                    $requete_update_slide = $DB->prepare("UPDATE payicam_accueil_slide SET slide_image=:fichier WHERE slide_id=:index");
                }
                elseif($type=='carte') {
                    $requete_update_slide = $DB->prepare("UPDATE payicam_carte SET carte_photo=:fichier WHERE carte_id=:index");
                }
                else {
                    die("Le type d'image est incorrect");
                }
                $requete_update_slide->execute(array("fichier" => $fichier, "index" => $index));
            }
            else {
                die("L'upload n'a pas fonctionné");
            }
        } else {
            die($erreur);
        }
    }
}