<?php

require 'includes/_header.php';

foreach($_POST['title'] as $carte_id => $title) {
    if(!empty($title)) {
        $title = htmlspecialchars($title);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre un titre", 'danger');
    }
    if(!empty($_POST['description'][$carte_id])) {
        $description = htmlspecialchars($_POST['description'][$carte_id]);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre une description", 'danger');
    }
    if(!empty($_POST['active_button'][$carte_id])) {
        $active_button = $_POST['active_button'][$carte_id] == 'off' ? 0 : 1;
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "On ne sait pas si tu veux activer la carte", 'danger');
    }
    if(!empty($_POST['button_title'][$carte_id])) {
        $bouton = htmlspecialchars($_POST['button_title'][$carte_id]);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre un titre au bouton", 'danger');
    }
    if(isset($_POST['target'][$carte_id])) {
        $target = htmlspecialchars($_POST['target'][$carte_id]);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre un lien", 'danger');
    }
    $is_super_admin = isset($_POST['is_super_admin'][$carte_id]) ? 1:0;

    $carte = [
        'id' => $carte_id,
        'title' => $title,
        'description' => $description,
        'active_button' => $active_button,
        'button_title' => $bouton,
        'target' => $target,
        'is_super_admin' => $is_super_admin,
    ];


    $update = $accueil_db->prepare('UPDATE cartes SET title = :title, description = :description, active_button = :active_button, button_title = :button_title, target = :target, is_super_admin = :is_super_admin WHERE id = :id');
    $update->execute($carte);

    if(!empty($_FILES['input_image_carte']['name'][$carte_id])) {
        upload_image('input_image_carte', 'carte', $carte_id, true);
    }
}

foreach($_FILES['input_image_slide']['name'] as $slide_id => $name) {
    if(!empty($_FILES['input_image_slide']['name'][$slide_id])) {
        upload_image('input_image_slide', 'slide', $slide_id, true);
    }
}

Functions::setFlashAndRedirect('index_admin.php', "Modification effectuée");