<?php
	require_once 'includes/_header.php';
	$Auth->allow('member');

	require_once ROOT_PATH.'class/DB.php';
	$confSQL = $_CONFIG['conf_sql_vote'];
    try {
        $DB = new DB($confSQL['sql_host'],$confSQL['sql_user'],$confSQL['sql_pass'],$confSQL['sql_db']);
    } catch (Exception $e) {
        $DB = null;
    }

	$conf_sql_promo = $_CONFIG['conf_sql_promo'];
    try {
        $DB_promo = new DB($conf_sql_promo['sql_host'],$conf_sql_promo['sql_user'],$conf_sql_promo['sql_pass'],$conf_sql_promo['sql_db']);
    } catch (Exception $e) {
        $DB_promo = null;
    }

    $user = $Auth->getUser();
	var_dump($user);

	$vote = $DB->query('SELECT * FROM vote WHERE slug = "elections-bde-2017"');
	$my_vote = $DB->query('SELECT * FROM vote_has_voters WHERE email = :email', ['email' => $user['email']]);
	$promo = $DB_promo->query('SELECT promo FROM users WHERE email = :email', ['email' => $user['email']]);
	var_dump($vote);
	var_dump($my_vote);
	if (count($my_vote)>0){
		Functions::setFlash("Charles arrête tes conneries",'danger');
    	header('Location:index.php');
	}

	$date_vote=date('Y-m-d H:i:s');
	$enreg= $DB->prepare('INSERT INTO vote_has_voters (vote_id, email, date_vote, promo, choice) value (DEFAULT, :email, :date_vote, :promo, :choice)');
	$enreg -> bindParam('email', $_SESSION['Auth']['email'], PDO::PARAM_STR);
	$enreg -> bindParam('date_vote', $date_vote, PDO::PARAM_STR);
	$enreg -> bindParam('promo', $promo, PDO::PARAM_INT);
	$enreg -> bindParam('choice', $_POST, PDO::PARAM_STR);
	try {
		$enreg -> execute();
	} catch (Exception $e) {
		Functions::setFlash("Votre vote n'a pas été enregistré, si le problème persiste, contacter Payicam",'danger');
        header('Location:index.php');
    }
    Functions::setFlash("Votre vote a bien été enregistré, ",'info');
        header('Location:index.php');


	?>