<?php
require_once 'includes/_header.php';

$Auth->allow('member');
$user = $Auth->getUser();
require_once ROOT_PATH.'class/DB.php';
include('config.php');
$title_for_layout = 'Accueil';
$js_for_layout = array('bootstrap.min.js', 'indice_gala');

$confSQL = $_CONFIG['conf_accueil'];

try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation

$requete_reservations = $DB->prepare("SELECT * FROM reservation");
$requete_reservations->execute();
$reservations = $requete_reservations->fetchAll();
?>

<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col"><center>Objet</center></th>
      <th scope="col"><center>Quantité</center></th>
      <th scope="col"><center>Demandeur</center></th>
      <th scope="col"><center>Début</center></th>
      <th scope="col"><center>Fin</center></th>
      <th scope="col"><center>Action</center></th>
    </tr>
  </thead>
  <tbody>
  	<?php
    $i=1;
    foreach($reservations as $reservations) { ?>
    <tr>
      <th scope="row"><?= $reservations['reservation_id']; ?></th>
      <td><center><?= $reservations['item_id']; ?></center></td>
      <td><center><?= $reservations['quantity']; ?></center></td>
      <td><center><?= $reservations['email']; ?></center></td>
      <td><center><?= $reservations['start_date']; ?></center></td>
      <td><center><?= $reservations['end_date']; ?></center></td>
      <td><center><?= $reservations['status']; ?></center></td>
    </tr>
    <?php $i++; } ?>
  </tbody>
</table>

<?php include 'includes/footer.php'; ?>