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
      <th scope="col">Objet</th>
      <th scope="col">Quantité</th>
      <th scope="col">Demandeur</th>
      <th scope="col">Début</th>
      <th scope="col">Fin</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php
    $i=1;
    foreach($reservations as $reservations) { ?>
    <tr>
      <th scope="row">1</th>
      <td><?= $reservations['item_id']; ?></td>
      <td><?= $reservations['email']; ?></td>
      <td><?= $reservations['quantity']; ?></td>
      <td><?= $reservations['start_date']; ?></td>
      <td><?= $reservations['end_date']; ?></td>
      <td><?= $reservations['status']; ?></td>
    </tr>
    <?php $i++; } ?>
  </tbody>
</table>

<?php include 'includes/footer.php'; ?>