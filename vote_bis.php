<?php

require_once 'includes/_header.php';
$Auth->allow('member');
require_once 'class/DB.php';
$title_for_layout = 'Vote bis';
$user = $Auth->getUser();
// $user = ['email' => 'gregoire.giraud@2020.icam.fr'];

// require_once 'class/Config.php';
// require_once 'includes/functions.php';
// require_once 'class/Auth.class.php';
// require "config.php";
// $conf_accueil = $_CONFIG['accueil_db'];
// $conf_ginger = $_CONFIG['ginger_db'];
// $accueil_db = new PDO('mysql:host='.$conf_accueil['sql_host'].';dbname='.$conf_accueil['sql_db'].';charset=utf8', $conf_accueil['sql_user'], $conf_accueil['sql_pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
// $ginger_db = new PDO('mysql:host='.$conf_ginger['sql_host'].';dbname='.$conf_ginger['sql_db'].';charset=utf8', $conf_ginger['sql_user'], $conf_ginger['sql_pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));

if(empty($_GET['vote_id'])) {
    Functions::setFlash("Cher ami, il se trouve que tu essaye de faire des carabistouilles. Arrêtes s'il te plait.", 'danger');
    header('Location:index.php');
    die();
}

$vote = $accueil_db->prepare('SELECT * FROM vote_bis WHERE id = :vote_id');
$vote->execute(['vote_id' => $_GET['vote_id']]);
$vote = $vote->fetch();

if(empty($vote)) {
    Functions::setFlash("Petit galopin, ce vote n'existe pas.", 'danger');
    header('Location:index.php');
    die();
}

$now=date("Y-m-d H:i:s");
if ($now < $vote['start_date']){
    include 'includes/header.php';
    echo "<h1>Salut les potes ! </h1> Le vote n'a pas encore démarré. Il commence à " . $vote['start_date'];
    include 'includes/footer.php';
    die();
}

function field_is_matched_or_null($field, $userField) {
    if(empty($field)) {
        return true;
    }

    return $userField == $field;
}

$userData = $ginger_db->prepare('SELECT promo, site, filiere FROM users WHERE mail = :email');
$userData->execute(['email' => $user['email']]);
$userData = $userData->fetch();

$filiere_ok = field_is_matched_or_null($vote['filiere'], $userData['filiere']);
$promo_ok = field_is_matched_or_null($vote['promo'], $userData['promo']);
$site_ok = field_is_matched_or_null($vote['site'], $userData['site']);

if(!($filiere_ok && $promo_ok && $site_ok)) {
    Functions::setFlash("Cher ami, Tu n'es pas dans le public cible. Vas t'en.", 'danger');
    header('Location:index.php');
    die();
}

if ($now > $vote['end_date']) {
    $results = $accueil_db->prepare('SELECT name, COUNT(*) FROM vote_bis_votes vbv INNER JOIN vote_bis_candidates vbc ON vbc.id = vbv.candidate_id WHERE vbv.vote_id = :vote_id GROUP BY vbv.candidate_id ORDER BY COUNT(*) desc');
    $results->execute(['vote_id' => $_GET['vote_id']]);
    $results = $results->fetchAll();

    include 'includes/header.php'; ?>
    <h1> Vote - <?= $vote['name'] ?> </h1>
    <table class="table">
        <thead>
            <tr>
                <th>Classement</th>
                <th>Candidat</th>
                <th>Nombre de voix</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($results as $key => $candidate_data) { ?>
                <tr>
                    <th><?= $key +1 ?></th>
                    <th><?= $candidate_data['name'] ?></th>
                    <td><?= $candidate_data['COUNT(*)'] ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php include 'includes/footer.php'; die();
}

$self_votes = $accueil_db->prepare('SELECT COUNT(*) FROM vote_bis_votes WHERE vote_id = :vote_id and email=:email');
$self_votes->execute(['vote_id' => $_GET['vote_id'], 'email' => $user['email']]);
$self_votes = $self_votes->fetch()['COUNT(*)'];
$votes_restants = $vote['votes_allowed'] - $self_votes;

if($votes_restants > 0) {
    $candidates = $accueil_db->prepare('SELECT * FROM vote_bis_candidates WHERE vote_id = :vote_id');
    $candidates->execute(['vote_id' => $_GET['vote_id']]);
    $candidates = $candidates->fetchAll();

    include 'includes/header.php'; ?>
    <h1> Vote - <?= $vote['name'] ?> <h1>
    <h2> Résultats du vote à <?=$vote['end_date']?> ici même !</h2>
    <p> Il vous reste <?=$votes_restants?> votes.</p>
    <table class="table">
        <thead>
            <tr>
                <th>Candidat</th>
                <th>Vote</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($candidates as $candidate) { ?>
                <tr>
                    <th><?= $candidate['name'] ?></th>
                    <td><a class="button" href="vote_bis_vote.php?vote_id=<?=$_GET['vote_id']?>&candidate_id=<?=$candidate['id']?>">Voter</a></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <?php include 'includes/footer.php'; die();
}

include 'includes/header.php'; ?>
<h1> Vote - <?= $vote['name'] ?> <h1>
<h2> Résultats du vote à <?=$vote['end_date']?> ici même !</h2>
<p> Vous avez déjà utilisé tous vos votes</p>
<?php include 'includes/footer.php';