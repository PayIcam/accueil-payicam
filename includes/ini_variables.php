<?php

$user = $Auth->getUser();

$slides = $accueil_db->prepare("SELECT * FROM slides");
$slides->execute();
$slides = $slides->fetchAll();

$cartes = $accueil_db->prepare("SELECT * FROM cartes WHERE is_admin=0");
$cartes->execute();
$cartes = $cartes->fetchAll();
$cartes_admin = $accueil_db->prepare("SELECT * FROM cartes WHERE is_admin=1");
$cartes_admin->execute();
$cartes_admin = $cartes_admin->fetchAll();

$slider = $accueil_db->query("SELECT * FROM config WHERE field='slider'");
$slider = $slider->fetch()['value'];
