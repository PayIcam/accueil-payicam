<?php
try{
    $DB = new PDO('mysql:host=localhost;dbname=payicam_accueil;charset=utf8','root','',array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}
			$requete="DELETE FROM item WHERE item_id={$_POST['object_id']}";
			$resultat = $DB->query($requete);
			if ($resultat)
				header ('location: reservation.php');
			else
				echo 'Erreur';
?>