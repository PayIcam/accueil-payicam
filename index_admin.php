<?php

require_once 'includes/_header.php';

$title_for_layout = 'Accueil';
$js_for_layout = array('faq');

require 'includes/ini_variables.php';
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
<?php $new_slide_content = ob_get_clean();

renderModal('new_slide', 'Ajouter un slide', $new_slide_content);
renderModal('new_carte', 'Ajouter une carte', getNewCardForm());

?>

<button class="btn btn-<?=$slider ? 'primary' : 'warning' ?>" type="button"><a class="text-white" href="toggle_slider.php"><?=$slider ? 'Désactiver' : 'Réactiver' ?> le slider</a></button>

<form class="mt-3" method="POST" action="update_homepage.php" enctype="multipart/form-data">
    <div class="container">
        <div class="card-deck" style="column-count:3">
            <?php foreach($slides as $slide) { ?>
                <div class="card border-dark" style="margin-bottom: 10px">
                    <img class="card-img-top" style="max-height: 150px;"  src="img/<?= $slide['url'] ; ?>" alt="Card image cap">
                    <div class="card-body">
                        <input type="file" name="image_slide[<?=$slide['id']?>]">
                        <div class="mt-2 text-center">
                            <button class="btn btn-danger" type="button" onclick="confirm('Êtes vous sûr ?')"><a class="text-white" href="delete_slide.php?id=<?=$slide['id']?>">Supprimer</a></button>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>

    <div class="container">
        <div class="card-deck">
            <div class="row">
                <?php foreach($cartes as $carte) {
                    displayCardForm($carte);
                } ?>
            </div>
        </div>
        <hr>
        <div class="card-deck">
            <div class="row">
                <?php foreach($cartes_admin as $carte) {
                    displayCardForm($carte, 'admin');
                } ?>
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
