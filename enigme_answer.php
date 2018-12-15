<?php

require_once 'includes/_header.php';
$Auth->allow('member');
$user = $Auth->getUser();

if(isset($_GET['answer'])) {
    $confSQL = $_CONFIG['conf_accueil'];

    try {
        $db = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
        die('erreur:'.$e->getMessage());
    }

    $answer = $db->query('SELECT answer, banned_users FROM enigmes');
    $answer = $answer->fetch();
    $banned_users = json_decode($answer['banned_users']);
    $answer = $answer['answer'];

    if($_GET['answer'] == $answer) {
        $is_first = $db->query('SELECT COUNT(*) FROM enigme_answers');
        $is_first = $is_first->fetch()['COUNT(*)'] == 0 ? true : false;

        if($Auth->hasRole('super-admin')) {
            if($is_first) {
                Functions::setFlash("Alors, t'es un beau <del>fdp</del> coquin à pas jouer le jeu. Mais t'as quand même gagné officieusement", 'primary');
                header('Location: index.php');
                die();
            } else {
                Functions::setFlash("De une, je suis sur que t'as triché. De deux, t'es même pas le premier", 'warning');
                header('Location: index.php');
                die();
            }
        } elseif(in_array($user['email'], $banned_users)) {
            if($is_first) {
                Functions::setFlash("Chers amis, merci pour votre beau jeu, mais vous ne le gagnerez pas", 'primary');
                header('Location: index.php');
                die();
            } else {
                Functions::setFlash("Chers amis, merci pour votre beau jeu, mais vous ne le gagnerez pas, et en plus vous êtes même pas premiers", 'warning');
                header('Location: index.php');
                die();
            }
        }


        $insert = $db->prepare('INSERT INTO enigme_answers(email, answer) VALUES (:email, :answer)');
        $insert->execute(array('email' => $user['email'], 'answer' => $_GET['answer']));
        if($is_first) {
            Functions::setFlash("Bon ok t'as gagné", 'success');
            header('Location: index.php');
            die();
        } else {
            Functions::setFlash("T'en as mis du temps... La prochaine fois dépêche toi si tu veux gagner", 'warning');
            header('Location: index.php');
            die();
        }
    } else {
        Functions::setFlash("T'es nul c'est chaud", 'warning');
        header('Location: enigme.php');
        die();
    }

} else {
    Functions::setFlash("Alors toi tu fais des carabistouilles", 'danger');
    header('Location: enigme.php');
    die();
}
