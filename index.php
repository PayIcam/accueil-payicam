<?php

require 'includes/_header.php';

$Auth->allow('member');

$title_for_layout = 'Accueil';
$js_for_layout = array('bootstrap.min.js', 'indice_gala');

require 'includes/ini_variables.php';

#Le vote doit être totalement refait parce que là c'est un foutoir.
$param_vote = $accueil_db->prepare('SELECT * FROM vote_option');
$param_vote->execute();
$infos_vote = $param_vote->fetch();

$my_vote = $accueil_db->prepare('SELECT * FROM vote_has_voters WHERE email=:email');
$my_vote->execute(['email' => $_SESSION['login']]);
$vote_fait = $my_vote->fetch();

$date_actuelle = date("Y-m-d H:i:s");
$date_begin = strtotime($infos_vote['date_debut']);
$date_end = strtotime($infos_vote['date_fin']);
$jour_avant = date("Y-m-d H:i:s", strtotime("-1 days", $date_begin));//Bouton vote apparait 1 jour avant
$jour_apres = date("Y-m-d H:i:s", strtotime("+12 hours", $date_end));// disparait 12 heures après
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');

$promo_site = $ginger_db->prepare('SELECT promo, site FROM users WHERE mail=:email');
$promo_site->execute(['email' => $_SESSION['login']]);
$promo_site = $promo_site->fetch();

$promo = $promo_site['promo'];
$site = $promo_site['site'];

if ('Toulouse' === $site) {
    header('Location:../accueil-toulouse');
    die();
}

include 'includes/header.php'; ?>

<?php if($slider): ?>
    <div id="carousel" style="padding-top: 0px ; margin-bottom: 20px; border-radius: 4px;" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
        <?php foreach ($slides as $slide) { ?>
            <li data-target="#carousel" data-slide-to="<?= $slide['id'] ?>" class="active"></li>
        <?php } ?>
        </ol>
        <div class="carousel-inner">
        <?php foreach ($slides as $key => $slide) { ?>
            <div id="<?= $slide["id"]?>" class="carousel-item <?= $key == 0 ? "active" : "" ?>">
                <img class="d-block w-100" src="img/<?= $slide["url"]?>" alt="<?= $slide["alt"]?>">
                <div class="carousel-caption d-none d-md-block"> </div>
            </div>
            <?php } ?>
        </div>
        <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
<?php endif; ?>

<?php if (($date_actuelle > $jour_avant) && ($date_actuelle < $jour_apres) && in_array($promo, [24, 123, 122, 121, 120, 119, 2023, 2022, 2021, 2020, 2019]) && $site == 'Lille') {
	if ($vote_fait != false) { ?>
		<a class="btn btn-warning btn-lg btn-block" href="#" type='button' style="margin-bottom: 10px" disabled>Vous avez déjà voté. Rendez-vous ce soir pour le résultat!</a>
	<?php } else {
			if ($infos_vote['date_debut'] > $date_actuelle) { ?>
			    <a class="btn btn-warning btn-lg btn-block" href="#" type='button' style="margin-bottom: 10px" disabled>Ouverture du vote <?= strftime("%A", strtotime($infos_vote['date_debut'])) ?> à <?= date("G", strtotime($infos_vote['date_debut'])) ?>h!</a>
			<?php } elseif ($infos_vote['date_fin'] < $date_actuelle) { ?>
			    <a class="btn btn-warning btn-lg btn-block" href="#" type='button' style="margin-bottom: 10px" disabled>Vote terminé. Rendez-vous ce soir pour le résultat!</a>
			<?php } else{ ?>
        		<a class="btn btn-warning btn-lg btn-block" href="vote.php" type='button' style="margin-bottom: 10px" >Votez ici pour votre <?= $infos_vote['nom_vote'] ?>! (Fermeture du vote à <?= date("G", strtotime($infos_vote['date_fin'])) ?>h)</a>
    		<?php }
	}
} ?>

<div id="cards" class="card-deck">
	<div class="row"> <!-- Ligne de 4 cartes publiques -->
		<?php $i=0; foreach($cartes as $carte): ?>
    		<?php if (empty($carte['sites']) || in_array($site, json_decode($carte['sites']))): ?>
        		<div class="card border-dark" style="margin-bottom: 10px">
        			<img class="card-img-top" style="max-height: 150px;" src="img/<?= $carte['photo_url']; ?>" alt="image carte" style="max-height: 150px;">
        			<div class="card-body">
        				<h4 class="card-title"><?= $carte['title']?></h4>
        				<p class="card-text"><?= $carte['description']?></p>
        			</div>
                    <?php if($carte['active_button']): ?>
                        <div class="text-center card-footer bg-transparent">
                            <a class="btn btn-primary" href="../<?= $carte['target'] ?>" target="_blank" role="button"><?= $carte['button_title'] ?> »</a>
                            <?php if ($i==1): ?>
                                <a class="btn btn-primary" href="../billetterie" target="_blank" role="button">Billetterie »</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php $i++; endif; ?>
        <?php endforeach; ?>
    </div>
	<!--auth admin -->
	<?php if ($Auth->hasRole('admin')): ?>
		<div class="container" style="background-color: #d9d9d9; margin-top: 10px; margin-bottom: 10px">
			<h2 class="page-header text-center">Liens vers l'Administration</h2>
		</div>
		<div class="row"><!-- Ligne de 4 cartes admin  -->
			<div class="card border-dark" style="margin-bottom: 10px">
				<div class="card-body">
					<h4 class="card-title">Admin PayIcam</h4>
					<p class="card-text">Application web permettant entre autre la gestion des articles, la gestion des droits, la trésorerie, ...</p>
				</div>
				<div class="text-center card-footer bg-transparent">
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
					<div class="card-footer bg-transparent text-center">
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
				<div class="card-footer bg-transparent text-center">
					<a class="btn btn-primary" href="../mozart" target="_blank" role="button">Mozart &raquo;</a>
				</div>
			</div>

			<div class="card border-dark" style="margin-bottom: 10px">
				<div class="card-body">
					<h4 class="card-title">Admin ventes en ligne</h4>
					<p class="card-text">Administration des ventes d'articles en ligne, celle de shotgun.</p>
				</div>
				<div class="card-footer bg-transparent text-center">
					<a class="btn btn-primary" href="../shotgun/admin" target="_blank" role="button">Shotgun &raquo;</a>
				</div>
			</div>

		</div>  	<!-- /Ligne de 4 cartes admin  -->
	<?php endif ?>
		<!-- fin Auth admin -->


</div>  <!-- /CARD-DECK -->

<?php include 'includes/footer.php'; ?>