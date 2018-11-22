<?php
require_once 'includes/_header.php';
$Auth->allow('member');
require_once ROOT_PATH.'class/DB.php';
$title_for_layout = 'Vote PayIcam';
include 'includes/header.php';
$confSQL = $_CONFIG['conf_accueil'];
$conf_sql_promo = $_CONFIG['conf_sql_promo'];

try{
  $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
  die('erreur:'.$e->getMessage());
}
try
{
  $DB_promo = new PDO('mysql:host='.$conf_sql_promo['sql_host'].';dbname='.$conf_sql_promo['sql_db'].';charset=utf8',$conf_sql_promo['sql_user'],$conf_sql_promo['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
  die('erreur:'.$e->getMessage());
}


$user = $Auth->getUser();
$my_vote = $DB->prepare('SELECT * FROM vote_has_voters WHERE email = :email');
$my_vote -> bindParam('email', $user['email'], PDO::PARAM_STR);
$my_vote -> execute();
$vote_fait = $my_vote->fetch();

$param_vote = $DB->prepare('SELECT * FROM vote_option'); //Prévu pour contenir un unique vote dans la bdd d'où l'absence de condition
$param_vote -> execute();
$infos_vote = $param_vote->fetch();


$promo = $DB_promo->prepare('SELECT promo FROM users WHERE mail = :email');
$promo -> bindParam('email', $user['email'], PDO::PARAM_STR);
$promo->execute();
$promo_votant = $promo->fetch();


if ($vote_fait != false){
  Functions::setFlash("Bien tenté!",'danger');
  header('Location:index.php');
}
if (!in_array($promo_votant['promo'], [24, 123, 122, 121, 120, 119, 2023, 2022, 2021, 2020, 2019]) ){
  Functions::setFlash("Vous n'êtes pas autorisé à voter",'warning');
  header('Location:index.php');
}

$date_actuelle=date("Y-m-d H:i:s");
if ($date_actuelle < $infos_vote['date_debut']){
  Functions::setFlash("Il n'y a pas de vote en cours",'danger');
  header('Location:index.php');
}
elseif ($date_actuelle > $infos_vote['date_fin']) {
  Functions::setFlash("Le vote est terminé",'danger');
  header('Location:index.php');
}

?>

<!DOCTYPE html>
<html>
<link href="css/style_vote.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<body>
  <div id="morph">
    <div class="sep_bouton" id="sep_bouton_choix_2">
      <img src="img/choix2.png" type="button" id="choix_2" class='rounded-circle' alt="choix_2" data-toggle="modal" data-target="#choix_2Modal">
    </div>
    <div class="sep_bouton" id="sep_bouton_choix_1">
      <img src="img/choix1.png" type="button" alt="choix_1" class='rounded-circle' id="choix_1" data-toggle="modal" data-target="#choix_1Modal">
    </div>
    <!-- <div class="sep_bouton" id="sep_bouton_choix_3">
      <img src="img/choix1.png" type="button" alt="choix_3" class='rounded-circle' id="choix_3">
    </div> -->
    <div id="sep_bouton_bas">
        <!-- <img src="img/choix.png" type="button" alt="choix_1" class='rounded-circle' id="choix_1" data-toggle="modal" data-target="#blancModal"> -->
      <input type="button" class="btn btn-secondary btn-lg" value="Je vote blanc" data-toggle="modal" data-target="#blancModal"></input>
    </div>
  </div>
    <div id="sep_bouton_bas">
        <a href="vote.php">
            <img src="img/choix3.png" type="button" alt="choix_3" class='rounded-circle' id="choix_3">
        </a>
      <!-- <input type="button" class="btn btn-secondary btn-lg" value="Je vote blanc" data-toggle="modal" data-target="#blancModal"></input> -->
    </div>
  <form action="a_voter.php" method="post">
    <div class="modal fade" id="choix_2Modal" tabindex="-1" role="dialog" aria-labelledby="choix_2_label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="choix_2_label">Vote <?php echo $infos_vote['nom_vote'] ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ce vote est définitif, êtes-vous sûr?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <input type="hidden" name='vote' value="<?php echo ($infos_vote['choix_2']) ?>">
            <input type="submit" class="btn btn-light" value="<?php echo("Je vote ".$infos_vote['choix_2']) ?>" >
          </div>
        </div>
      </div>
    </div>
  </form>
  <form action="a_voter.php" method="post">
    <div class="modal fade" id="choix_1Modal" tabindex="-1" role="dialog" aria-labelledby="choix_1_label" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="choix_1_label">Vote <?php echo $infos_vote['nom_vote'] ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ce vote est définitif, êtes-vous sûr?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <input type="hidden" name='vote' value="<?php echo ($infos_vote['choix_1']) ?>">
            <input type="submit" class="btn btn-warning" value="<?php echo("Je vote ".$infos_vote['choix_1']) ?>" >
          </div>
        </div>
      </div>
    </div>
  </form>
<form action="a_voter.php" method="post">
  <div class="modal fade" id="blancModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="blanc_label">Vote <?php echo $infos_vote['nom_vote'] ?></h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <p>Ce vote est définitif, êtes-vous sûr?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
            <input type="hidden" name='vote' value="blanc">
            <input type="submit" class="btn btn-light" value="Je vote blanc">
          </div>
        </div>
    </div>
  </div>
</form>
</body>
<?php include 'includes/footer.php';?>
