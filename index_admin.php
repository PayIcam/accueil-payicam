<?php
require_once 'includes/_header.php';

$Auth->allow('super-admin');
$user = $Auth->getUser();
require_once ROOT_PATH.'class/DB.php';
require('config.php');
$title_for_layout = 'Accueil';
include 'includes/header.php';
$confSQL = $_CONFIG['conf_accueil'];

try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

$requete_slides = $DB->prepare("SELECT slide_image, slide_message FROM payicam_accueil_slide");
$requete_slides->execute();
$slides = $requete_slides->fetchAll();

$requete_cartes = $DB->prepare("SELECT carte_titre, carte_description, carte_activation_bouton, carte_bouton, carte_photo FROM payicam_carte");
$requete_cartes->execute();
$cartes = $requete_cartes->fetchAll();

?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


<form method="POST" action="update_homepage.php" enctype="multipart/form-data" >
    <div class="container">
        <div class="card-deck">
            <div class="row">
                <?php
                $i=1;
                foreach($slides as $slide) { ?>
                    <div class="card border-dark" style="margin-bottom: 10px" >
                        <img class="card-img-top" style="max-height: 150px;"  src="img/<?= $slide["slide_image"] ; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"><center></center></h4>
                            <input class="btn btn-primary" type="file" name="input_image_slide_<?=$i?>">
                        </div>
                    </div>
                <?php $i++; } ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="card-deck">
            <div class="row">

                <?php $i=1;
                foreach($cartes as $carte) { ?>
                <div class="card border-dark" style="margin-bottom: 10px">
                    <img class="card-img-top" class='img-fluid'  src='img/<?= $carte['carte_photo'] ?>' alt="Card image cap" style="max-height: 150px;">
                    <div class="card-body">
                        <input class="btn btn-primary" type="file" name="input_image_carte_<?=$i?>" style="font-size:10px;margin-bottom: 10px" >
                        <h4 class="card-title"><input class="form-control" name= "maj_titre_<?=$i?>" autofocus  value="<?= $carte['carte_titre'] ?>" rows="1"></h4>
                        <p class="card-text">
                            <textarea class="form-control" name= "maj_description_<?=$i?>" autofocus rows="6"><?= $carte['carte_description'] ?></textarea>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="col md-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input <?=$carte['carte_activation_bouton']==1 ? 'checked' : '' ?> class="form-check-input" type="radio" name="carte_<?=$i?>_bouton" value="on"  > Activer le bouton </label>
                            </div>
                        </div>
                        <div class="col md-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input <?=$carte['carte_activation_bouton']==0 ? 'checked' : '' ?> class="form-check-input" type="radio" name="carte_<?=$i?>_bouton" value="off"><span style="font-size: 15px"> Désactiver le bouton</span> </label>
                            </div>
                        </div>
                        <a class="btn btn-primary">
                            <input class="form-control" name= "maj_nom_bouton_<?=$i?>" autofocus value="<?= $carte['carte_bouton'] ?>">
                        </a>
                    </div>
                </div>
            <?php $i++; } ?>
            </div>
        </div>
    </div>

    <div class="container " style="width: auto">    <!-- boutons d'envoi du formulaire -->
        <div class="card border-dark">
            <div class="card-body">
                <button  style='text-align:center' class="btn btn-primary btn-lg" role="button" type=submit> Enregistrer</button>
                <button  style='text-align:center' class="btn btn-primary btn-lg" onclick="window.location.replace('index.php')">Annuler</button>
            </div>
        </div>
    </div>

</form>

<?php include 'includes/footer.php';