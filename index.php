<?php
require_once 'includes/_header.php';

$Auth->allow('member');
require_once ROOT_PATH.'class/DB.php';
include('config.php');
$title_for_layout = 'Accueil';
   include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
   $confSQL = $_CONFIG['conf_accueil'];


  // try{
  //   $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
  //   } catch(Exeption $e) {
  //   die('erreur:'.$e->getMessage());
  //   }

  //   for ($i = 1; $i<5; $i++){
  //     $requete = $DB->prepare('SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id='.$i);
  //     $requete -> execute();
  //     $Resultat.$i = $requete->fetch();
  //   }


   $ConnexionBD = mysqli_connect($confSQL['sql_host'], $confSQL['sql_user'], $confSQL['sql_pass'], $confSQL['sql_db']);
  // $Resultat1 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=1");
   $Resultat2 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=2");
   $Resultat3 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=3");
   $Resultat4 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=4");
   $Resultat5 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=5");
   $Resultat6 = mysqli_query($ConnexionBD, "SELECT evenement_titre, evenement_description, evenement_activation_bouton, evenement_bouton,evenement_afficher_cacher FROM payicam_evenement WHERE evenement_id='1'");
   $Resultat7 = mysqli_query($ConnexionBD, "SELECT evenement_titre, evenement_description, evenement_activation_bouton, evenement_bouton FROM payicam_evenement WHERE evenement_id='2' ");


  // $data_baniere = mysqli_fetch_array($Resultat1);
   $data_slide1 = mysqli_fetch_array($Resultat2);
   $data_slide2 = mysqli_fetch_array($Resultat3);
   $data_slide3 = mysqli_fetch_array($Resultat4);
   $data_slide4 = mysqli_fetch_array($Resultat5);
   $data_accueil_evenement1 = mysqli_fetch_array ($Resultat6);
   $data_accueil_evenement2 = mysqli_fetch_array ($Resultat7);

   ?>
   <!-- <div class="container"> -->
   	<!-- <div class="container " style="padding-top: 20px ;margin-bottom: 30px; height: 140px ;background-color: #d9d9d9; border-radius: 4px;"> -->
   		<!-- <center><h2 class="display-4"><?php echo $data_baniere[0] ; ?></h2> <p class="lead"><?php echo $data_baniere[1] ; ?></p></center> -->
   		
   		<!-- </div> --> <!-- /container -->
   		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

   		<div id="carouselExampleIndicators" style="padding-top: 0px ; margin-bottom: 20px; border-radius: 4px;" class="carousel slide" data-ride="carousel">
   			<ol class="carousel-indicators">
   				<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
   				<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
   				<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
   				<!-- <li data-target="#carouselExampleIndicators" data-slide-to="3"></li> -->
   			</ol>
   			<div class="carousel-inner">
   				<div class="carousel-item active">
   					<img class="d-block w-100" src="img/slide1.jpg"  alt="First slide">
   					<div class="carousel-caption d-none d-md-block">
   						<h3><?php echo $data_slide1[0] ; ?></h3>
   						<p><?php echo $data_slide1[1] ; ?></p>
   					</div>
   				</div>
   				<div class="carousel-item">
   					<img class="d-block w-100" src="img/slide2.jpg" alt="Second slide">
   					<div class="carousel-caption d-none d-md-block">
   						<h3><?php echo $data_slide2[0] ; ?></h3>
   						<p><?php echo $data_slide2[1] ; ?></p>
   					</div>
   				</div>
   				<div class="carousel-item" >
   					<img class="d-block w-100" id="slide3" src="img/slide3.jpg" alt="Third slide">
   					<!-- "height:400px;padding-right:350px;padding-left: 350px" -->
   					<div class="carousel-caption d-none d-md-block">
   						<h3><?php echo $data_slide3[0] ; ?></h3>
   						<p><?php echo $data_slide3[1] ; ?></p>
   					</div>
   				</div>
<!--     <div class="carousel-item" >
      <img class="d-block w-100" id="slide4" src="img/slide4.jpg" style="height: 500px; width:auto; object-fit: contain"  alt="Third slide">
      "height:400px;padding-right:350px;padding-left: 350px" cette ligne en douvle commentaire
      <div class="carousel-caption d-none d-md-block">
      <h3><?php echo $data_slide4[0] ; ?></h3>
      <p><?php echo $data_slide4[1] ; ?></p>
      </div>
  </div> -->
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

<div class="container">
	<DIV class="card-deck"> 

		<div class="row" >
			<div class="card border-dark" style="margin-bottom: 10px" >
				<img class="card-img-top" style="max-height: 150px;"  src="img/carte.jpg" alt="Card image cap">
				<div class="card-body">
					<h4 class="card-title">Rechargement</h4>
					<p class="card-text">Le rechargement se fait via Casper, l'interface web pour la gestion de son compte personnel </p>
				</div>
				<div class="card-footer bg-transparent">
					<a class="btn btn-primary" href="../casper" target="_blank" role="button">Casper &raquo;</a>
				</div>
			</div>

			<div class="card border-dark" style="margin-bottom: 10px">
				<img class="card-img-top" class="img-fluid" style="max-height: 150px;" src="img/ticket.png" alt="Card image cap">
				<div class="card-body ">
					<h4 class="card-title">Billeterie</h4>
					<p class="card-text">La billeterie de l'Icam, si vous souhaitez acheter des places ou des goodies, shotgun est l'interface de vente en ligne!</p>
				</div>
				<div class="card-footer bg-transparent">
					<a class="btn btn-primary" href="../shotgun" target="_blank" role="button">Shotgun &raquo;</a>
				</div>
			</div>


			
			<div class="card border-dark" style="margin-bottom: 10px">
				<img class="card-img-top" class='img-fluid'  src='img/gala.jpg' alt="Card image cap">
				<div class="card-body">
					<h4 class="card-title"><?php echo $data_accueil_evenement1[0]?> </h4>
					<p class="card-text"><?php echo $data_accueil_evenement1[1]?></p>
				</div>   
				<?php 
				if ($data_accueil_evenement1[2]=='1'){ 
					echo '<div class="card-footer bg-transparent"><a class="btn btn-primary" href="../#" target="_blank" role="button" >'.$data_accueil_evenement1[3].' &raquo;</a></div>';
				} ?>
			</div>

			<div class="card border-dark" style="margin-bottom: 10px">
				<img class="card-img-top" class="img-fluid"  src="img/spring.jpg" alt="Card image cap">
				<div class="card-body">
					<h4 class="card-title"><?php echo $data_accueil_evenement2[0]?></h4>
					<p class="card-text"><?php echo $data_accueil_evenement2[1]?></p>
				</div>
				<?php 
				if ($data_accueil_evenement2[2]=='1'){ 
					echo ' <div class="card-footer bg-transparent"><a class="btn btn-primary" href="#" role="button">'; echo $data_accueil_evenement2[3].' &raquo;</a> </div>  ';
				} ?>
			</div>
		</div>    <!-- /ROW -->

		<!--auth admin -->
		<?php if ($Auth->hasRole('admin')): ?>
			<div class="container " style="background-color: #d9d9d9; margin-top: 10px; margin-bottom: 10px">
				<center><h2 class="page-header">Liens vers l'Administration</h2></center>
			</div >
			
			<div class="row">
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
					</div>  <!-- fin auth super admin -->
				<?php endif ?>


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
			</div>  <!-- /ROW -->
			<!-- fin Auth admin -->
		<?php endif ?>

	</DIV>  <!-- /CARD-DECK -->

	<?php include 'includes/footer.php';?>










