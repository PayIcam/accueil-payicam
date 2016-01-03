<?php
  require_once 'includes/_header.php';
  $Auth->allow('member');
  $title_for_layout = 'A propos';
  include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
?>

<h1 class="page-header">A propos</h1>
<p>Ceci est une page pour présenter le projet PayIcam </p>

<?php include 'includes/footer.php';?>