<?php
	define('DS', DIRECTORY_SEPARATOR);
	define("ROOT_PATH", preg_replace('/includes$/', '', dirname(__FILE__)));
    define("HOME_URL", dirname($_SERVER['PHP_SELF']));
	define("WEBSITE_TITLE", 'PayIcam');

	require_once ROOT_PATH.'class/Config.php';
	require "config.php";
	Config::initFromArray($_CONFIG);

	require_once ROOT_PATH.'includes/functions.php' ;

	if(!isset ($_SESSION)){session_start();} //si aucun session active

	require_once ROOT_PATH.'vendor/payutc-json-client/jsonclient/JsonClient.class.php';
	use \JsonClient\JsonException;
	$payutcClient = new \JsonClient\AutoJsonClient(
        Config::get('payutc_server'),
        'KEY',
        array(),
        "PayIcam Json PHP Client",
        isset($_SESSION['payutc_cookie']) ? $_SESSION['payutc_cookie'] : ""
	);
    $casUrl = $payutcClient->getCasUrl();

	require_once ROOT_PATH.'class/Auth.class.php';

	if (!in_array(basename($_SERVER['SCRIPT_FILENAME']), array('connection.php', 'logout.php', 'about.php'))){
		$Auth->allow('member');
	}

	header('Content-Type: text/html; charset=utf-8');

