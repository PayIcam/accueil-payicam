<?php

use \JsonClient\JsonException;

session_start();

define("ROOT_PATH", preg_replace('/includes$/', '', dirname(__FILE__)));
define("HOME_URL", dirname($_SERVER['PHP_SELF']));
define("WEBSITE_TITLE", 'PayIcam');

require_once ROOT_PATH . 'class/Config.php';
require_once ROOT_PATH . 'includes/functions.php';
require_once ROOT_PATH . 'class/Auth.class.php';
require_once ROOT_PATH . 'vendor/payutc-json-client/jsonclient/JsonClient.class.php';

require "config.php";

Config::initFromArray($_CONFIG);

$conf_accueil = $_CONFIG['accueil_db'];
$conf_ginger = $_CONFIG['ginger_db'];

$accueil_db = new PDO('mysql:host='.$conf_accueil['sql_host'].';dbname='.$conf_accueil['sql_db'].';charset=utf8', $conf_accueil['sql_user'], $conf_accueil['sql_pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
$ginger_db = new PDO('mysql:host='.$conf_ginger['sql_host'].';dbname='.$conf_ginger['sql_db'].';charset=utf8', $conf_ginger['sql_user'], $conf_ginger['sql_pass'], array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));

$payutcClient = new \JsonClient\AutoJsonClient(
    Config::get('payutc_server'),
    'KEY',
    array(),
    "PayIcam Json PHP Client",
    isset($_SESSION['payutc_cookie']) ? $_SESSION['payutc_cookie'] : ""
);

if (!in_array(basename($_SERVER['SCRIPT_FILENAME']), array('connection.php', 'logout.php', 'about.php'))){
	$Auth->allow('member');
}

header('Content-Type: text/html; charset=utf-8');
