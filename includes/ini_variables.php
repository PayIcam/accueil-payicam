<?php

$Auth->allow('super-admin');
$user = $Auth->getUser();

$slides = $accueil_db->prepare("SELECT * FROM slides");
$slides->execute();
$slides = $slides->fetchAll();

$cartes = $accueil_db->prepare("SELECT * FROM cartes");
$cartes->execute();
$cartes = $cartes->fetchAll();

$slider = $accueil_db->query("SELECT * FROM config WHERE field='slider'");
$slider = $slider->fetch()['value'];
