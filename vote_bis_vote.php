<?php

require_once 'includes/_header.php';
$Auth->allow('member');
require_once 'class/DB.php';
$user = $Auth->getUser();

// require_once 'class/Config.php';
// require_once 'includes/functions.php';
// require_once 'class/Auth.class.php';
// require "config.php";
// require_once 'class/DB.php';
// $conf_accueil = $_CONFIG['accueil_db'];
// $conf_ginger = $_CONFIG['ginger_db'];
// $accueil_db = new PDO('mysql:host='.$conf_accueil['sql_host'].';dbname='.$conf_accueil['sql_db'].';charset=utf8', $conf_accueil['sql_user'], $conf_accueil['sql_pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
// $ginger_db = new PDO('mysql:host='.$conf_ginger['sql_host'].';dbname='.$conf_ginger['sql_db'].';charset=utf8', $conf_ginger['sql_user'], $conf_ginger['sql_pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));

if(empty($_GET['vote_id']) || empty($_GET['candidate_id'])) {
    Functions::setFlash("Cher ami, il se trouve que tu essaye de faire des carabistouilles. Arrêtes s'il te plait.", 'danger');
    header('Location:index.php');
    die();
}

$vote = $accueil_db->prepare('SELECT * FROM vote_bis WHERE id = :vote_id');
$vote->execute(['vote_id' => $_GET['vote_id']]);
$vote = $vote->fetch();

if(empty($vote)) {
    Functions::setFlash("Petit galopin, ce vote n'existe pas.", 'danger');
    header('Location: index.php');
    die();
}

$now=date("Y-m-d H:i:s");
if ($now < $vote['start_date']) {
    Functions::setFlash("Le vote n'a pas démarré. Qu'est ce que tu fabriques?", 'danger');
    header("Location: vote_bis.php?vote_id=" . $_GET['vote_id']);
    die();
} elseif($now > $vote['end_date']) {
    Functions::setFlash("Le vote est terminé. RIP.", 'danger');
    header("Location: vote_bis.php?vote_id=" . $_GET['vote_id']);
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

$self_votes = $accueil_db->prepare('SELECT COUNT(*) FROM vote_bis_votes WHERE vote_id = :vote_id and email=:email');
$self_votes->execute(['vote_id' => $_GET['vote_id'], 'email' => $user['email']]);
$self_votes = $self_votes->fetch()['COUNT(*)'];
$votes_restants = $vote['votes_allowed'] - $self_votes;

if($votes_restants <= 0) {
    Functions::setFlash("Tu as déjà utilisé tous tes votes !", 'danger');
    header("Location: vote_bis.php?vote_id=" . $_GET['vote_id']);
    die();
}

$candidate_exists = $accueil_db->prepare('SELECT COUNT(*) FROM vote_bis_candidates WHERE id = :candidate_id and vote_id = :vote_id');
$candidate_exists->execute(['vote_id' => $_GET['vote_id'], 'candidate_id' => $_GET['candidate_id']]);
$candidate_exists = $candidate_exists->fetch()['COUNT(*)'] == 1;

if(!$candidate_exists) {
    Functions::setFlash("Tu me fais tellement perdre mon temps.", 'danger');
    header('Location:index.php');
    die();
}

$insert = $accueil_db->prepare('INSERT INTO vote_bis_votes(vote_id, candidate_id, email) VALUES (:vote_id, :candidate_id, :email)');
$insert->execute(['vote_id' => $_GET['vote_id'], 'candidate_id' => $_GET['candidate_id'], 'email' => $user['email']]);

Functions::setFlash("Vote fait !", 'danger');
header("Location: vote_bis.php?vote_id=" . $_GET['vote_id']);
die();