<?php

require 'includes/_header.php';
$Auth->allow('super-admin');

$toggle = $accueil_db->query("UPDATE config SET value = 1 - value WHERE field='slider'");

Functions::setFlashAndRedirect('index_admin.php', "Toggle effectué");