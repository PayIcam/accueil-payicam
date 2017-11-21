<?php
	require_once 'includes/_header.php';
	$Auth->allow('member');

	require_once ROOT_PATH.'class/DB.php';
	$confSQL = $_CONFIG['conf_sql_vote'];

    // try {
    //     $DB = new DB($confSQL['sql_host'],$confSQL['sql_user'],$confSQL['sql_pass'],$confSQL['sql_db']);
    // } catch (Exception $e) {
    //     $DB = null;
    // }
$date_debut=strtotime("21-11-2017 20:00");
$date_fin=strtotime("22-11-2017 23:00");
$date_actuelle=strtotime("now");

if ($date_actuelle < $date_debut){
	Functions::setFlash("Minute papillon!",'danger');
	header('Location:index.php');
}
elseif ($date_actuelle > $date_fin) {
	Functions::setFlash("Trop tard connard!",'danger');
	header('Location:index.php');
}

try
{
	$DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
	die('erreur:'.$e->getMessage());
}
	$conf_sql_promo = $_CONFIG['conf_sql_promo'];

	try
{
	$DB_promo = new PDO('mysql:host='.$conf_sql_promo['sql_host'].';dbname='.$conf_sql_promo['sql_db'].';charset=utf8',$conf_sql_promo['sql_user'],$conf_sql_promo['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
}
catch(Exeption $e)
{
	die('erreur:'.$e->getMessage());
}
    // try {
    //     $DB_promo = new DB($conf_sql_promo['sql_host'],$conf_sql_promo['sql_user'],$conf_sql_promo['sql_pass'],$conf_sql_promo['sql_db']);
    // } catch (Exception $e) {
    //     $DB_promo = null;
    // }

    $user = $Auth->getUser();
	// var_dump($user);

	// $vote = $DB->query('SELECT * FROM vote WHERE slug = "elections-bde-2017"');

	$my_vote = $DB->prepare('SELECT * FROM vote_has_voters WHERE email = :email');
	$my_vote -> bindParam('email', $user['email'], PDO::PARAM_STR);
	$my_vote->execute();
	$vote_fait = $my_vote->fetch();


	$promo = $DB_promo->prepare('SELECT promo FROM users WHERE mail = :email');
	$promo -> bindParam('email', $user['email'], PDO::PARAM_STR);
	$promo->execute();
	$promo_votant = $promo->fetch();
	// var_dump($vote);
	// var_dump($my_vote);
	if ($vote_fait != false){
		Functions::setFlash("Charles arrête tes conneries",'danger');
    	header('Location:index.php');
	}

	$enreg= $DB->prepare('INSERT INTO vote_has_voters (email, promo, choice) values (:email, :promo, :choice)');

	$date_vote=date('Y-m-d H:i:s');
	$enreg -> bindParam('email', $user['email'], PDO::PARAM_STR);
	$enreg -> bindParam('promo', $promo_votant['promo'], PDO::PARAM_INT);
	$enreg -> bindParam('choice', $_POST['vote'], PDO::PARAM_STR);
	try {
		$enreg -> execute();
    	Functions::setFlash("Votre vote a bien été enregistré ",'info');
        header('Location:index.php');
	} catch (Exception $e) {
		Functions::setFlash("Votre vote n'a pas été enregistré, si le problème persiste, contactez Payicam",'danger');
        header('Location:index.php');
    }


	?>