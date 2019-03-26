<?php
require_once 'includes/_header.php';

$Auth->allow('super-admin');
$user = $Auth->getUser();
require_once ROOT_PATH.'class/DB.php';
require('config.php');
$title_for_layout = 'Accueil';
$js_for_layout = array('faq');
include 'includes/header.php';
$confSQL = $_CONFIG['conf_accueil'];

try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

$requete_slides = $DB->prepare("SELECT * FROM payicam_accueil_slide");
$requete_slides->execute();
$slides = $requete_slides->fetchAll();

$requete_cartes = $DB->prepare("SELECT * FROM payicam_carte");
$requete_cartes->execute();
$cartes = $requete_cartes->fetchAll();
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


<form method="POST" action="update_homepage.php" enctype="multipart/form-data">
    <div class="container">
        <div class="card-deck" style="column-count:3">
            <?php foreach($slides as $slide) { ?>
                <div class="card border-dark" style="margin-bottom: 10px" >
                    <img class="card-img-top" style="max-height: 150px;"  src="<?= $slide["slide_image"] ; ?>" alt="Card image cap">
                    <div class="card-body">
                        <h4 class="card-title"><center></center></h4>
                        <input class="btn btn-primary" type="file" name="input_image_slide[<?=$slide["slide_id"]?>]">
                    </div>
                        <a href="delete_slide.php?id=<?=$slide["slide_id"]?>"><center><button class="btn btn-danger" type="button" onclick="confirm('Êtes vous sûr ?')">Supprimer</button></center></a>
                </div>
            <?php } ?>
        </div>
    </div>

<!-- CARTES -->

    <div class="container">
        <div class="card-deck">
            <div class="row">
                <?php foreach($cartes as $carte) { ?>
                <div class="card border-dark" style="margin-bottom: 10px">
                    <img class="card-img-top" class='img-fluid'  src='<?= $carte['carte_photo'] ?>' alt="Card image cap" style="max-height: 150px;">
                    <div class="card-body">
                        <input class="btn btn-primary" type="file" name="input_image_carte[<?=$carte['carte_id']?>]" style="font-size:10px;margin-bottom: 10px" >
                        <h4 class="card-title"><input class="form-control" name= "maj_titre[<?=$carte['carte_id']?>]" autofocus  value="<?= $carte['carte_titre'] ?>" rows="1"></h4>
                        <p class="card-text">
                            <textarea class="form-control" name= "maj_description[<?=$carte['carte_id']?>]" autofocus rows="6"><?= $carte['carte_description'] ?></textarea>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="col md-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input <?=$carte['carte_activation_bouton']==1 ? 'checked' : '' ?> class="form-check-input" type="radio" name="maj_actif[<?=$carte['carte_id']?>]" value="on"  > Activer le bouton </label>
                            </div>
                        </div>
                        <div class="col md-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input <?=$carte['carte_activation_bouton']==0 ? 'checked' : '' ?> class="form-check-input" type="radio" name="maj_actif[<?=$carte['carte_id']?>]" value="off"><span style="font-size: 15px"> Désactiver le bouton</span> </label>
                            </div>
                        </div>
                        <h4 class="card-title"><input class="form-control" name= "maj_bouton[<?=$carte['carte_id']?>]" autofocus  value="<?= $carte['carte_bouton'] ?>" rows="1"></h4>
                        <h4 class="card-title"><input class="form-control" name= "maj_lien[<?=$carte['carte_id']?>]" autofocus  value="<?= $carte['carte_lien'] ?>" rows="1"></h4>
                    </div>
                    <a href="delete_carte.php?id=<?=$carte['carte_id']?>"><center><button class="btn btn-danger" type="button" onclick="confirm('Êtes vous sûr ?')">Supprimer</button></center></a>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>

    <!-- boutons d'envoi du formulaire -->

    <div class="container " style="width: auto">
        <div class="card border-dark">
            <div class="card-body">
                <button class="btn btn-primary btn-lg" role="button" type=submit>Enregistrer</button>
                <button class="btn btn-secondary btn-lg" type="button" onclick="window.location.reload(false)">Annuler</button>
            </div>
        </div>
    </div>
</form>

</br><!--NOUVEAU SLIDE -->
<form method="POST" action="add_slide.php" enctype="multipart/form-data">
    <dl>
        <div class="card border-dark" style="margin-bottom: 10px">
            <dt><center><h5>Ajouter un slide</h5></center></dt>
            <dd>
                <center><input class="btn btn-primary" type="file" name="new_slide"></center></br>
                <div class="card-footer bg-transparent">
                    <button class="btn btn-primary btn-sm" role="button" type=submit>Enregistrer</button>
                    <button class="btn btn-secondary btn-sm" type="button" onclick="window.location.reload(false)">Annuler</button>
                </div>
            </dd>
        </div>
    </dl>
</form>

<!--NOUVELLE CARTE -->
<form method="POST" action="add_carte.php" enctype="multipart/form-data">
    <dl>
        <div class="card border-dark" style="margin-bottom: 10px">
            <dt><center><h5>Ajouter une carte</h5></center></dt>
                <dd>
                    <div class="card-body">
                        <input required class="btn btn-primary" type="file" name="new_carte_photo" style="font-size:10px;margin-bottom: 10px" >
                        <h4 class="card-title"><input required class="form-control" name= "new_carte_titre" autofocus  placeholder="Titre de la carte" rows="1"></h4>
                        <p class="card-text">
                            <textarea required class="form-control" name= "new_carte_description" autofocus rows="6" placeholder="Description de la carte"></textarea>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="col md-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input class="form-check-input" type="radio" name="new_carte_activation" value="on"> Activer le bouton </label>
                            </div>
                        </div>
                        <div class="col md-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input class="form-check-input" type="radio" name="new_carte_activation" value="off"><span style="font-size: 15px"> Désactiver le bouton</span> </label>
                            </div>
                        </div>
                        <h4 class="card-title"><input required class="form-control" name= "new_carte_bouton" autofocus placeholder="Nom du lien" rows="1"></h4>
                        <h4 class="card-title"><input required class="form-control" name= "new_carte_lien" autofocus placeholder="Lien" rows="1"></h4>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-primary btn-sm" type=submit>Enregistrer</button>
                        <button class="btn btn-secondary btn-sm" type="button" onclick="window.location.reload(false)">Annuler</button>
                    </div>
                    </div>
                </dd>
        </div>
    </dl>
</form>

<?php include 'includes/footer.php';