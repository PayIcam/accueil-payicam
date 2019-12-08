<?php
require_once 'includes/_header.php';

try{
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());

}

$requete_reservations = $DB->prepare("SELECT * FROM reservation");
$requete_reservations->execute();
$reservations = $requete_reservations->fetchAll();

	if ($_POST['reservation_statue'] == 'En attente') { $statue == w; }
	if ($_POST['reservation_statue'] == 'Accepter la réservation') { $statue == v; }
	if ($_POST['reservation_statue'] == 'Refuser la réservation') { $statue == a; }
	if ($_POST['reservation_statue'] == 'Conclure la réservation')	{ $statue == f; }

			$requete='INSERT INTO reservation ("status") WHERE($_POST['reservation_id'] == $reservations['reservation_id']) VALUES("'.$statue.'")';
			$resultat = $DB->query($requete);
			if ($resultat)
				header ('location: reservation.php');
			else
				echo 'Erreur';
?>