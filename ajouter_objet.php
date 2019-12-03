<?php
require_once 'includes/_header.php';

try{
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

			$requete='INSERT INTO item VALUES(NULL,"'.$_POST['object_name'].'","'.$_POST['object_description'].'","'.$_POST['object_quantity'].'","'.$_SESSION['login'].'")';
			$resultat = $DB->query($requete);
			if ($resultat)
				header ('location: reservation.php');
			else
				echo 'Erreur';
?>