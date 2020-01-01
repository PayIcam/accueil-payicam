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
$my_vote->execute(['email' => $user['email']]);
$vote_fait = $my_vote->fetch();

$date_actuelle = date("Y-m-d H:i:s");
$date_begin = strtotime($infos_vote['date_debut']);
$date_end = strtotime($infos_vote['date_fin']);
$jour_avant = date("Y-m-d H:i:s", strtotime("-1 days", $date_begin));//Bouton vote apparait 1 jour avant
$jour_apres = date("Y-m-d H:i:s", strtotime("+12 hours", $date_end));// disparait 12 heures après
date_default_timezone_set('Europe/Paris');
setlocale(LC_TIME, 'fr_FR.utf8','fra');

$promo_site = $ginger_db->prepare('SELECT promo, site FROM users WHERE mail=:email');
$promo_site->execute(['email' => $user['email']]);
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
	<div class="row">
		<?php $i=0; foreach($cartes as $carte) {
    		if (empty($carte['sites']) || in_array($site, json_decode($carte['sites']))) {
                displayCard($carte, $i);
                $i++;
            }
        } ?>
    </div>

	<?php if ($Auth->hasRole('admin')): ?>
		<div class="container" style="background-color: #d9d9d9; margin-top: 10px; margin-bottom: 10px">
			<h2 class="page-header text-center">Liens vers l'Administration</h2>
		</div>

        <div class="row">
            <?php foreach($cartes_admin as $carte) {
                if (!$carte['is_super_admin'] || $Auth->hasRole('super-admin')) {
                    if (empty($carte['sites']) || in_array($site, json_decode($carte['sites']))) {
                        displayCard($carte, $i);
                    }
                }
            } ?>
        </div>
	<?php endif ?>


</div>

<?php include 'includes/footer.php'; ?>