<?php

require 'includes/_header.php';
$Auth->allow('super-admin');

$confSQL = Config::get('conf_accueil');

$delete_carte = $accueil_db->prepare('DELETE FROM slides WHERE id=:id');
$delete_carte->execute(array('id' => $_GET['id']*1));

Functions::setFlashAndRedirect('index_admin.php', "Suppression effectuée");