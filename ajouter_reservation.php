<?php
require_once 'includes/_header.php';

try{
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());

}

			$requete='INSERT INTO reservation VALUES(NULL,"'.$_SESSION['login'].'","'.$_POST['reservation_quantity'].'","'.$_POST['reservation_start_date'].'","'.$_POST['reservation_end_date'].'","'.$_POST['reservation_statue'].'","'.$_POST['object_id'].'")';
			$resultat = $DB->query($requete);
			if ($resultat)
				header ('location: reservation.php');
			else
				echo 'Erreur';
?>