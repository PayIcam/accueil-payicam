<?php

require_once 'includes/_header.php';

$Auth->allow('member');
$user = $Auth->getUser();
require_once ROOT_PATH.'class/DB.php';
include('config.php');
$title_for_layout = 'Accueil';
$js_for_layout = array('bootstrap.min.js', 'indice_gala');
$confSQL = $_CONFIG['conf_accueil'];

try {
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation

$requete_reservations = $DB->query("SELECT * FROM reservation");
$reservations = $requete_reservations->fetchAll();
$requete_items = $DB->query("SELECT * FROM item");
$items = $requete_items->fetchAll();

$statuses = [
    'V' => [
        'name' => 'Validée',
        'class' => 'success',
        'status' => 'V'
    ],
    'A' => [
        'name' => 'Refusée',
        'class' => 'danger',
        'status' => 'A'
    ],
    'W' => [
        'name' => 'En attente',
        'class' => 'primary',
        'status' => 'W'
    ],
    'F' => [
        'name' => 'Finie',
        'class' => 'secondary',
        'status' => 'F'
    ],
    'C' => [
        'name' => 'Commandé',
        'class' => 'secondary',
        'status' => 'C'
    ]
];

?>

<table class="table text-center">
    <thead>
        <tr>
            <th class="text-center" scope="col">#</th>
            <th class="text-center" scope="col">Objet</th>
            <th class="text-center" scope="col">Quantité</th>
            <th class="text-center" scope="col">Demandeur</th>
            <th class="text-center" scope="col">Début</th>
            <th class="text-center" scope="col">Fin</th>
            <th class="text-center" scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
      	<?php
        foreach($reservations as $reservation) { 
            $status = $statuses[$reservation['status']];
            ?>
            <tr>
                <th scope="row"><?= $reservation['reservation_id']; ?></th>
                <td>
                <?php foreach($items as $item) {  
                    if ($reservation['item_id'] == $item['item_id']) { echo $item['name']; } } ?></td>
                <td><?= $reservation['quantity']; ?></td>
                <td><?= $reservation['email']; ?></td>
                <td><?= $reservation['start_date']; ?></td>
                <td><?= $reservation['end_date']; ?></td>
                <td>

                    <?php if ($status['status'] == 'W') { ?>
                        <a class="btn btn-success" href="modifier_reservation.php?reservation_status=V&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-circle-check"></span></a>
                        <a class="btn btn-danger" href="modifier_reservation.php?reservation_status=A&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-circle-x"></span></a>
                    <?php } ?>

                    <?php if ($status['status'] == 'V') { ?>
                        <a class="btn btn-warning" href="modifier_reservation.php?reservation_status=C&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-share"></span></a>
                    <?php } ?>

                    <?php if ($status['status'] == 'C') { ?>
                        <a class="btn btn-primary" href="modifier_reservation.php?reservation_status=F&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-clock"></span></a>
                    <?php } ?>
                    
                    <?php if ($status['status'] == 'F') { ?>
                        <a class="btn btn-secondary"><span class="oi oi-task"></span></a>
                    <?php } ?>

                    <?php if ($status['status'] == 'A') { ?>
                        <a class="btn btn-secondary"><span class="oi oi-x"></span></a>
                    <?php } ?>

                    <!-- <button type="button" class="btn btn-<?=$status['class']?>" data-toggle="modal" data-target="#modal_reservation_<?=$reservation['reservation_id']?>"><?=$status['name']?></button>
                    <div class="modal fade" id="modal_reservation_<?=$reservation['reservation_id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        <select class="selectpicker" multiple data-max-options="4" name="reservation_status">
                                            <?php foreach ($statuses as $key => $status) { ?>
                                                <option value="<?=$key?>"><?=$status['name']?></option>
                                            <?php } ?>
                                        </select>
                                        <textarea class="form-control" name= "reservation_raison" autofocus placeholder="Raison du nouveau statut" rows="4"></textarea>
                                        <input type="hidden" name="reservation_id" value="<?php echo $reservation['reservation_id']; ?>">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                        <button type="submit" class="btn btn-primary" action="modifier_reservation.php">Valider</button>  
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div> -->
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>