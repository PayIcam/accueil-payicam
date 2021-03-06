<?php
require_once 'includes/_header.php';
$Auth->allow('member');
require_once ROOT_PATH.'class/DB.php';
$title_for_layout = 'Vote PayIcam';

$user = $Auth->getUser();
$my_vote = $accueil_db->prepare('SELECT * FROM vote_has_voters WHERE email = :email');
$my_vote -> bindParam('email', $user['email'], PDO::PARAM_STR);
$my_vote -> execute();
$vote_fait = $my_vote->fetch();

$param_vote = $accueil_db->prepare('SELECT * FROM vote_option'); //Prévu pour contenir un unique vote dans la bdd d'où l'absence de condition
$param_vote -> execute();
$infos_vote = $param_vote->fetch();


$promo = $ginger_db->prepare('SELECT promo, site FROM users WHERE mail = :email');
$promo -> bindParam('email', $user['email'], PDO::PARAM_STR);
$promo->execute();
$promo_votant = $promo->fetch();

if ($vote_fait != false){
  Functions::setFlash("Bien tenté!",'danger');
  header('Location:index.php');
  die();
}
if (!in_array($promo_votant['promo'], [121, 122, 123, 124, 125, 2021, 2022, 2023, 2024, 2025, 24, 25, 26]) || $promo_votant['site'] != "Lille" ){
    die();
 Functions::setFlash("Vous n'êtes pas autorisé à voter",'warning');
 header('Location:index.php');
 die();
}

$date_actuelle=date("Y-m-d H:i:s");
if ($date_actuelle < $infos_vote['date_debut']){
  Functions::setFlash("Il n'y a pas de vote en cours",'danger');
  header('Location:index.php');
  die();
}
elseif ($date_actuelle > $infos_vote['date_fin']) {
  Functions::setFlash("Le vote est terminé",'danger');
  header('Location:index.php');
  die();
}

include 'includes/header.php';
?>

<!DOCTYPE html>
<html>
<link href="css/style_vote.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
<body>
    <div id="morph">
        <div class="sep_bouton" id="sep_bouton_choix_1">
            <img src="img/Viperactif.jpg" type="button" class='rounded-circle' id="mirage" data-toggle="modal" data-target="#mirageModal">
        </div>
        <div class="sep_bouton" id="sep_bouton_choix_2">
            <img src="img/pangolin.png" type="button" alt="choix_2" class='rounded-circle' id="pyramide" data-toggle="modal" data-target="#pyramideModal">
        </div>
    </div>

    <form action="a_voter.php" method="post">
        <div class="modal fade" id="mirageModal" tabindex="-1" role="dialog" aria-labelledby="camion_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="choix_2_label">Voter Viperactif</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ce vote est définitif, êtes-vous sûr?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </a>
                        <input type="hidden" name='vote' value="Viperactif">
                        <input type="submit" class="btn btn-light" value="Je vote Viperactif">
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form action="a_voter.php" method="post">
        <div class="modal fade" id="pyramideModal" tabindex="-1" role="dialog" aria-labelledby="muerto_label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="choix_2_label">Voter Pangolin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Ce vote est définitif, êtes-vous sûr?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                        </a>
                        <input type="hidden" name='vote' value="Pangolin">
                        <input type="submit" class="btn btn-light" value="Je vote Pangolin">
                    </div>
                </div>
            </div>
        </div>
    </form>


<?php include 'includes/footer.php';?>