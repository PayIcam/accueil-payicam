<?php
  require_once 'includes/_header.php';

// Connexion via le CAS
if (!empty($_GET['ticket'])) {
  $_SESSION['flash'] = array();
  if ($Auth->loginUsingCas($_GET['ticket'])) {
    Functions::setFlash("Authentification réussie !",'success');
    header('Location:index.php');exit;
  }else{

  }
}

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title>Connexion</title> <!--afficher dans le titre de la page web Bonjour icam précédé de title-for-layout qui est préciser dans chaque page-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Site internet Admin Ginger - Connexion">
    <meta name="author" content="Antoine Giraud">
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-112368112-1"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());

      gtag('config', 'UA-112368112-1');
    </script>
    <link rel="shortcut icon" href="favicon.png">

    <!-- Le styles -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <style type="text/css">
        body {
          padding-top: 40px;
          padding-bottom: 40px;
          background-color: #eee;
          text-align: center;

        }

        .form-signin {
          max-width: 330px;
          padding: 15px;
          margin: 0 auto;
        }
        .form-signin .form-signin-heading,
        .form-signin .checkbox {
          margin-bottom: 10px;
        }
        .form-signin .checkbox {
          font-weight: normal;
        }
        .form-signin .form-control {
          position: relative;
          height: auto;
          -webkit-box-sizing: border-box;
             -moz-box-sizing: border-box;
                  box-sizing: border-box;
          padding: 10px;
          font-size: 16px;
        }
        .form-signin .form-control:focus {
          z-index: 2;
        }
        .form-signin input[type="email"] {
          margin-bottom: -1px;
          border-bottom-right-radius: 0;
          border-bottom-left-radius: 0;
        }
        .form-signin input[type="password"] {
          margin-bottom: 10px;
          border-top-left-radius: 0;
          border-top-right-radius: 0;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le favicon (img du site ds le navigateur) -->
  </head>

  <body>

    <div class="container">
      <?= Functions::flash(); ?>
        <form class="form-signin<?= (isset($_GET['errorLogin']))?' has-error':''; ?>" role="form">
          <p><img src="img/PayIcam.png" alt="PayIcam"></p>
          <h2 class="form-signin-heading page-header">Identifiez-vous !</h2>
          <br>
          <p><a href="<?= $payutcClient->getCasUrl(); ?>login?service=<?= urlencode(Config::get('accueil-payicam')) ?>" class="btn btn-lg btn-primary btn-block">Connexion</a></p>
          <br>
          <p><a href="about.php">à propos</a></p>
        </form>

    <script src="js/jquery.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>