<?php
require_once 'includes/_header.php';

$Auth->allow('member');
$user = $Auth->getUser();
require_once ROOT_PATH.'class/DB.php';
include('config.php');   
$title_for_layout = 'Accueil';
include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
$confSQL = $_CONFIG['conf_accueil'];

  try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
    }

    for ($i = 1; $i<4; $i++){
      $requete_slides = $DB->prepare("SELECT slide_image, slide_message FROM payicam_accueil_slide WHERE slide_id='$i'");
      $requete_slides -> execute();
      ${'data_slide'.$i} = $requete_slides->fetch();
    }

    for ($i = 1; $i<5; $i++){
      $requete_cartes = $DB->prepare("SELECT carte_titre, carte_description, carte_activation_bouton,
      	carte_bouton,carte_photo FROM payicam_carte WHERE carte_id='$i'");
      $requete_cartes -> execute();
      ${'data_carte'.$i} = $requete_cartes->fetch();
    }



 //DEBUT BDD VOTE

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
   $my_vote -> execute();
   $vote_fait = $my_vote->fetch();

   $param_vote = $DB->prepare('SELECT * FROM vote_option');
   $param_vote -> execute();
   $infos_vote = $param_vote->fetch();

   $promo = $DB_promo->prepare('SELECT promo, site FROM users WHERE mail = :email');
   $promo -> bindParam('email', $user['email'], PDO::PARAM_STR);
   $promo->execute();
   $promo_votant = $promo->fetch();
//On tej les toulousain
if ($promo_votant['site'] == 'Toulouse'){
	header('Location:../accueil-toulouse');
}
//FIN BDD VOTE

   //date pour vote
   $date_actuelle = date("Y-m-d H:i:s");
   $date_begin= strtotime($infos_vote['date_debut']);
   $date_end= strtotime($infos_vote['date_fin']);
  $jour_avant= date("Y-m-d H:i:s", strtotime("-1 days", $date_begin)); //Bouton vote apparait 1 jour avant
  $jour_apres= date("Y-m-d H:i:s", strtotime("+12 hours", $date_end));  // disparait 12 heures après
  date_default_timezone_set('Europe/Paris');
  setlocale(LC_TIME, 'fr_FR.utf8','fra'); //pour afficher le jour du vote en français
  //fin date 

  ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
  		
<!-- CAROUSEL-->
<!-- <div id="carouselExampleIndicators" style="padding-top: 0px ; margin-bottom: 20px; border-radius: 4px;" class="carousel slide" data-ride="carousel">
  			<ol class="carousel-indicators">
  				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
  				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
  				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>

  			</ol>

  			<div class="carousel-inner">
  				<div class="carousel-item active">
  					<img class="d-block w-100" src="img/<?php echo $data_slide1[0] ; ?>"  alt="First slide">
  					<div class="carousel-caption d-none d-md-block">
					</div>
  				</div>
  				
  				<div class="carousel-item">
  					<img class="d-block w-100" src="img/<?php echo $data_slide2[0] ; ?>" alt="Second slide">
  					<div class="carousel-caption d-none d-md-block">
            		</div>
  				</div>

  				<div class="carousel-item" >
  					<img class="d-block w-100" id="slide3" src="img/<?php echo $data_slide3[0] ; ?>" alt="Third slide">
  					<div class="carousel-caption d-none d-md-block">
					</div>
  				</div>

			</div>

<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
	<span class="carousel-control-prev-icon" aria-hidden="true"></span>
	<span class="sr-only">Previous</span>
</a>
<a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
	<span class="carousel-control-next-icon" aria-hidden="true"></span>
	<span class="sr-only">Next</span>
</a>
</div> -->		<!-- /CAROUSEL-->

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
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" >Retour</button>
        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
      </div>
    </div>
  </div>
</div>	<!-- /MODAL horaires du barIcam -->



	<?php  	//DEBUT VOTE
	if (($date_actuelle > $jour_avant) && ($date_actuelle < $jour_apres) && in_array($promo_votant['promo'], [122, 121, 120, 119, 118, 2022, 2021, 2020, 2019, 2018]) ){ // verifie intervalle de temps + PROMO A METTRE A JOUR TOUS LES ANS J'AI LA FLEMME DE FAIRE UN TRUC AUTOMATIQUE

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

<DIV class="card-deck"> <!-- CARD-DECK-->

	<div class="row" > <!-- Ligne de 4 cartes publiques -->
		<div class="card border-dark" style="margin-bottom: 10px" >
			<img class="card-img-top" style="max-height: 150px;"  src="img/<?php echo $data_carte1[4] ; ?>" alt="image carte 1" style="max-height: 150px;">
			<div class="card-body">
				<h4 class="card-title"><?php echo $data_carte1[0]?></h4>
				<p class="card-text"><?php echo $data_carte1[1]?></p>
			</div>
			<?php 
			if ($data_carte1[2]=='1'){ 
				echo '<div class="card-footer bg-transparent"><a class="btn btn-primary" href="../casper" target="_blank" role="button" >'.$data_carte1[3].' &raquo;</a></div>';
			} ?>
		</div>

		<div class="card border-dark" style="margin-bottom: 10px">
			<img class="card-img-top" class="img-fluid"  src="img/<?php echo $data_carte2[4] ; ?>" alt="Card image cap" style="max-height: 150px;">
			<div class="card-body">
				<h4 class="card-title"><?php echo $data_carte2[0]?></h4>
				<p class="card-text"><?php echo $data_carte2[1]?></p>
			</div>
			<?php 
			if ($data_carte2[2]=='1'){ 
				echo ' <div class="card-footer bg-transparent"><a class="btn btn-primary" href="../shotgun" role="button">'; echo $data_carte2[3].' &raquo;</a> </div>  ';
			} ?>
		</div>



		<div class="card border-dark" style="margin-bottom: 10px"> <!-- gala -->
			<img class="card-img-top" class='img-fluid'  src='img/<?php echo $data_carte3[4] ; ?>' alt="image carte 3">
			<div class="card-body">
				<h4 class="card-title"><?php echo $data_carte3[0]?> </h4>
				<p class="card-text"><?php echo $data_carte3[1]?></p>
			</div>   
			<?php 
			if ($data_carte3[2]=='1'){ 
				if (in_array($promo_votant['promo'], [122, 121, 120, 119, 118, 2022, 2021, 2020, 2019, 2018]) ){
					echo '<div class="card-footer bg-transparent"><a class="btn btn-primary" href="../inscription_galadesicam" target="_blank" role="button" >'.$data_carte3[3].' &raquo;</a></div>';
				}
				else{
					echo '<div class="card-footer bg-transparent"><a class="btn btn-primary" href="151.80.232.129/gala_icam" target="_blank" role="button" >'.$data_carte3[3].' &raquo;</a></div>';

				}
			} ?>
		</div>

		<div class="card border-dark" style="margin-bottom: 10px">
			<img class="card-img-top" class="img-fluid"  src="img/<?php echo $data_carte4[4] ; ?>" alt="Card image cap">
			<div class="card-body">
				<h4 class="card-title"><?php echo $data_carte4[0]?></h4>
				<p class="card-text"><?php echo $data_carte4[1]?></p>
			</div>
			<?php 
			if ($data_carte4[2]=='1'){ 
				echo ' <div class="card-footer bg-transparent"><a class="btn btn-primary" href="#" role="button">'; echo $data_carte4[3].' &raquo;</a> </div>  ';
			} ?>
		</div>

	</div>    <!-- /Ligne de 4 cartes publiques  -->

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
					<a class="btn btn-primary" href="../scoobydoo" target="_blank" role="button">Scoobydoo &raquo;</a>
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
						<a class="btn btn-primary" href="../admin_ginger" target="_blank" role="button">Admin Ginger &raquo;</a>
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
					<a class="btn btn-primary" href="../mozart" target="_blank" role="button">Mozart &raquo;</a>
				</div>
			</div>

			<div class="card border-dark" style="margin-bottom: 10px">
				<div class="card-body">
					<h4 class="card-title">Admin ventes en ligne</h4>
					<p class="card-text">Administration des ventes d'articles en ligne, celle de shotgun.</p>
				</div>
				<div class="card-footer bg-transparent">
					<a class="btn btn-primary" href="../shotgun/admin" target="_blank" role="button">Shotgun &raquo;</a>
				</div>
			</div>  

		</div>  	<!-- /Ligne de 4 cartes admin  -->
	<?php endif ?>
		<!-- fin Auth admin -->
	

</DIV>  <!-- /CARD-DECK -->

<?php include 'includes/footer.php';?>










