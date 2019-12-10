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

$requete_items = $DB->query("SELECT * FROM item");
$items = $requete_items->fetchAll();
?>

<table class="table">
    <thead class="thead-light">
        <tr>
            <th scope="col"><center>Objet</center></th>
            <th scope="col"><center>Quantité</center></th>
            <th scope="col"><center>Propriétaire</center></th>
            <th scope="col"><center>Action</center></th>
        </tr>
    </thead>
    <tbody>
        <?php
            foreach($items as $item) { 
                if ($item['visibility'] == 0) {
        ?>
                    <tr>
                        <td><center><?= $item['name']; ?></center></td>
                        <td><center><?= $item['quantity']; ?></center></td>
                        <td><center><?= $item['email']; ?></center></td>
                        <td><center>
                            <!-- Réserver un objet -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#LouerObjet">Réserver</button>
                            <div class="modal fade" id="LouerObjet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Demande pour <?= $item['name']; ?></h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form method="post" action="ajouter_reservation.php">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <label for="exampleFormControlSelect1">Quantité</label>
                                                        <input class="form-control" type="text" name="reservation_quantity" placeholder="Quantité (exemple: 1; 2; 3; 10; 150)">
                                                    </div>
                                                    <label for="exampleFormControlSelect1">Date de début</label>
                                                    <input type="datetime-local" class="form-control" name="reservation_start_date">
                                                    <label for="exampleFormControlSelect1">Date de fin</label>
                                                    <input type="datetime-local" class="form-control" name="reservation_end_date">
                                                    <input type="hidden" name="reservation_status" value="W">
                                                    <input type="hidden" name="object_id" value="<?php echo $item['item_id']; ?>">
                                                </div> 
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                                <button type="submit" class="btn btn-primary" action="ajouter_reservation.php">Envoyer la demande</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <a class="btn btn-danger" href="supprimer_objet.php?object_id=<?= $item['item_id']; ?>" role="button">Supprimer</a>
                        </center></td>
                    </tr>
        <?php
                } 
            }
        ?>
    </tbody>
</table>

<!-- Ajouter objet -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#AjouterObjet">Ajouter un objet</button>
    <div class="modal fade" id="AjouterObjet" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Ajouter un objet</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" action="ajouter_objet.php">
                    <div class="modal-body">
                        <div class="form-group">
                            <h4 class="card-title"><input class="form-control" name="object_name" autofocus placeholder="Nom objet" rows="1"></h4>
                            <h4 class="card-title"><input class="form-control" name="object_quantity" autofocus placeholder="Quantité (exemple: 1; 2; 3; 10; 150)"></h4>
                            <p class="card-text">
                                <textarea class="form-control" name= "object_description" autofocus placeholder="Description de l'objet" rows="4"></textarea>
                            </p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter l'objet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- Gestion des réservations -->
<a class="btn btn-primary" href="reservation_admin.php" role="button">Gérer les réservations</a>

<?php include 'includes/footer.php'; ?>