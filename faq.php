<?php
  require_once 'includes/_header.php';
  $Auth->allow('member');
  $title_for_layout = 'FAQ';
  include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
?>

<h1 class="page-header">FAQ</h1>
<p>Cette section va vous tenter de répondre aux questions que vous pourriez avoir.</p>


<?php include 'includes/footer.php';?>