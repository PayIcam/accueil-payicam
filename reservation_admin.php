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
                        <a class="btn btn-success" title="Valider la réservation" href="modifier_reservation.php?reservation_status=V&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-circle-check"></span></a>
                        <a class="btn btn-danger" title="Refuser la réservation" href="modifier_reservation.php?reservation_status=A&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-circle-x"></span></a>
                    <?php } ?>

                    <?php if ($status['status'] == 'V') { ?>
                        <a class="btn" title="Valider la réservation" href="modifier_reservation.php?reservation_status=W&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-circle-check" title="Réservation validée, cliquez pour annuler"></span></a>
                        <a class="btn btn-warning" title="Valider la récupération des objets" href="modifier_reservation.php?reservation_status=C&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-share"></span></a>
                    <?php } ?>

                    <?php if ($status['status'] == 'C') { ?>
                        <a class="btn" title="Les objets ont été récupéré, cliquez pour annuler" href="modifier_reservation.php?reservation_status=V&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-share"></span></a>
                        <a class="btn btn-primary" title="En cours, cliquez à la réception des objets" href="modifier_reservation.php?reservation_status=F&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-clock"></span></a>
                    <?php } ?>
                    
                    <?php if ($status['status'] == 'F') { ?>
                        <a class="btn btn-secondary" title="Les objets ont été rendu, cliquez pour annuler" href="modifier_reservation.php?reservation_status=C&amp;reservation_id=<?= $reservation['reservation_id']; ?>"><span class="oi oi-task"></span></a>
                    <?php } ?>

                    <?php if ($status['status'] == 'A') { ?>
                        <a class="btn btn-secondary" title="Réservation refusée, cliquez pour annuler" href="modifier_reservation.php?reservation_status=W&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-x"></span></a>
                    <?php } ?>

                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>