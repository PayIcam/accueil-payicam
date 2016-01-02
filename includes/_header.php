<?php
	define('DS', DIRECTORY_SEPARATOR);
	define("ROOT_PATH", preg_replace('/includes$/', '', dirname(__FILE__)));
	define("HOME_URL", dirname($_SERVER['PHP_SELF']));

	require_once ROOT_PATH.'class/Config.php';
	require "config.php";
	Config::initFromArray($_CONFIG);

	require_once ROOT_PATH.'includes/functions.php' ;

	if(!isset ($_SESSION)){session_start();} //si aucun session active
	require_once ROOT_PATH.'class/Auth.class.php' ;
	if ((!empty($_POST['token']) && !Auth::validateToken($_POST['token'])) || (!empty($_GET['token']) && !Auth::validateToken($_GET['token']))) {
		if ($Auth->isLogged()){
      		header('Location:'.$_SERVER['PHP_SELF']);
			Functions::setFlash('<strong>Erreur de Token</strong> Votre token n\'est plus valide !','danger');
		}else{
      		header('Location:connection.php');
		}
      	exit;
	}

	if (!in_array(basename($_SERVER['SCRIPT_FILENAME']), array('connection.php', 'logout.php'))){
		$Auth->allow('member');
	}

	header('Content-Type: text/html; charset=utf-8');

