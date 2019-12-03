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

$requete_items = $DB->prepare("SELECT * FROM item");
$requete_items->execute();
$items = $requete_items->fetchAll();
?>

<table class="table">
  <thead class="thead-light">
    <tr>
      <th scope="col"><center>#</center></th>
      <th scope="col"><center>Objet</center></th>
      <th scope="col"><center>Quantité</center></th>
      <th scope="col"><center>Action</center></th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach($items as $items) { ?>
    <tr>
      <th scope="row"><center><?= $items['item_id']; ?></center></th>
      <td><center><?= $items['name']; ?></center></td>
      <td><center><?= $items['quantity']; ?></center></td>
      <td>
<!-- Réserver un objet -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#LouerObjet">Réserver</button>
  <div class="modal fade" id="LouerObjet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Demande pour <?= $items['name']; ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form method="post" action="ajouter_reservation.php">
            <div class="form-group">
              <div class="form-group">
                <label for="exampleFormControlSelect1">Quantité</label>
                <select class="form-control" id="exampleFormControlSelect1" name="reservation_quantity">
                  <option>10</option>
                  <option>30</option>
                  <option>50</option>
                  <option>80</option>
                  <option>100</option>
                  <option>150</option >
                  <option>200</option>
                  <option>300</option>
                </select>
              </div>
              <label for="exampleFormControlSelect1">Date de début</label>
              <input type="datetime-local" class="form-control" name="reservation_start_date">
              <label for="exampleFormControlSelect1">Date de fin</label>
              <input type="datetime-local" class="form-control" name="reservation_end_date">
              <input type="hidden" class="form-control" name="reservation_statue" value="w">
              <input type="hidden" name="object_id" value="<?php echo $items['item_id']; ?>">
            </div> 
          </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
              <button type="submit" class="btn btn-primary" action="ajouter_reservation.php">Envoyer la demande</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<form method="post" action="supprimer_objet.php">
  <input type="hidden" name="object_id" value="<?php echo $items['item_id']; ?>">
  <button type="submit" class="btn btn-danger">Supprimer</button>
</form>
      </td> 
    </tr>
    <?php } ?>
  </tbody>
</table>

<!-- Ajouter objet -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AjouterObjet">
  Ajouter un objet
</button>
<div class="modal fade" id="AjouterObjet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un objet</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="ajouter_objet.php">
          <div class="form-group">
            <h4 class="card-title"><input class="form-control" name="object_name" autofocus placeholder="Nom objet" rows="1"></h4>
            <h4 class="card-title"><input class="form-control" name="object_quantity" autofocus placeholder="Quantité (exemple: 1; 2; 3; 10; 150)" rows="1"></h4>
            <p class="card-text">
              <textarea class="form-control" name= "object_description" autofocus placeholder="Description de l'objet" rows="4"></textarea>
            </p>
          </div>
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="submit" class="btn btn-primary">Ajouter l'objet</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Gestion des réservations -->
<a class="btn btn-primary" href="reservation_admin.php" role="button">Gérer les réservations</a>

<?php include 'includes/footer.php'; ?>