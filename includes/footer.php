  <hr>

<footer class="footer">
  <p class="clearfix">
      &copy;2018, PayIcam
      <a class="float-right" href="#">Retour en haut</a>
  </p>
</footer>
</div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <!-- <script type="text/javascript" href="https://popper.js.org"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  
    <script src="js/bootstrap.min.js"></script>
    <script src="js/countdown.js"></script> <!-- debut compteur -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
    <script src="js/flipclock.js"></script> <!-- fin compteur -->

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