<?php

require 'includes/_header.php';
$Auth->allow('super-admin');

$confSQL = Config::get('conf_accueil');

try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

$delete_carte = $DB->prepare('DELETE FROM payicam_carte WHERE carte_id=:carte_id');
$delete_carte->execute(array('carte_id' => $_GET['id']*1));

Functions::setFlashAndRedirect('index_admin.php', "Suppression effectuée");