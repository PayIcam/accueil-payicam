<?php
require_once 'includes/_header.php';
$Auth->allow('member');
$user = $Auth->getUser();

require_once ROOT_PATH.'class/DB.php';
$confSQL = $_CONFIG['conf_accueil'];
$conf_sql_promo = $_CONFIG['conf_sql_promo'];

try
{
  $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
  die('erreur:'.$e->getMessage());
}
$conf_sql_promo = $_CONFIG['conf_sql_promo'];

try
{
  $DB_promo = new PDO('mysql:host='.$conf_sql_promo['sql_host'].';dbname='.$conf_sql_promo['sql_db'].';charset=utf8',$conf_sql_promo['sql_user'],$conf_sql_promo['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
  die('erreur:'.$e->getMessage());
}


$my_vote = $DB->prepare('SELECT * FROM vote_has_voters WHERE email = :email');
$my_vote -> bindParam('email', $user['email'], PDO::PARAM_STR);
$my_vote->execute();
$vote_fait = $my_vote->fetch();

$param_vote = $DB->prepare('SELECT * FROM vote_option'); //Prévu pour contenir un unique vote dans la bdd d'où l'absence de condition
$param_vote -> execute();
$infos_vote = $param_vote->fetch();

$promo = $DB_promo->prepare('SELECT promo FROM users WHERE mail = :email');
$promo -> bindParam('email', $user['email'], PDO::PARAM_STR);
$promo->execute();
$promo_votant = $promo->fetch();



$date_actuelle=date("Y-m-d H:i:s");
if ($date_actuelle < $infos_vote['$date_debut']){
  Functions::setFlash("Il n'y a pas de vote en cours",'danger');
  header('Location:index.php');
}
elseif ($date_actuelle > $infos_vote['$date_fin']) {
  Functions::setFlash("Le vote est terminé",'danger');
  header('Location:index.php');
}
else{

  if ($vote_fait != false){
    Functions::setFlash("Bien tenté!",'danger');
    header('Location:index.php');
  }
  elseif ($promo_votant['promo'] == 0){ 
    Functions::setFlash("Vous n'êtes pas autorisé à voter",'warning');
    header('Location:index.php');
  }
  else{

    $enreg= $DB->prepare('INSERT INTO vote_has_voters (email, promo, choice) values (:email, :promo, :choice)');

    $date_vote=date('Y-m-d H:i:s');
    $enreg -> bindParam('email', $user['email'], PDO::PARAM_STR);
    $enreg -> bindParam('promo', $promo_votant['promo'], PDO::PARAM_INT);
    $enreg -> bindParam('choice', $_POST['vote'], PDO::PARAM_STR);
    try {
      $enreg -> execute();
      Functions::setFlash("Votre vote a bien été enregistré ",'info');
      header('Location:index.php');
    } catch (Exception $e) {
      Functions::setFlash("Votre vote n'a pas été enregistré, si le problème persiste, contactez Payicam",'danger');
      header('Location:index.php');
    }
  }
}

  ?>