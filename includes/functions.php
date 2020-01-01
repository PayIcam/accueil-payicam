<?php

/**
 * Fonction debug qui permet d'afficher joliment le contenu d'une variable dans un pre
 * @param <type> $var
 * @param char $nom
 */
function debug($var,$nom=NULL,$open=1){ //afficher les données tel que le pc les récupère
    //if (isset($_SESSION['role']) && $_SESSION['role']=='admin' || preg_match('/^\/SiteBdsIcamLille\//', $_SERVER['REQUEST_URI'])) {
        preg_match('#([a-z1-9_-]+.php)$#', $_SERVER['SCRIPT_FILENAME'], $matches);
        echo '<div><div><p class="alert alert-warning" onclick="jQuery(this).next().slideToggle();" style="cursor:pointer;"><a class="close" href="#" onclick="$(this).parent().parent().slideUp();return false;">×</a>debug à la ligne <strong>'.__LINE__.'</strong>';
        if($nom!=NULL){echo ' de <em><strong>'.$nom.'</em></strong>';}
        echo ' dans <em><strong>'.$matches[0].'</em></strong></p>';
        echo '<pre'.((!empty($open))?'':' style="display:none;"').'>';
        print_r($var);
        echo '</pre></div></div>';
    //}
}

/**
 *
 * @param <type> $chaine
 * @param <type> $lg_max
 * @return string
 */
function racourcirChaine($chaine,$lg_max){
    if (strlen($chaine) > $lg_max)
    {
        $chaine = substr($chaine, 0, $lg_max);
        $last_space = strrpos($chaine, " ");
    //On ajoute ... à la suite de cet espace
        $chaine = substr($chaine, 0, $last_space)."...";
    }
    return $chaine;
}

class Functions{

    /**
     *
     * @param <type> $message
     * @param <type> $type
     */
    static function setFlash($message, $type = 'success'){ // On créer un tableau dans lequel on stock un message et un type qu'on place dans la variable flash de la variable $_session
        $_SESSION['flash'][] = array(
            'message'   => $message,
            'type'      => $type
        );
    }

    /**
     *
     * @return string
     */
    static function flash(){ //parcourir dans les flash de la $_session, le array contenant le message défini grâce au setflash
        if(isset($_SESSION['flash'])){
            $html = '';
            foreach ($_SESSION['flash'] as $k => $v) {
                if(isset($v['message'])){
                    $html .= '<div class="alert alert-'.$v['type'].' alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        '.$v['message'].'
                    </div>';
                }
            }
            $html .= '<div class="clear"></div>';
            $_SESSION['flash'] = array();
            return $html;
        }
    }

    static function setFlashAndRedirect($url, $message, $type = 'success'){ // On créer un tableau dans lequel on stock un message et un type qu'on place dans la variable flash de la variable $_session
        self::setFlash($message, $type);
        header('Location: ' . $url);
        die();
    }


    static function isPage(){
        $i=0;
        foreach (func_get_args() as $key => $v){
            if ($v == 'index') {
                if (preg_match('/\/$/', $_SERVER['REQUEST_URI']))       $i++;
            }
            if(preg_match('/\/'.$v.'\.(php|html|htm)/', $_SERVER['REQUEST_URI']))  $i++;
        }
        if($i>0){return TRUE;}
        else{return FALSE;}
    }
}




function upload_image($index, $type, $id=null, $array=null) {
    global $accueil_db;

    if(!in_array($type, ['slide', 'carte'])) {
        Functions::setFlashAndRedirect('index_admin.php', "Le type renseigné n'existe pas", "warning");
    }

    $name = empty($array) ? $_FILES[$index]['name'] : $_FILES[$index]['name'][$id];
    $extension = strrchr($name, '.');

    if(!in_array(strtolower($extension), ['.png', '.jpeg', '.gif', '.jpg'])) {
        Functions::setFlashAndRedirect('index_admin.php', "Une des images n'est pas du bon format (jpeg/png/gif)", "warning");
    }

    $file_id = $accueil_db->query("SELECT MAX(id)+1 file_id FROM cartes");
    $file_id = $file_id->fetch()['file_id'];
    $file_id = $id === null ? $file_id : $id;

    $file_name = $type . '_' . $file_id . $extension;
    $full_path = 'img/'.$file_name;

    $tmp_name = empty($array) ? $_FILES[$index]['tmp_name'] : $_FILES[$index]['tmp_name'][$id];

    if(move_uploaded_file($tmp_name, $full_path)) {
        if(null !== $id) {
            if($type=='slide') {
                $requete_update_slide = $accueil_db->prepare("UPDATE slides SET url=:file_name WHERE slide_id=:id");
            }
            elseif($type=='carte') {
                $requete_update_slide = $accueil_db->prepare("UPDATE cartes SET image_url=:file_name WHERE carte_id=:id");
            }
            else {
                die("Le type d'image est incorrect");
            }
            $requete_update_slide->execute(array("fichier" => $file_name, "id" => $id));
        } else {
            return $file_name;
        }
    }
    else {
        Functions::setFlashAndRedirect('index_admin.php', "Pour une raison inconnue, l'upload n'a pas fonctionné", "warning");
    }
}

function renderModal($id, $title, $content) { ?>
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#<?=$id?>"><?=$title?></button>

    <div class="modal fade" id="<?=$id?>" tabindex="-1" role="dialog" aria-labelledby="<?=$id?>" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="<?=$id?>"><?=$title?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    </div>
                <div class="modal-body">
                    <?=$content?>
                </div>
            </div>
        </div>
    </div>
<?php }

function displayCard($carte, $i, $type="user") { ?>
    <div class="card border-dark" style="margin-bottom: 10px">
        <?php if(!empty($carte['image_url'])):?>
            <img class="card-img-top" style="max-height: 150px;" src="img/<?= $carte['image_url']; ?>" alt="image carte" style="max-height: 150px;">
        <?php endif; ?>
        <div class="card-body">
            <h4 class="card-title"><?= $carte['title']?></h4>
            <p class="card-text"><?= $carte['description']?></p>
        </div>
        <?php if($carte['active_button']): ?>
            <div class="text-center card-footer bg-transparent">
                <a class="btn btn-primary" href="../<?= $carte['target'] ?>" target="_blank" role="button"><?= $carte['button_title'] ?> »</a>
                <?php if ($i==1 && "user" === $type): ?>
                    <a class="btn btn-primary" href="../billetterie" target="_blank" role="button">Billetterie »</a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
<?php }

function getNewCardForm() {
    ob_start(); ?>

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

        <div class="m-3">
            <div class="form-check">
                <input class="form-check-input" type="radio" name="active_button" id="button_actived" value="1" required>
                <label class="form-check-label" for="button_actived">Lien activé</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="active_button" id="button_disabled" value="0">
                <label class="form-check-label" for="button_disabled">Lien désactivé</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_admin"  name="is_admin">
                <label class="form-check-label" for="is_admin">Carte d'administrateurs</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="is_super_admin" name="is_super_admin">
                <label class="form-check-label" for="is_super_admin">Carte de super admins</label>
            </div>
        </div>
        <button class="btn btn-primary">Ajout</button>
    </form>

    <?php return ob_get_clean();
}

function displayCardForm($carte, $type="user") { ?>
    <div class="card border-dark" style="margin-bottom: 10px">
        <img class="card-img-top" class='img-fluid' src='img/<?= $carte['image_url'] ?>' alt="Card image cap" style="max-height: 150px;">
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
            <h4 class="card-title"><input class="form-control" name="button_title[<?=$carte['id']?>]" autofocus value="<?= $carte['button_title'] ?>" rows="1"></h4>
            <h4 class="card-title"><input class="form-control" name="target[<?=$carte['id']?>]" autofocus value="<?= $carte['target'] ?>" rows="1"></h4>
            <?php if('admin' === $type): ?>
                <div class="m-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="is_super_admin_<?=$carte['id']?>" name="is_super_admin[<?=$carte['id']?>]" <?=$carte['is_super_admin'] ? 'checked' : '' ?>>
                        <label class="form-check-label" for="is_super_admin_<?=$carte['id']?>">Carte de super admins</label>
                    </div>
                </div>
            <?php endif; ?>
            <div class="text-center mt-2">
                <button class="btn btn-danger" type="button" onclick="confirm('Êtes vous sûr ?')"><a class="text-white" href="delete_carte.php?id=<?=$carte['id']?>">Supprimer</a></button>
            </div>
        </div>
    </div>
<?php }
