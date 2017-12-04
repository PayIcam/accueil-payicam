  <hr>

  <footer class="footer">
      <p class="clearfix">
          &copy;2017, PayIcam, Accueil réalisée par Hugo R. <em>119</em>
          <a class="float-right" href="#">Retour en haut</a>
      </p>
  </footer>

</div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    
    <?php if (!empty($js_for_layout)): ?>
      <?php foreach ($js_for_layout as $v):?>
        <?php if (file_exists('js/'.$v.'.js')){ ?>
          <script src="js/<?= $v; ?>.js"></script>
        <?php }elseif(file_exists('js/'.$v)){ ?>
          <script src="js/<?= $v; ?>"></script>
        <?php }elseif(false !== strpos($v, '<script type="text/javascript">')){ ?>
            <?= $v ?>
        <?php }else{ ?>
          <script type="text/javascript">

          </script>
        <?php } ?>
      <?php endforeach ?>
    <?php endif ?>
  </body>
</html>