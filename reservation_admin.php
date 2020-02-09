<?php

require_once 'includes/_header.php';

$Auth->allow('member');
$user = $Auth->getUser();
require_once ROOT_PATH.'class/DB.php';
include('config.php');
$title_for_layout = 'Accueil';
$js_for_layout = array('bootstrap.min.js', 'indice_gala');

include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation

if($Auth->hasRole('super-admin')) {
    $requete_reservations = $accueil_db->query("SELECT * FROM reservation");
} else {
    $requete_reservations = $accueil_db->prepare("SELECT * FROM reservation WHERE item_id IN (SELECT item_id FROM item WHERE email LIKE :email)");
    $requete_reservations->execute(['email' => '%'.$Auth->getUser()['email'].'%']);
}

$reservations = $requete_reservations->fetchAll();
$requete_items = $accueil_db->query("SELECT * FROM item");
$items = $requete_items->fetchAll();

$statuses = [
    'V' => [
        'name' => 'Validée',
        'class' => 'success',
        'status' => 'V',
        'icon' => 'thumb-up',
        'next' => 'C',
        'previous' => 'W'
    ],
    'A' => [
        'name' => 'Refusée',
        'class' => 'danger',
        'status' => 'A',
        'icon' => 'thumb-down',
        'next' => 'V',
        'previous' => null
    ],
    'W' => [
        'name' => 'En attente',
        'class' => 'info',
        'status' => 'W',
        'icon' => 'question-mark',
        'next' => 'V',
        'previous' => 'A'
    ],
    'F' => [
        'name' => 'Finie',
        'class' => 'success',
        'status' => 'F',
        'icon' => 'task',
        'next' => null,
        'previous' => 'C'
    ],
    'C' => [
        'name' => 'Commandée',
        'class' => 'primary',
        'status' => 'C',
        'icon' => 'data-transfer-download',
        'next' => 'V',
        'previous' => 'F'
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
            <th class="text-center" scope="col">Status</th>
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
                <td><?= $reservation['quantity']; ?> / <?= $item['quantity']; ?></td>
                <td><?= $reservation['email']; ?></td>
                <td><?= date('d/m/Y', strtotime($reservation['start_date'])); ?></td>
                <td><?= date('d/m/Y', strtotime($reservation['end_date'])); ?></td>
                <td>
                    <span class="badge badge-pill badge-<?=$status['class']?> oi oi-<?=$status['icon']?>"> </span>
                </td>
                <td>
                    <?php if(!empty($status['next'])) {
                        $next_status = $statuses[$status['next']]; ?>
                        <a class="btn btn-<?=$next_status['class']?>" title="<?=$next_status['name']?>" href="modifier_reservation.php?reservation_status=<?=$next_status['status']?>&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-<?=$next_status['icon']?>"></span></a>
                    <?php }
                    if(!empty($status['previous'])) {
                        $previous_status = $statuses[$status['previous']]; ?>
                        <a class="btn btn-<?=$previous_status['class']?>" title="<?=$previous_status['name']?>" href="modifier_reservation.php?reservation_status=<?=$previous_status['status']?>&amp;reservation_id=<?= $reservation['reservation_id']; ?>" role="button"><span class="oi oi-<?=$previous_status['icon']?>"></span></a>
                    <?php } ?>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include 'includes/footer.php'; ?>