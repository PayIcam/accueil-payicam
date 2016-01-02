<?php
  require_once 'includes/_header.php';
    $Auth->allow('member');
  include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
?>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.png">

    <title>PayIcam - Accueil</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>


    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h1>Bienvenue sur PayIcam !</h1>
            <p>Ceci est la page d'accueil de payicam, vous pouvez choisir l'application que vous souhaitez utiliser </p>
          </div>
          <div class="row">
            <div class="col-xs-8 col-lg-6">
              <h2>Rechargement</h2>
              <p>Le rechargement se fait via Casper, l'interface web pour la gestion de son compte personnel </p>
              <p><a class="btn btn-default" href="../casper" target="blank" role="button">Casper &raquo;</a>
                <IMG src="img/gold_card.png" width="200" height="125"></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-8 col-lg-6">
              <h2>Billeterie</h2>
              <p>La billeterie de l'Icam, si vous souhaitez acheter des places ou des goodies, shotgun est l'interface de vente en ligne!</p>
              <p><a class="btn btn-default" href="../shotgun" target="blank" role="button">Shotgun &raquo;</a>
              <IMG src="img/tickets.png" width="250" height="150"></p></p>
              </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-8 col-lg-6">
              <h2>Associations</h2>
              <p>Site du BDE et autres </p>
              <p><a class="btn btn-default" href="http://bde.icam.fr/" target="blank" role="button">Assos &raquo;</a>
                <IMG src="img/wave.png" width="250" height="150"></p>
            </div><!--/.col-xs-6.col-lg-4-->
            <div class="col-xs-8 col-lg-6">
              <h2>Les évènements</h2>
              <p>Events de l'ICAM. </p>
              <p><a class="btn btn-default" href="#" role="button">Events &raquo;</a>
                <IMG src="img/gala.png" width="225" height="175"></p>
            </div><!--/.col-xs-6.col-lg-4-->
            </div><!--/.col-xs-6.col-lg-4-->
            </div><!--/.col-xs-6.col-lg-4-->         
          </div><!--/row-->
        </div><!--/.col-xs-12.col-sm-9-->


      <hr>

      <footer>
        <p>&copy;2015, PayIcam Dev Team</p>
      </footer>

    </div><!--/.container-->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

  </body>
</html>
