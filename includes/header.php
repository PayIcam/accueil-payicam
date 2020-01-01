<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
        <link href="css/flipclock.css" rel="stylesheet">
        <link rel="shortcut icon" href="favicon.png" />

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

        <title><?php if(isset($title_for_layout)){echo $title_for_layout.' - ';} ?><?= WEBSITE_TITLE; ?></title>
    </head>
    <body>
        <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="img/PayIcam-h30-white.png" width="100" height="33" class="d-inline-block align-top" alt=""></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>

                <div id="navbarSupportedContent" class="collapse navbar-collapse">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active"><a class="nav-link" href="#"><span class="sr-only">(current)</span></a></li>
                        <li class="nav-item"><a class="nav-link" href="index.php">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="about.php">À propos</a></li>
                        <li class="nav-item"><a class="nav-link" href="faq.php">FAQ & Tutos</a></li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#liens_utiles" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Liens utiles</a>
                            <div id="liens_utiles" class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal" href="#">Horaires du BarIcam</a>
                                <a class="dropdown-item" href="https://planning.icam.fr/lille/">Hyperplanning</a>
                                <a class="dropdown-item" href="https://moodle.icam.fr/">Moodle</a>
                                <a class="dropdown-item" href="https://portfolio.icam.fr/">Portfolio</a>
                                <a class="dropdown-item" href="http://www.icam-alumni.fr/">Annuaire Icam</a>
                                <a class="dropdown-item" href="https://password.icam.fr/">Changer mon mot de passe</a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                    </ul>

                    <ul class="nav navbar-nav my-2 my-lg-0">
                        <?php if ($Auth->hasRole('super-admin')): ?>
                            <li class="nav-item"><a class="nav-link" href="index_admin.php">Paramètres</a></li>
                        <?php endif ?>
                        <li class="nav-item"><a class="nav-link" href="logout.php">Déconnexion</a></li>
                    </ul>
                </div>
            </div>

        </nav>
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="exampleModalLabel">Horaires du BarIcam</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-auto">
                                    <img src="img/logobaricam.png" style="height: 160px; width: auto; padding: 10px" alt="bar logo">
                                </div>
                                <div class="col-md-auto" style="padding-top: 15px">
                                    <strong>Lundi :</strong> 21h30 - 23h <br>
                                    <strong>Mardi (sans alcools) :</strong> 17h30 - 19h <br>
                                    <strong>Mercredi :</strong> 22h00 - 23h30 <br>
                                    <strong>Jeudi :</strong> 18h00 - 20h30 <br>
                                    <strong>Vendredi :</strong> 21h30 - 23h
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="container">

    <?= Functions::flash(); ?>
