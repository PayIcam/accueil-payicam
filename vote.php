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
	if ($my_vote[0] != ''){
		Functions::setFlash("T'as déjà voté petit con",'danger');
    	header('Location:index.php');
	}

	// si on est pas dans la période de vote, être recalé
	// si on est après la période de vote, afficher le résultat !?? (une heure après ?)
	// si il a déjà voté lui afficher son vote !
	// si il n'a pas voté, option


	$title_for_layout = 'Election BDE';
	include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation

?>


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