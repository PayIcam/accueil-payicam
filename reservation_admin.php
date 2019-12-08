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
      <th scope="col"><center>#</center></th>
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
      <td><center>
                  <button type="button" class="
                  <?php if ($reservations['status'] == 'w') {echo "btn btn-primary";}
                        if ($reservations['status'] == 'v') {echo "btn btn-success";}
                        if ($reservations['status'] == 'a') {echo "btn btn-danger";}
                        if ($reservations['status'] == 'f') {echo "btn btn-secondary";}
                        ?>" data-toggle="modal" data-target="#exampleModalCenter">
                  <?php if ($reservations['status'] == 'w') {echo "En attente";}
                        if ($reservations['status'] == 'v') {echo "Acceptée";}
                        if ($reservations['status'] == 'a') {echo "Refusée";}
                        if ($reservations['status'] == 'f') {echo "Terminée";}
                        ?></button>
                  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLongTitle">Statut de la réservation</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form method="post" action="modifier_reservation.php">
                          <div class="modal-body">
                            <select class="selectpicker" multiple data-max-options="4" name="reservation_statue">
                              <option>En attente</option>
                              <option>Accepter la réservation</option>
                              <option>Refuser la réservation</option>
                              <option>Conclure la réservation</option>
                            </select>
                            <input type="hidden" name="reservation_id" value="<?php echo $reservations['reservation_id']; ?>">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-primary" action="modifier_reservation.php">Valider</button>  
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
        </center></td>
    </tr>
    <?php $i++; } ?>
  </tbody>
</table>

<?php include 'includes/footer.php'; ?>