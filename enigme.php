<?php

require_once 'includes/_header.php';
$Auth->allow('member');
$user = $Auth->getUser();
$title_for_layout = 'Enigme';
$js_for_layout = array('enigme');
$confSQL = $_CONFIG['conf_accueil'];

try {
    $db = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
} catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
}

$enigme = $db->query('SELECT * FROM enigmes');
$enigme = $enigme->fetch();
$user_answer = $db->prepare('SELECT * FROM enigme_answers WHERE email = :email');
$user_answer->execute(array('email' => $user['email']));
$user_answer = $user_answer->fetch();

include 'includes/header.php';

?>

<h1 style="font-size:5em;" class="text-center"><?=$enigme['title']?></h1>
<br><br><br>

<!-- <p>
    <strong>
        Salut jeune pirate, cette semaine est celle de la fin de mon règne. <br>
        Je pars donc la tête haute en te laissant une chance de trouver mon trésor. <br>
        Tu trouveras sur ce papier tous les indices te menant  au lieu du trésor.
    </strong>
</p>
<p>
    Mon premier indice est chronologique.  <br>
    C’est l’homme de toutes les mi-temps du stade bollaert. <br>
    C’est l’homme canonisé du 21ème siècle. <br>
    C’est le point commun de ------ -------- et de ---- - ---- --. <br>
</p>
<p>
    Mon second indice se sépare en deux, tout comme le premier. <br>
    <img src="autre_blason.jpg" alt="img1"><img src="blason_coq.jpg" alt="img2"><br>
    Ces deux blasons donnent chacun deux nombres utilisés par la poste.
</p>
<p>
    <strong>
    Combinez tous ces indices pour trouver l’endroit de la réponse. <br>
    Seul les plus intelligents trouverons la réponse !
    </strong>
</p> -->
<p><?=$enigme['description']?></p>

<form action="enigme_answer.php">
    <div class="form-group">
        <label for="answer">Ta réponse ?</label>
        <input type="text" class="form-control" id="answer" name="answer" aria-describedby="answer_help" placeholder="Entre ta réponse à l'énigme">
        <small id="answer_help" class="form-text text-muted">Tu peux tenter autant de fois que nécessaire</small>
    </div>
    <button type="submit" class="btn btn-primary">Envoyer la réponse</button>
</form>