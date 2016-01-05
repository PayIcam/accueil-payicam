<?php

require_once 'includes/_header.php';

$casUrl = $Auth->logOut();

header('Location:'.$casUrl);exit;
