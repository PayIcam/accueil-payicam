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


