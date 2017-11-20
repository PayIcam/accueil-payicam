<?php
	require_once 'includes/_header.php';
	$Auth->allow('member');

	require_once ROOT_PATH.'class/DB.php';
	$confSQL = $_CONFIG['conf_sql_vote'];
    try {
        $DB = new DB($confSQL['sql_host'],$confSQL['sql_user'],$confSQL['sql_pass'],$confSQL['sql_db']);
    } catch (Exception $e) {
        $DB = null;
    }


	$user = $Auth->getUser();
	var_dump($user);

	$vote = $DB->query('SELECT * FROM vote WHERE slug = "elections-bde-2017"');
	$my_vote = $DB->query('SELECT * FROM vote_has_voters WHERE email = :email', ['email' => $user['email']]);
	var_dump($vote);
	var_dump($my_vote);
	if (($my_vote != '') || !is_null($my_vote)){
		Functions::setFlash("T'as déjà voté petit con",'danger');
    	header('Location:index.php');
	}

	// si on est pas dans la période de vote, être recalé
	// si on est après la période de vote, afficher le résultat !?? (une heure après ?)
	// si il a déjà voté lui afficher son vote !
	// si il n'a pas voté, option


	$title_for_layout = 'Election BDE';

?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <!-- Le styles -->
    <link href="css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="favicon.png" />


    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="http://getbootstrap.com/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<link href="vote_bootstrap_4/css/bootstrap.css" rel="stylesheet">
		<link href="style.css" rel="stylesheet">
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <title><?php if(isset($title_for_layout)){echo $title_for_layout.' - ';} ?><?= WEBSITE_TITLE; ?></title>
  </head>
  <body>
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
            <?php if ($Auth->isLogged()): ?>
            <li<?php if(Functions::isPage('faq')) echo ' class="active"'; ?>><a href="faq.php">FAQ & Tutos</a></li>
            <li<?php if(Functions::isPage('contact')) echo ' class="active"'; ?>><a href="contact.php">Contact</a></li>
            <?php endif ?>
          </ul>
          <?php if ($Auth->isLogged()): ?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="logout.php">Déconnexion</a></li>
          </ul>
          <?php endif ?>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </nav><!-- /.navbar -->

    <div class="container">
      <?= Functions::flash(); ?>

	<div class ="container" id="morph">
		<!-- <img src="morpheus.jpeg" alt="morpheus" style="width:100%;"> -->
		<div class="row" style="padding-top: 62%">
			<div class="col-md-2 offset-md-1">
				<!-- <input type="button" class="btn btn-sparrow btn-lg" value="Je prend le large avec les SP'ARROW!"></input> -->
				<img src="img/logo sparrow.png" type="button" id="sparrow" class='rounded-circle' alt="sparrow" data-toggle="modal" data-target="#sparrowModal">
			</div>
			<div class="col-md-2 offset-md-5">
				<!-- <input type="button" class="btn btn-primary btn-lg" value="Je m'envole avec les SKY!"></input> -->
				<img src="img/logo sky.png" type="button" alt="sky" class='rounded-circle' id="sky" data-toggle="modal" data-target="#skyModal">
			</div>
		</div>
		<div class="row" style="padding-top: 10%">
			<div class="col-md-2 offset-md-5">
				<input type="button" class="btn btn-secondary btn-lg" value="Je vote blanc" data-toggle="modal" data-target="#blancModal"></input>
			</div>	
		</div>
	</div>
<form action="a_voter.php" method="post">	
	<div class="modal fade" id="sparrowModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="sparrow_label">Vote BDE</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p>Ce vote est définitif, êtes-vous sûr?</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
		        <input type="hidden" name='vote' value="sparrow">
		        <input type="submit" class="btn btn-success" value="Je vote SP'ARROW!">
		      </div>
		    </div>
	  </div>
	</div>
</form>
<form action="a_voter.php" method="post">
	<div class="modal fade" id="skyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="sky_label">Vote BDE</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p>Ce vote est définitif, êtes-vous sûr?</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
		        <input type="hidden" name='vote' value="sky">
		        <input type="submit" class="btn btn-primary" value="Je vote SKY!">
		      </div>
		    </div>
	  </div>
	</div>
</form>
<form action="a_voter.php" method="post">	
	<div class="modal fade" id="blancModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
		    <div class="modal-content">
		      <div class="modal-header">
		        <h5 class="modal-title" id="blanc_label">Vote BDE</h5>
		        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		          <span aria-hidden="true">&times;</span>
		        </button>
		      </div>
		      <div class="modal-body">
		        <p>Ce vote est définitif, êtes-vous sûr?</p>
		      </div>
		      <div class="modal-footer">
		        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
		        <input type="hidden" name='vote' value="blanc">
		        <input type="submit" class="btn btn-light" value="Je vote blanc">
		      </div>
		    </div>
	  </div>
	</div>
</form>