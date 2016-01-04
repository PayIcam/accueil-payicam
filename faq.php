<?php
  require_once 'includes/_header.php';
  $Auth->allow('member');
  $title_for_layout = 'FAQ';
  include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
?>

<script type="text/javascript">
$(document).ready(function() {
  // Masquage des réponses par défault
  $("dd").hide();
  // le cursor = le pointeur
  $("dt").css("cursor", "pointer");
  // Clic sur la question
  $("dt").click(function() {
    // Actions uniquement si la réponse n'est pas déjà visible
    if($(this).next().is(":visible") == false) {
      // Masquage des réponses
      $("dd").slideUp();
      // Affichage de la réponse 
      $(this).next().slideDown();
    }
    else {$(this).next().slideUp();} // Referme si c'ets ouvert
  });
});
</script>

<script type="text/javascript">
$(document).ready(function() {
  $("wd").hide();
  $("wt").css("cursor", "pointer");
  $("wt").click(function() {
    if($(this).next().is(":visible") == false) {
      $("wd").slideUp();
      $(this).next().slideDown();
    }
    else {$(this).next().slideUp();}
  });
});
</script>


<h1 class="page-header">Foire Aux Questions</h1>
<p>Cette section va tenter de vous répondre aux questions que vous pourriez avoir : </p>

<center>
<wt><h3>Questions générales</h3></wt>
<wd><ul>

  <dt>Question 1</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 2</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 3</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 4</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 5</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 6</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 7</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 8</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 9</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 10</dt>
  <dd>Répense à la question !</dd>

</ul></wd>

<wt><h3>Casper</h3></wt>
<wd><ul>

  <dt>Question 1</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 2</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 3</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 4</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 5</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 6</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 7</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 8</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 9</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 10</dt>
  <dd>Répense à la question !</dd>

</ul></wd>

<wt><h3>Shotgun</h3></wt>
<wd><ul>

  <dt>Question 1</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 2</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 3</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 4</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 5</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 6</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 7</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 8</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 9</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 10</dt>
  <dd>Répense à la question !</dd>

</ul></wd>



<?php if ($Auth->hasRole('admin')): // uniquement pour les admin et super-admin 
?> 
<h2>Pour les administrateurs</h2>

<wt><h3>Scoobydoo</h3></wt>
<wd><ul>

  <dt>Question 1</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 2</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 3</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 4</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 5</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 6</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 7</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 8</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 9</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 10</dt>
  <dd>Répense à la question !</dd>

</ul></wd>

<wt><h3>Shotgun</h3></wt>
<wd><ul>

  <dt>Question 1</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 2</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 3</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 4</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 5</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 6</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 7</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 8</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 9</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 10</dt>
  <dd>Répense à la question !</dd>

</ul></wd>

<wt><h3>Mozart</h3></wt>
<wd><ul>

  <dt>Question 1</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 2</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 3</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 4</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 5</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 6</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 7</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 8</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 9</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 10</dt>
  <dd>Répense à la question !</dd>

</ul></wd>

<?php endif ?>

<?php if ($Auth->hasRole('super-admin')): // uniquement pour les admin et super-admin 
 ?>
<h2>Pour les super-administrateurs</h2>

<wt><h3>Scoobydoo</h3></wt>
<wd><ul>

  <dt>Question 1</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 2</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 3</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 4</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 5</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 6</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 7</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 8</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 9</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 10</dt>
  <dd>Répense à la question !</dd>

</ul></wd>

<wt><h3>Admin_Ginger</h3></wt>
<wd><ul>

  <dt>Question 1</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 2</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 3</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 4</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 5</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 6</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 7</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 8</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 9</dt>
  <dd>Répense à la question !</dd>
  <dt>Question 10</dt>
  <dd>Répense à la question !</dd>

</ul></wd>

<?php endif ?>
</center>


<?php include 'includes/footer.php';?>