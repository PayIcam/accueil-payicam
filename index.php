<?php
require 'includes/_header.php';

$Auth->allow('member');
$user = $Auth->getUser();

$title_for_layout = 'Accueil';
$js_for_layout = array('bootstrap.min.js', 'indice_gala');

$confSQL = $_CONFIG['conf_accueil'];
$conf_ginger = $_CONFIG['conf_ginger'];

try {
	$DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
	$db_ginger = new PDO('mysql:host='.$conf_ginger['sql_host'].';dbname='.$conf_ginger['sql_db'].';charset=utf8',$conf_ginger['sql_user'],$conf_ginger['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
	die('erreur:'.$e->getMessage());
}

$promo_site = $db_ginger->prepare('SELECT promo, site FROM users WHERE mail = :email');
$promo_site -> bindParam('email', $user['email'], PDO::PARAM_STR);
$promo_site->execute();
$promo_site = $promo_site->fetch();
$promo = $promo_site['promo'];
$site = $promo_site['site'];

if ($site == 'Toulouse') {
	header('Location:../accueil-toulouse');
    die();
}

$requete_slides = $DB->prepare("SELECT * FROM payicam_accueil_slide");
$requete_slides->execute();
$slides = $requete_slides->fetchAll();

$requete_cartes = $DB->prepare("SELECT * FROM payicam_carte");
$requete_cartes->execute();
$cartes = $requete_cartes->fetchAll();
  
$param_vote = $DB->prepare('SELECT * FROM vote_option');
$param_vote -> execute();
$infos_vote = $param_vote->fetch();

$my_vote = $DB->prepare('SELECT * FROM vote_has_voters WHERE email = :email');
$my_vote -> bindParam('email', $user['email'], PDO::PARAM_STR);
$my_vote -> execute();
$vote_fait = $my_vote->fetch();
   
$date_actuelle = date("Y-m-d H:i:s");
$date_begin= strtotime($infos_vote['date_debut']);
$date_end= strtotime($infos_vote['date_fin']);
$jour_avant= date("Y-m-d H:i:s", strtotime("-1 days", $date_begin));//Bouton vote apparait 1 jour avant
$jour_apres= date("Y-m-d H:i:s", strtotime("+12 hours", $date_end));// disparait 12 heures après
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');



include 'includes/header.php'; ?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<!-- CAROUSEL-->
<div id="carouselExampleIndicators" style="padding-top: 0px ; margin-bottom: 20px; border-radius: 4px;" class="carousel slide" data-ride="carousel">

	<ol class="carousel-indicators">
	<?php foreach ($slides as $slide) { ?>
			<li data-target="#carouselExampleIndicators" data-slide-to="<?= $slide["slide_id"] ?>" class="active"></li>
	<?php } ?>
	</ol>
				
	<div class="carousel-inner">
	<?php $i=0; foreach ($slides as $key => $slide) { ?>
		<div class="carousel-item <?= $i == 0 ? "active" : "" ?>">
			<img class="d-block w-100" src="<?= $slide["slide_image"]?>"  alt="Card image cap">
			<div class="carousel-caption d-none d-md-block"> </div>
		</div>
		<?php $i++; } ?>
	</div>

	<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
		<span class="carousel-control-prev-icon" aria-hidden="true"></span>
		<span class="sr-only">Previous</span>
	</a>
	<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
		<span class="carousel-control-next-icon" aria-hidden="true"></span>
		<span class="sr-only">Next</span>
	</a>

</div>		
<!-- /CAROUSEL-->

<!-- <div class="jumbotron jumbotron-fluid">
  <div class="container">
    <h1 class="display-4">Bienvenue sur PayIcam</h1>
    <p class="lead">Pour toute remarque, bug ou mot d'amour, ça se passe ici: <a href="mailto:contact.payicam@gmail.com">contact.payicam@gmail.com</a></p>
  </div>
</div> -->
<!-- <div class="clock" id='decompte'></div> -->

<div class="container">

<!-- MODAL horaires du barIcam -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="exampleModalLabel">Horaires du BarIcam</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-auto">
						<img src="img/logobaricam.png" style="height: 160px; width: auto; padding: 10px" alt="bar logo">
					</div>
					<div class="col-md-auto" style="padding-top: 15px">
						<strong>Lundi :</strong> 21h30 - 23h <br>
						<strong>Mardi (sans alcools) :</strong> 17h30 - 19h <br>
						<strong>Mercredi :</strong> 22h00 - 23h30 <br>
						<strong>Jeudi :</strong> 18h00 - 20h30 <br>
						<strong>Vendredi :</strong> 21h30 - 23h
					</div>
				</div>
			</div>
		</div>
	</div>
</div>	<!-- /MODAL horaires du barIcam -->



	<?php  	//DEBUT VOTE
	if (($date_actuelle > $jour_avant) && ($date_actuelle < $jour_apres) && in_array($promo['promo'], [24, 123, 122, 121, 120, 119, 2023, 2022, 2021, 2020, 2019]) && $promo['site'] == 'Lille'){ // verifie intervalle de temps + PROMO A METTRE A JOUR TOUS LES ANS J'AI LA FLEMME DE FAIRE UN TRUC AUTOMATIQUE

		if ($vote_fait != false){ // si déjà voté bloque le bouton?>
			<a class="btn btn-warning btn-lg btn-block" href="#" type='button' style="margin-bottom: 10px" disabled>Vous avez déjà voté. Rendez-vous ce soir pour le résultat!</a>
		<?php } else{
				if ($infos_vote['date_debut'] > $date_actuelle){ // verifie qu'on est pas en avance?>
				<a class="btn btn-warning btn-lg btn-block" href="#" type='button' style="margin-bottom: 10px" disabled>Ouverture du vote <?php echo strftime("%A", strtotime($infos_vote['date_debut'])) ?> à <?php echo date("G", strtotime($infos_vote['date_debut'])) ?>h!</a>
				<?php
				}
				elseif ($infos_vote['date_fin'] < $date_actuelle){ // verifie qu'on est pas a la bourre?>
				<a class="btn btn-warning btn-lg btn-block" href="#" type='button' style="margin-bottom: 10px" disabled>Vote terminé. Rendez-vous ce soir pour le résultat!</a>
				<?php }
		else{ //cas ou c'est bon?>
		<a class="btn btn-warning btn-lg btn-block" href="vote.php" type='button' style="margin-bottom: 10px" >Votez ici pour votre <?php echo $infos_vote['nom_vote'] ?>! (Fermeture du vote à <?php echo date("G", strtotime($infos_vote['date_fin'])) ?>h)</a>
		<?php }
		}
	} ?> <!-- FIN VOTE -->

<div class="card-deck"> <!-- CARD-DECK-->

	<div class="row" > <!-- Ligne de 4 cartes publiques -->

		<?php foreach($cartes as $carte) { ?>
		<?php if(empty($data_carte1['sites']) || in_array($promo['site'], $data_carte1['sites'])) : ?>
		<div class="card border-dark" style="margin-bottom: 10px" >
			<img class="card-img-top" style="max-height: 150px;"  src="<?php echo $carte['carte_photo'] ; ?>" alt="image carte" style="max-height: 150px;">
			<div class="card-body">
				<h4 class="card-title"><?php echo $carte['carte_titre']?></h4>
				<p class="card-text"><?php echo $carte['carte_description']?></p>
			</div>

			<div class="text-center card-footer bg-transparent"><a class="btn btn-primary" href="<?= $carte['carte_lien'] ?>" target="_blank" role="button" ><?= $carte['carte_bouton'] ?></a></div>
		</div>
        <?php endif; ?>
        <?php } ?>
	<!-- /Ligne de 4 cartes publiques  -->

	<!--auth admin -->
	<?php if ($Auth->hasRole('admin')): ?>
		<div class="container " style="background-color: #d9d9d9; margin-top: 10px; margin-bottom: 10px">
			<center><h2 class="page-header">Liens vers l'Administration</h2></center>
		</div >

		<div class="row">	<!-- Ligne de 4 cartes admin  -->

			<div class="card border-dark" style="margin-bottom: 10px">
				<div class="card-body">
					<h4 class="card-title">Admin PayIcam</h4>
					<p class="card-text">Application web permettant entre autre la gestion des articles, la gestion des droits, la trésorerie, ...</p>
				</div>
				<div class="card-footer bg-transparent">
					<center><a class="btn btn-primary" href="../scoobydoo" target="_blank" role="button">Scoobydoo &raquo;</a></center>
				</div>
			</div>

			<!-- auth super admin -->
			<?php if ($Auth->hasRole('super-admin')): ?>

				<div class="card border-dark" style="margin-bottom: 10px">
					<div class="card-body">
						<h4 class="card-title">Gestion des données des élèves</h4>
						<p class="card-text">Cette interface permet la gestion par exemple de l'affectation des identifiants cartes étudiantes aux élèves.</p>
					</div>
					<div class="card-footer bg-transparent">
						<center><a class="btn btn-primary" href="../admin_ginger" target="_blank" role="button">Admin Ginger &raquo;</a></center>
					</div>
				</div>
			<?php endif ?>
			<!-- fin auth super admin -->

			<div class="card border-dark" style="margin-bottom: 10px">
				<div class="card-body">
					<h4 class="card-title">Vente par caisse physique</h4>
					<p class="card-text">Application web de ventre des articles comme au Bar ou la cafet avec une caisse et une badgeuse.</p>
				</div>
				<div class="card-footer bg-transparent">
					<center><a class="btn btn-primary" href="../mozart" target="_blank" role="button">Mozart &raquo;</a></center>
				</div>
			</div>

			<div class="card border-dark" style="margin-bottom: 10px">
				<div class="card-body">
					<h4 class="card-title">Admin ventes en ligne</h4>
					<p class="card-text">Administration des ventes d'articles en ligne, celle de shotgun.</p>
				</div>
				<div class="card-footer bg-transparent">
					<center><a class="btn btn-primary" href="../shotgun/admin" target="_blank" role="button">Shotgun &raquo;</a></center>
				</div>
			</div>

		</div>  	<!-- /Ligne de 4 cartes admin  -->
	<?php endif ?>
		<!-- fin Auth admin -->


</div>  <!-- /CARD-DECK -->

<?php include 'includes/footer.php'; ?>