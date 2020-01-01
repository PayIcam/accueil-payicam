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
    if(!empty($_POST['maj_bouton'][$carte_id])) {
        $bouton = htmlspecialchars($_POST['maj_bouton'][$carte_id]);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre un nom au bouton", 'danger');
    }
    if(!empty($_POST['target'][$carte_id])) {
        $target = htmlspecialchars($_POST['target'][$carte_id]);
    } else {
        Functions::setFlashAndRedirect('index_admin.php', "T'as oublié de mettre un lien", 'danger');
    }

    $carte = [
        'id' => $carte_id,
        'title' => $title,
        'description' => $description,
        'active_button' => $active_button,
        'button_title' => $bouton,
        'target' => $target,
    ];

    $update = $accueil_db->prepare('UPDATE cartes SET title = :title, description = :description, active_button = :active_button, button_title = :button_title, target = :target WHERE id = :id');
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