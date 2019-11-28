<?php


require_once 'includes/_header.php';

try{
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

var_dump($_SESSION);
$mail = $_SESSION['login'];
var_dump($mail);
die();
			$requete='INSERT INTO reservation VALUES(NULL,"'.$_POST['reservation_email'].'","'.$_POST['reservation_quantity'].'","'.$_POST['reservation_start_date'].'","'.$_POST['reservation_end_date'].'")';
			$resultat = $DB->query($requete);
			if ($resultat)
				header ('location : reservation.php');
			else
				echo 'Erreur';
?>