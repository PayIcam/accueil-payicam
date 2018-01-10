<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="author" content="Hugo Renaudin, 119">
     <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.png" />
    <script type="text/javascript" href="https://popper.js.org"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    
    <!-- Ajoute par Hugo -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
    <!-- /fin ajout -->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

 <title><?php if(isset($title_for_layout)){echo $title_for_layout.' - ';} ?><?= WEBSITE_TITLE; ?></title> 

  <style>

ul {
  display: inline;
  margin: 0;
  padding: 0;
}
ul li {display: inline-block;}
/*ul li:hover {background: #C0C0C6; border-radius: 2px;
-moz-transition: all 0.4s linear;
  -ms-transition: all 0.4s linear;
  -o-transition: all 0.4s linear;
  -webkit-transition: all 0.4s linear;
  transition: all 0.4s linear;}*/
ul li:hover ul {display: block;}
ul li ul {
  position: absolute;
  width: 130px;
  display: none;
}
ul li ul li { 
  background: #353A40; 
  display: block; 
}
ul li ul li a {display:block !important;
  border-radius: 0px;} 
ul li ul li:hover {background: #C0C0C6;

  -moz-transition: all 0.6s linear;
  -ms-transition: all 0.6s linear;
  -o-transition: all 0.6s linear;
  -webkit-transition: all 0.6s linear;
  transition: all 0.6s linear;}

.onglet:hover{border-bottom: 4px solid #C0C0C6; background: #353A40 ;}

</style>

  </head>
  <body>
<!-- Test couleurs de la nouvelle barre de navigation -->
<!-- <nav class="navbar fixed-top navbar-dark "  style="background-color: #766839;">
  <a class="navbar-brand" href="#">
    <img src="img/PayIcam.png" width="100" height="30" class="d-inline-block align-top" alt="">
  </a>
</nav> -->


<nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark" style="height: 63px">
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
       //require "functions.php"; 
      ?>
      
      <li class="onglet" <?php if(Functions::isPage('index')) echo ' class="active"'; ?> ><a  class="nav-link" href="index.php">Accueil</a>     </li>
      <li class="onglet" <?php if(Functions::isPage('about')) echo ' class="active"'; ?> ><a  class="nav-link" href="about.php">À propos</a> </li>

<!-- accessible avec Auth -->
      <li class="onglet" <?php if(Functions::isPage('faq')) echo ' class="active"'; ?> ><a  class="nav-link" href="faq.php">FAQ & Tutos</a> </li>
      
      <li class="onglet" >
        <a  class="nav-link" href="#" style="width: 130px; text-align: center">Liens utiles</a>
        <ul>
          <li class="nav-item" ><a  data-toggle="modal" data-target="#exampleModal" class="nav-link" href="#">Horaires du BarIcam</a> </li>
          <li class="nav-item"><a  class="nav-link" href="https://planning.icam.fr/lille/">Hyperplanning</a> </li>
          <li class="nav-item"><a  class="nav-link" href="https://moodle.icam.fr/">Moodle</a> </li>
          <li class="nav-item"><a  class="nav-link" href="https://portfolio.icam.fr/">Portfolio</a> </li>
          <li class="nav-item"><a  class="nav-link" href="http://www.icam-alumni.fr/">Annuaire Icam</a> </li>          
          <li class="nav-item"><a  class="nav-link" href="https://password.icam.fr/">Changer mon mot de passe</a> </li>          

        </ul> 
      </li>
      <li class="onglet" <?php if(Functions::isPage('contact')) echo ' class="active"'; ?> ><a  class="nav-link" href="contact.php">Contact</a> </li>
    </ul>

    <ul class="nav navbar-nav my-2 my-lg-0">
      <!-- accessible super admin -->
      <?php if ($Auth->hasRole('super-admin')): ?>
        <li class="nav-item" ><a  class="nav-link" href="index_admin.php">Paramètres</a> </li>
      <?php endif ?>
      <!--  fin accessible super admin-->
      <li class="nav-item"><a  class="nav-link" href="logout.php">Déconnexion</a></li>
    </ul>
<!-- fin accessible avec Auth -->

  </div>  <!-- /nav collapse-->
  </nav>  <!-- /navbar -->  
  <!-- Button trigger modal -->



  </div>  <!-- /container -->  


    <div class="container">
      <?= Functions::flash(); ?>
