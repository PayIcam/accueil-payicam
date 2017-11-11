<?php
  require_once 'includes/_header.php';

  $title_for_layout = 'Dev';
  include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
?>
<p><?php var_dump($_SESSION) ?></p>
<?php include 'includes/footer.php';?>