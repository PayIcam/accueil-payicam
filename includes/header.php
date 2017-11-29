<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.png" />
    <!-- <script type="text/javascript" href="https://popper.js.org"></script> -->

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

   <title><?php if(isset($title_for_layout)){echo $title_for_layout.' - ';} ?><?= WEBSITE_TITLE; ?></title> 
  </head>
  <body>
<!-- Test couleurs de la nouvelle barre de navigation -->
<!-- <nav class="navbar fixed-top navbar-dark "  style="background-color: #766839;">
  <a class="navbar-brand" href="#">
    <img src="img/PayIcam.png" width="100" height="30" class="d-inline-block align-top" alt="">
  </a>
</nav> -->


<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
  <div class="container">
    <div class="navbar-header">
      <a class="navbar-brand" href="#"><img src="img/PayIcam-h30-white.png" width="100" height="33" class="d-inline-block align-top" alt=""></a>
      <button class="navbar-toggler collapsed my-2 my-lg-0" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
    </div>
  
  <div id="navbarNav" class="collapse navbar-collapse" >
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 ">
      <li class="nav-item active"><span class="sr-only">(current)</span></li>
      <?php 
      // require "functions.php"; 
      ?>
      
      <li class="nav-item" <?php if(Functions::isPage('index')) echo ' class="active"'; ?> ><a  class="nav-link" href="index.php">Accueil</a>     </li>
      <li class="nav-item" <?php if(Functions::isPage('about')) echo ' class="active"'; ?> ><a  class="nav-link" href="about.php">A propos</a> </li>

     <!--  <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->

<!-- accessible avec Auth -->
<?php if ($Auth->isLogged()): ?>
      <li class="nav-item" <?php if(Functions::isPage('faq')) echo ' class="active"'; ?> ><a  class="nav-link" href="faq.php">FAQ & Tutos</a> </li>
      <li class="nav-item" <?php if(Functions::isPage('contact')) echo ' class="active"'; ?> ><a  class="nav-link" href="contact.php">Contact</a> </li>
<?php endif ?>
<!-- accessible super admin -->
<?php if ($Auth->hasRole('super-admin')): ?>
        <li class="nav-item" ><a  class="nav-link" href="accueil_admin.php">Paramètres</a> </li>
<?php endif ?>
<!--  fin accessible super admin-->
    </ul>
<?php if ($Auth->isLogged()): ?>
    <ul class="nav navbar-nav my-2 my-lg-0">
      <li class="nav-item"><a  class="nav-link" href="logout.php">Déconnexion</a></li>
    </ul>
<?php endif ?>    

<!-- fin accessible avec Auth -->
  </div>  <!-- /nav collapse-->

  </div>  <!-- /container -->  
</nav>  <!-- /navbar -->  

    <div class="container">
      <?= Functions::flash(); ?>
