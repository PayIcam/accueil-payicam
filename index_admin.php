<?php

require_once 'includes/_header.php';

$Auth->allow('super-admin');
$user = $Auth->getUser();
$title_for_layout = 'Accueil';
$js_for_layout = array('faq');

$requete_slides = $accueil_db->prepare("SELECT * FROM slides");
$requete_slides->execute();
$slides = $requete_slides->fetchAll();

$requete_cartes = $accueil_db->prepare("SELECT * FROM cartes");
$requete_cartes->execute();
$cartes = $requete_cartes->fetchAll();

require 'includes/header.php';

ob_start(); ?>
    <form method="POST" action="add_slide.php" enctype="multipart/form-data">
        <div class="form-group">
            <input class="form-control" type="file" name="file">
        </div>
        <div class="form-group">
            <label for="alt">Alt</label>
            <input class="form-control" id="alt" type="text" name="alt">
        </div>
        <button class="btn btn-primary">Ajout</button>
    </form>
<?php $new_slide_content = ob_get_clean(); ?>
<?php ob_start(); ?>
    <form method="POST" action="add_carte.php" enctype="multipart/form-data">
        <div class="form-group">
            <input class="form-control" type="file" name="file" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input class="form-control" id="title" type="text" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" type="text" name="description" required></textarea>
        </div>
        <hr>
        <div class="form-group">
            <label for="button_title">Button title</label>
            <input class="form-control" id="button_title" type="text" name="button_title" required>
        </div>
        <div class="form-group">
            <label for="target">Target</label>
            <input class="form-control" id="target" type="text" name="target" required>
        </div>

        <div class="m-2">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="active_button" id="button_actived" value="1" required>
                <label class="form-check-label" for="button_actived">Lien activé</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="active_button" id="button_disabled" value="0">
                <label class="form-check-label" for="button_disabled">Lien désactivé</label>
            </div>
        </div>
        <button class="btn btn-primary">Ajout</button>

    </form>

<?php $new_carte_content = ob_get_clean();

renderModal('new_slide', 'Ajouter un slide', $new_slide_content);
renderModal('new_carte', 'Ajouter une carte', $new_carte_content);

?>

<form class="mt-3" method="POST" action="update_homepage.php" enctype="multipart/form-data">
    <div class="container">
        <div class="card-deck" style="column-count:3">
            <?php foreach($slides as $slide) { ?>
                <div class="card border-dark" style="margin-bottom: 10px">
                    <img class="card-img-top" style="max-height: 150px;"  src="img/<?= $slide['url'] ; ?>" alt="Card image cap">
                    <div class="card-body">
                        <input type="file" name="image_slide[<?=$slide['id']?>]">
                        <div class="mt-2 text-center">
                            <button class="btn btn-danger" type="button" onclick="confirm('Êtes vous sûr ?')"><a class="text-white" href=" delete_slide.php?id=<?=$slide['id']?>">Supprimer</a></button>
                        </div>
                    </div>
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
                    <img class="card-img-top" class='img-fluid' src='img/<?= $carte['photo_url'] ?>' alt="Card image cap" style="max-height: 150px;">
                    <div class="card-body">
                        <input type="file" name="image_carte[<?=$carte['id']?>]" style="font-size:10px;margin-bottom: 10px">
                        <h4 class="card-title"><input class="form-control" name="title[<?=$carte['id']?>]" autofocus  value="<?= $carte['title'] ?>" rows="1"></h4>
                        <p class="card-text">
                            <textarea class="form-control" name="description[<?=$carte['id']?>]" autofocus rows="6"><?= $carte['description'] ?></textarea>
                        </p>
                    </div>
                    <div class="card-footer bg-transparent">
                        <div class="col md-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input <?=$carte['active_button']==1 ? 'checked' : '' ?> class="form-check-input" type="radio" name="active_button[<?=$carte['id']?>]" value="on"> Activer le bouton </label>
                            </div>
                        </div>
                        <div class="col md-4">
                            <div class="form-check">
                                <label class="form-check-label"> <input <?=$carte['active_button']==0 ? 'checked' : '' ?> class="form-check-input" type="radio" name="active_button[<?=$carte['id']?>]" value="off"><span style="font-size: 15px"> Désactiver le bouton</span> </label>
                            </div>
                        </div>
                        <h4 class="card-title"><input class="form-control" name="button_title[<?=$carte['id']?>]" autofocus  value="<?= $carte['button_title'] ?>" rows="1"></h4>
                        <h4 class="card-title"><input class="form-control" name="target[<?=$carte['id']?>]" autofocus  value="<?= $carte['target'] ?>" rows="1"></h4>
                        <div class="text-center mt-2">
                            <button class="btn btn-danger" type="button" onclick="confirm('Êtes vous sûr ?')"><a class="text-white" href="delete_carte.php?id=<?=$carte['id']?>">Supprimer</a></button>
                        </div>
                    </div>
                </div>
            <?php } ?>
            </div>
        </div>
    </div>

    <!-- boutons d'envoi du formulaire -->

    <div class="container" style="width: auto">
        <div class="card border-dark">
            <div class="text-center card-body">
                <button class="btn btn-primary btn-lg" role="button" type=submit>Enregistrer</button>
            </div>
        </div>
    </div>
</form>

<?php

include 'includes/footer.php';
