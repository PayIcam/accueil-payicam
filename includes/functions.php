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
    var_dump($id);
    if(!in_array($type, ['slide', 'carte'])) {
        Functions::setFlashAndRedirect('index_admin.php', "Le type renseigné n'existe pas", "warning");
    }
    global $DB;

    $extensions = array('.png', '.jpeg', '.gif');
    $dossier = 'img/';

    $name = empty($array) ? $_FILES[$index]['name'] : $_FILES[$index]['name'][$id];

    $extension = strrchr($name, '.');
    if(!in_array($extension, $extensions)) {
        Functions::setFlashAndRedirect('index_admin.php', "Une des images n'est pas du bon format (jpeg/png/gif)", "warning");
    }
    $fichier = $dossier . $type . '_' . $id . $extension;

    $tmp_name = empty($array) ? $_FILES[$index]['tmp_name'] : $_FILES[$index]['tmp_name'][$id];

    if(move_uploaded_file($tmp_name, $fichier)) {
        if($type=='slide') {
            $requete_update_slide = $DB->prepare("UPDATE payicam_accueil_slide SET slide_image=:fichier WHERE slide_id=:id");
        }
        elseif($type=='carte') {
            $requete_update_slide = $DB->prepare("UPDATE payicam_carte SET carte_photo=:fichier WHERE carte_id=:id");
        }
        else {
            die("Le type d'image est incorrect");
        }
        $requete_update_slide->execute(array("fichier" => $fichier, "id" => $id));
    }
    else {
        var_dump($_FILES[$index]["error"]);
        var_dump($fichier);
        die('rdc");"');
        Functions::setFlashAndRedirect('index_admin.php', "Pour une raison inconnue, l'upload n'a pas fonctionné", "warning");
    }
}