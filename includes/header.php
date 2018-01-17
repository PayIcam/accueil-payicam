<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <meta name="author" content="Hugo Renaudin, 119">
     <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-112368112-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-112368112-1');
	</script>

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
      <a class="navbar-brand" href="#"><img src="img/PayIcam-h30-white.png" width="100" height="33" class="d-inline-block align-top" alt=""></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

  <div id="navbarSupportedContent" class="collapse navbar-collapse" >
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active"><a class="nav-link" href="#"><span class="sr-only">(current)</span></a></li>
      
      <li class="nav-item"><a  class="nav-link" href="index.php">Accueil</a></li>
      <li class="nav-item"><a  class="nav-link" href="about.php">À propos</a> </li>

<!-- accessible avec Auth -->
      <li class="nav-item"><a  class="nav-link" href="faq.php">FAQ & Tutos</a></li>
      <li class="nav-item dropdown" >
        <a  class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Liens utiles</a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a  data-toggle="modal" data-target="#exampleModal" class="nav-link" href="#">Horaires du BarIcam</a>
          <a  class="dropdown-item" href="https://planning.icam.fr/lille/">Hyperplanning</a>
          <a  class="dropdown-item" href="https://moodle.icam.fr/">Moodle</a>
          <a  class="dropdown-item" href="https://portfolio.icam.fr/">Portfolio</a>
          <a  class="dropdown-item" href="http://www.icam-alumni.fr/">Annuaire Icam</a>        
          <a  class="dropdown-item" href="https://password.icam.fr/">Changer mon mot de passe</a> 
        </div>          
      </li>

      <li class="nav-item"><a  class="nav-link" href="contact.php">Contact</a> </li>
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
</div>
  </nav>  <!-- /navbar -->  
<div class="container">
  
    <?= Functions::flash(); ?>
