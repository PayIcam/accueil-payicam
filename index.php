<?php
  require_once 'includes/_header.php';
    $Auth->allow('member');

  require_once ROOT_PATH.'class/DB.php';
  $confSQL = $_CONFIG['conf_sql_vote'];


  $title_for_layout = 'Accueil';
  include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation

$date_debut=strtotime("23-11-2017 07:00");
$date_fin=strtotime("23-11-2017 15:00");
$date_actuelle=strtotime("now");

try{
  $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
  } catch(Exeption $e) {
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

$user = $Auth->getUser();

	// $vote = $DB->query('SELECT * FROM vote WHERE slug = "elections-bde-2017"');
	$my_vote = $DB->prepare('SELECT * FROM vote_has_voters WHERE email = :email');
	$my_vote -> bindParam('email', $user['email'], PDO::PARAM_STR);
	$my_vote -> execute();
	$vote_fait = $my_vote->fetch();

  $promo = $DB_promo->prepare('SELECT promo FROM users WHERE mail = :email');
  $promo -> bindParam('email', $user['email'], PDO::PARAM_STR);
  $promo->execute();
  $promo_votant = $promo->fetch();
?>

<!-- <div class="jumbotron">
  <h2>Bienvenue sur PayIcam !</h2>
  <p>&rarr; Pour tout projet, bug, remarque, mot d'amour <br> &rarr; <a href="mailto:contact.payicam@gmail.com">contact.payicam@gmail.com</a> <br> &rarr; Bisous &hearts;</p>
</div> -->
<?php 
if ($promo_votant['promo'] == 119){ ?>
  <div class="jumbotron">
  <h2>Bienvenue sur PayIcam !</h2>
  <p>&rarr; Pour tout projet, bug, remarque, mot d'amour <br> &rarr; <a href="mailto:contact.payicam@gmail.com">contact.payicam@gmail.com</a> <br> &rarr; Bisous &hearts;</p>
</div>
<?php }
else { ?>
<div class="col-md-12">
  <img src="img/annonce_vote.png" alt="image d'annonce du vote" style="width: 100%">
  <?php 

  if ($vote_fait != false){ ?>
		<a class="btn btn-warning" href="#" type='button' disabled style="width: 100%"><h4><strong>Vous avez déjà voté. Rendez-vous ce soir pour le résultat!</strong></h4></a>
	<?php } else{
	  if ($date_debut > $date_actuelle){ ?>
	  		<a class="btn btn-warning" href="#" type='button' disabled style="width: 100%"><h4><strong>Ouverture du vote demain à 7h!</strong></h4></a>
	  	<?php 
	  } 
	  elseif ($date_fin < $date_actuelle){ ?>
	  	<a class="btn btn-warning" href="#" type='button' disabled style="width: 100%"><h4><strong>Vote terminé. Rendez-vous ce soir pour le résultat!</strong></h4></a>
	  <?php }
	  else{ ?>
	  <a class="btn btn-warning" href="vote.php" type='button' style="width: 100%"><h4><strong>Vote ici pour ton BDE! (Fermeture du vote à 15h)</strong></h4></a>
	  <?php } 
	}?>
</div>
<?php } ?>
<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-8">
        <h3>Rechargement</h3>
        <p>Le rechargement se fait via Casper, l'interface web pour la gestion de son compte personnel </p>
        <p><a class="btn btn-primary" href="../casper" target="_blank" role="button">Casper &raquo;</a></p>
      </div>
      <div class="col-sm-4"><img class="img-responsive" style="margin-top: 30px;max-height: 150px;" src="img/gold_card.png"/></p></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-8">
        <h3>Billeterie</h3>
        <p>La billeterie de l'Icam, si vous souhaitez acheter des places ou des goodies, shotgun est l'interface de vente en ligne!</p>
        <p><a class="btn btn-primary" href="../shotgun" target="_blank" role="button">Shotgun &raquo;</a></p>
      </div>
      <div class="col-sm-4"><img class="img-responsive" style="margin-top: 30px;max-height: 150px;" src="img/tickets.png"/></p></p></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-8">
        <h3>Gala Icam</h3>
        <p>Rendez-vous le 7 décembre pour l'annonce du thème!</p>
      </div>
      <div class="col-sm-4"><img class="img-responsive" style="margin-top: 30px;max-height: 150px;" src="img/gala.jpg"/></p></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-8">
        <h3>Spring Festival</h3>
        <p>Vous pouvez désormais réserver en ligne grâce à PayIcam votre place pour le Spring !<br> Vous pouvez aussi juste voir le statut de votre réservation déjà effectuée.</p>
        <p><a class="btn btn-info" href="../register_spring_festival" role="button" disabled>Inscriptions au Spring Festival 2017 &raquo;</a></p>
      </div>
      <div class="col-sm-4"><img class="img-responsive" style="margin-top: 30px;max-height: 150px;" src="img/spring.jpg"/></p></div>
    </div>
  </div>
</div><!--/row-->


<?php if ($Auth->hasRole('admin')): ?>
  <h2 class="page-header">Liens vers l'Administration</h2>
  <div class="row">
    <div class="col-md-4">
      <h3>Admin PayIcam</h3>
      <p>Application web permettant entre autre la gestion des articles, la gestion des droits, la trésorerie, ...</p>
      <p><a class="btn btn-primary" href="../scoobydoo" target="_blank" role="button">Scoobydoo &raquo;</a>
    </div>
    <?php if ($Auth->hasRole('super-admin')): ?>
    <div class="col-md-4">
      <h3>Gestion des données des élèves</h3>
      <p>Cette interface permet la gestion par exemple de l'affectation des identifiants cartes étudiantes aux élèves.</p>
      <p><a class="btn btn-primary" href="../admin_ginger" target="_blank" role="button">Admin Ginger &raquo;</a>
    </div>
    <?php endif ?>
    <div class="col-md-4">
      <h3>Vente par caisse physique</h3>
      <p>Application web de ventre des articles comme au Bar ou la cafet avec une caisse et une badgeuse.</p>
      <p><a class="btn btn-primary" href="../mozart" target="_blank" role="button">Mozart &raquo;</a>
    </div>
    <div class="col-md-4">
      <h3>Admin ventes en ligne</h3>
      <p>Administration des ventes d'articles en ligne, celle de shotgun.</p>
      <p><a class="btn btn-primary" href="../shotgun/admin" target="_blank" role="button">Shotgun &raquo;</a>
    </div>
  </div>
<?php endif ?>

<?php include 'includes/footer.php';?>