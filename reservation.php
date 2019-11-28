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
      <th scope="col">#</th>
      <th scope="col">Objet</th>
      <th scope="col">Quantité</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php
    $i=1;
    foreach($items as $items) { ?>
    <tr>
      <th scope="row"><?= $items['item_id']; ?></th>
      <td><?= $items['name']; ?></td>
      <td><?= $items['quantity']; ?></td>
      <td>
      
<!-- Réserver un objet -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#LouerObjet">
  Réserver
</button>
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
              <select class="form-control" id="exampleFormControlSelect1" name="">
                <option>10</option>
                <option>30</option>
                <option>50</option>
                <option>80</option>
                <option>100</option>
                <option>150</option>
                <option>200</option>
                <option>300</option>
              </select>
            </div>
            <label>Adresse mail</label>
            <input type="email" class="form-control" id="exampleFormControlInput1" placeholder="prénom.nom@promo.icam.fr">
            DEBUT
            <input type="datetime-local" class="form-control" name="blabla">
            FIN
            <input type="datetime-local" class="form-control" name="blabla5">







            <div class='input-group date' id='datetimepicker6'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="oi oi-pencil"></span>
                </span>
            </div>


            
            
            
            
            <div class='input-group date' id='datetimepicker7'>
                <input type='text' class="form-control" />
                <span class="input-group-addon">
                    <span class="glyphicon glyphicon-calendar"></span>
                </span>
            </div>











          </div> 
        </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <button type="button" class="btn btn-primary">Envoyer la demande</button>
        </form>
      </div>
    </div>
  </div>
</div>
<form method="post" action="supprimer_objet.php">
<button type="submit" class="btn btn-danger">Supprimer</button>
<input type="hidden" name="object_id" value="<?php echo $items['item_id']; ?>">
</form>
      </td> 
    </tr>
    <?php $i++; } ?>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Formulaire d'ajout d'un objet</h5>
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
            <input type="email" class="form-control" id="exampleFormControlInput1" name="object_owner" placeholder="prénom.nom@promo.icam.fr">
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