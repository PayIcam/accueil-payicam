<?php
  require_once 'includes/_header.php';
    $Auth->allow('member');
  $title_for_layout = 'Accueil';
  include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation

?>

<div class="jumbotron">
  <h1>Bienvenue sur PayIcam !</h1>
  <p>Ceci est la page d'accueil de payicam, vous pouvez choisir l'application que vous souhaitez utiliser </p>
  <button type="button" class="btn btn-default" aria-label="Left Align">
    <span class="glyphicon glyphicon-envelope"></span>
    <a href="https://webmail.icam.fr/webmail/" target="_blank">Mail Icam</a>
  </button>
  <button type="button" class="btn btn-default" aria-label="Left Align">
    <span class="glyphicon glyphicon-calendar"></span>
    <a href="http://icam-ecap.capvalley.fr/" target="_blank">Planning Ecap Valley</a>
  </button>
  <button type="button" class="btn btn-default" aria-label="Left Align">
    <span class="glyphicon glyphicon-lock"></span>
    <a href="https://mail2.icam.fr/password/" target="_blank">Mot de passe ICAM</a>
  </button>
  <button type="button" class="btn btn-default" aria-label="Left Align">
    <span class="glyphicon glyphicon-file"></span>
    <a href="https://portfolio.icam.fr/" target="_blank">Portfolio Icam</a>
  <button type="button" class="btn btn-default" aria-label="Left Align">
    <span class="glyphicon glyphicon-folder-open"></span>
    <a href="https://moodle.icam.fr/" target="_blank">Moodle Icam</a>
  </button>
</div>
<div class="row">
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-8">
        <h3>Rechargement</h3>
        <p>Le rechargement se fait via Casper, l'interface web pour la gestion de son compte personnel </p>
        <p><a class="btn btn-primary" href="../casper" target="_blank" role="button">Casper &raquo;</a></p>
      </div>
      <div class="col-sm-4"><img class="img-responsive" style="margin-top: 30px;max-height: 150px;" src="img/gold_card.png"/></p></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-8">
        <h3>Billeterie</h3>
        <p>La billeterie de l'Icam, si vous souhaitez acheter des places ou des goodies, shotgun est l'interface de vente en ligne!</p>
        <p><a class="btn btn-primary" href="../shotgun" target="_blank" role="button">Shotgun &raquo;</a></p>
      </div>
      <div class="col-sm-4"><img class="img-responsive" style="margin-top: 30px;max-height: 150px;" src="img/tickets.png"/></p></p></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-8">
        <h3>Associations</h3>
        <p>Site du BDE et autres </p>
        <p><a class="btn btn-info" href="http://bde.icam.fr/" target="_blank" role="button">Assos &raquo;</a></p>
      </div>
      <div class="col-sm-4"><img class="img-responsive" style="margin-top: 30px;max-height: 150px;" src="img/wave.png"/></p></div>
    </div>
  </div>
  <div class="col-md-6">
    <div class="row">
      <div class="col-sm-8">
        <h3>Les évènements de l'Icam</h3>
        <p>Vous pouvez désormais réserver en ligne grâce à PayIcam votre place pour le Gala !<br> Vous pouvez aussi juste voir le statut de votre réservation déjà effectuée.</p>
        <p><a class="btn btn-info" href="../inscription_galadesicam" role="button">Inscriptions au Gala des Icam &raquo;</a></p>
      </div>
      <div class="col-sm-4"><img class="img-responsive" style="margin-top: 30px;max-height: 150px;" src="img/gala.png"/></p></div>
    </div>
  </div>
</div><!--/row-->


<?php if ($Auth->hasRole('admin')): ?>
  <h2 class="page-header">Liens vers l'Administration</h2>
  <div class="row">
    <div class="col-md-4">
      <h3>Admin PayIcam</h3>
      <p>Application web permettant entre autre la gestion des articles, la gestion des droits, la trésorerie, ...</p>
      <p><a class="btn btn-primary" href="../scoobydoo" target="_blank" role="button">Scoobydoo &raquo;</a>
    </div>
    <?php if ($Auth->hasRole('super-admin')): ?>
    <div class="col-md-4">
      <h3>Gestion des données des élèves</h3>
      <p>Cette interface permet la gestion par exemple de l'affectation des identifiants cartes étudiantes aux élèves.</p>
      <p><a class="btn btn-primary" href="../admin_ginger" target="_blank" role="button">Admin Ginger &raquo;</a>
    </div>
    <?php endif ?>
    <div class="col-md-4">
      <h3>Vente par caisse physique</h3>
      <p>Application web de ventre des articles comme au Bar ou la cafet avec une caisse et une badgeuse.</p>
      <p><a class="btn btn-primary" href="../mozart" target="_blank" role="button">Mozart &raquo;</a>
    </div>
    <div class="col-md-4">
      <h3>Admin ventes en ligne</h3>
      <p>Administration des ventes d'articles en ligne, celle de shotgun.</p>
      <p><a class="btn btn-primary" href="../shotgun/admin" target="_blank" role="button">Shotgun &raquo;</a>
    </div>
  </div>
<?php endif ?>

<?php include 'includes/footer.php';?>