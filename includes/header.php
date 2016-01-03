<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
     <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.png" />

    <title><?php if(isset($title_for_layout)){echo $title_for_layout.' - ';} ?><?= WEBSITE_TITLE; ?></title>

    <nav class="navbar navbar-fixed-top navbar-inverse">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href=""><img src="img/PayIcam-h30-white.png"></a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li<?php if(Functions::isPage('index')) echo ' class="active"'; ?>><a href="index.php">Home</a></li>
            <li<?php if(Functions::isPage('about')) echo ' class="active"'; ?>><a href="about.php">A propos</a></li>
            <li<?php if(Functions::isPage('faq')) echo ' class="active"'; ?>><a href="faq.php">FAQ & Tutos</a></li>
            <li<?php if(Functions::isPage('contact')) echo ' class="active"'; ?>><a href="contact.php">Contact</a></li>
          </ul>
          <ul class="nav navbar-nav navbar-right">
          <li><a href="logout.php">Déconnexion</a></li>
          </ul>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">
      <?= Functions::flash(); ?>