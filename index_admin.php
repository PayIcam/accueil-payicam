<?php
require_once 'includes/_header.php';

$Auth->allow('super-admin');
$user = $Auth->getUser();
require_once ROOT_PATH.'class/DB.php';
include('config.php');
$title_for_layout = 'Accueil';
include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
$confSQL = $_CONFIG['conf_accueil'];

  try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
    }

    // Récupération des infos pour les slides depuis la bdd
    for ($i = 1; $i<4; $i++){
      $requete_slides = $DB->prepare("SELECT slide_image, slide_message FROM payicam_accueil_slide WHERE slide_id='$i'");
      $requete_slides -> execute();
      ${'data_slide'.$i} = $requete_slides->fetch();
    }

    // Récupération des infos pour les cartes depuis la bdd
    for ($i = 1; $i<5; $i++){
      $requete_cartes = $DB->prepare("SELECT carte_titre, carte_description, carte_activation_bouton,
        carte_bouton,carte_photo FROM payicam_carte WHERE carte_id='$i'");
      $requete_cartes -> execute();
      ${'data_carte'.$i} = $requete_cartes->fetch();
    }
  ?>  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>


<div class="container">   <!-- Container 1-->
  <FORM method="POST" action="index_admin.php" enctype="multipart/form-data" > <!-- debut du formulaire de modif admin de toute la page-->
    <div class="card-deck">   <!-- CARD-DECK 1-->
      <div class="row" >      <!-- Ligne de 3 cartes slides-->

    <div class="card border-dark" style="margin-bottom: 10px" >
      <img class="card-img-top" style="max-height: 150px;"  src="img/<?php echo $data_slide1[0] ; ?>" alt="Card image cap">
      <div class="card-body">
        <h4 class="card-title"><center>Slide 1</center></h4>
         <input class="btn btn-primary" type="file" name="input_image_slide1" >
      </div>
<!--  <div class="card-footer bg-transparent">
      </div> -->
    </div>

    <div class="card border-dark" style="margin-bottom: 10px">
      <img class="card-img-top" class="img-fluid" style="max-height: 150px;" src="img/<?php echo $data_slide2[0] ; ?>" alt="Card image cap">
      <div class="card-body ">
        <h4 class="card-title"><center>Slide 2</center></h4>
         <input class="btn btn-primary" type="file" name="input_image_slide2" >
      </div>
 <!--      <div class="card-footer bg-transparent">
      </div> -->
    </div>

    <div class="card border-dark" style="margin-bottom: 10px">
      <img class="card-img-top" class="img-fluid" style="max-height: 150px;" src="img/<?php echo $data_slide3[0] ; ?>" alt="Card image cap">
      <div class="card-body ">
        <h4 class="card-title"><center>Slide 3</center></h4>
         <input class="btn btn-primary" type="file" name="input_image_slide3" >
      </div>
<!--  <div class="card-footer bg-transparent">
      </div> -->
    </div>


      </div>   <!-- Ligne de 3 cartes slides-->
    </div>    <!-- /CARD-DECK 1-->
</div>    <!-- /Container 1 -->

<div class="container">   <!-- Container 2 -->
  <DIV class="card-deck">   <!-- CARD-DECK 2-->
  	<div class="row" >       <!-- Ligne de 4 cartes publiques-->

		<div class="card border-dark" style="margin-bottom: 10px">
      <img class="card-img-top" class='img-fluid'  src='img/<?php echo $data_carte1[4] ; ?>' alt="Card image cap" style="max-height: 150px;">
      <div class="card-body">
        <input class="btn btn-primary" type="file" name="input_image_carte1" style="font-size:10px;margin-bottom: 10px" >
        <h4 class="card-title"><input class="form-control" name= "maj_titre1" autofocus  value="<?php echo $data_carte1[0];?>" rows="1"></h4>
        <p class="card-text"> <textarea class="form-control" name= "maj_description1" autofocus  placeholder="<?php echo $data_carte1[1];?>" rows="6"></textarea></p> 
      </div>
      <div class="card-footer bg-transparent">
        <div class="col md-4">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="carte1_bouton" value="on"  > Activer le bouton 
                      </label>
                  </div>
        </div>
                  <div class="col md-4">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="carte1_bouton" value="off"><span style="font-size: 15px"> Désactiver le bouton</span> 
                      </label>
                  </div>
                  </div>
        <a class="btn btn-primary" >
        <input class="form-control" name= "maj_nom_bouton1" autofocus value="<?php echo $data_carte1[3]?>" >
        </a>
      </div>
    </div>  <!-- /card border-dark 1 -->

		<div class="card border-dark" style="margin-bottom: 10px">
      <img class="card-img-top" class='img-fluid'  src='img/<?php echo $data_carte2[4] ; ?>' alt="Card image cap" style="max-height: 150px;">
      <div class="card-body">
        <input class="btn btn-primary" type="file" name="input_image_carte2" style="font-size:10px;margin-bottom: 10px" >
        <h4 class="card-title"><input class="form-control" name= "maj_titre2" autofocus  value="<?php echo $data_carte2[0];?>" rows="1"></h4>
        <p class="card-text"> <textarea class="form-control" name= "maj_description2" autofocus  placeholder="<?php echo $data_carte2[1];?>" rows="6"></textarea></p> 
      </div>
      <div class="card-footer bg-transparent">
        <div class="col md-4">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="carte2_bouton" value="on"  > Activer le bouton 
                      </label>
                  </div>
        </div>
                  <div class="col md-4">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="carte2_bouton" value="off"> Désactiver le bouton 
                      </label>
                  </div>
                  </div>
        <a class="btn btn-primary" >
        <input class="form-control" name= "maj_nom_bouton2" autofocus value="<?php echo $data_carte2[3]?>" >
        </a>
      </div>
    </div>  <!-- /card border-dark 2 -->

		<div class="card border-dark" style="margin-bottom: 10px">
			<img class="card-img-top" class='img-fluid'  src='img/<?php echo $data_carte3[4] ; ?>' alt="Card image cap">
			<div class="card-body">
        <input class="btn btn-primary" type="file" name="input_image_carte3" style="font-size:10px;margin-bottom: 10px" >
				<h4 class="card-title"><input class="form-control" name= "maj_titre3" autofocus  value="<?php echo $data_carte3[0];?>" rows="1"></h4>
				<p class="card-text"> <textarea class="form-control" name= "maj_description3" autofocus  placeholder="<?php echo $data_carte3[1];?>" rows="3"></textarea></p> 
			</div>
			<div class="card-footer bg-transparent">
				<div class="col md-4">
                	<div class="form-check">
                  		<label class="form-check-label">
                    		<input class="form-check-input" type="radio" name="carte3_bouton" value="on"  > Activer le bouton 
                  		</label>
                	</div>
        </div>
                 	<div class="col md-4">
                	<div class="form-check">
                  		<label class="form-check-label">
                    		<input class="form-check-input" type="radio" name="carte3_bouton" value="off"> Désactiver le bouton 
                  		</label>
                	</div>
              	  </div>
				<a class="btn btn-primary" >
				<input class="form-control" name= "maj_nom_bouton3" autofocus value="<?php echo $data_carte3[3]?>" >
				</a>
			</div>
		</div>  <!-- /card border-dark 3 -->

		<div class="card border-dark" style="margin-bottom: 10px">
      <img class="card-img-top" class='img-fluid'  src='img/<?php echo $data_carte4[4] ; ?>' alt="Card image cap">
      <div class="card-body">
        <input class="btn btn-primary" type="file" name="input_image_carte4" style="font-size:10px;margin-bottom: 10px" >
        <h4 class="card-title"><input class="form-control" name= "maj_titre4" autofocus  value="<?php echo $data_carte4[0];?>" rows="1"></h4>
        <p class="card-text"> <textarea class="form-control" name= "maj_description4" autofocus  placeholder="<?php echo $data_carte4[1];?>" rows="3"></textarea></p> 
      </div>
      <div class="card-footer bg-transparent">
        <div class="col md-4">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="carte4_bouton" value="on"  > Activer le bouton 
                      </label>
                  </div>
        </div>
                  <div class="col md-4">
                  <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="radio" name="carte4_bouton" value="off"> Désactiver le bouton 
                      </label>
                  </div>
                  </div>
        <a class="btn btn-primary" >
        <input class="form-control" name= "maj_nom_bouton4" autofocus value="<?php echo $data_carte4[3]?>" >
        </a>
      </div>
    </div>  <!-- /card border-dark 4 -->
    </div>    <!-- /Ligne de 4 cartes publiques-->

    
    <div class="container " style="width: auto">    <!-- boutons d'envoi du formulaire -->
      <div class="card border-dark">
	       <div class="card-body">
            <button  style='text-align:center' class="btn btn-primary btn-lg" role="button" type=submit > Enregistrer</button>
            <button  style='text-align:center' class="btn btn-primary btn-lg" onclick="window.location.replace('index.php')">Annuler</button>
         </div>
      </div>
    </div>    <!-- /boutons d'envoi du formulaire -->

</DIV> <!-- /CARD-DECK 2 -->
</FORM>

<!-- <?php
echo $data_carte1[0];
?> -->

<footer class="footer">
  <p class="clearfix">
      &copy;2017, PayIcam, page réalisée par Hugo R. <em>119</em>
      <a class="float-right" href="#">Retour en haut</a>
  </p>
</footer>

<?php include 'includes/footer.php';

// upload de nouvelles images de slides
upload_image_slide('input_image_slide1','img/',1);
upload_image_slide('input_image_slide2','img/',2);
upload_image_slide('input_image_slide3','img/',3);

// upload de nouvelles images pour les cartes
upload_image_carte('input_image_carte1','img/',1);
upload_image_carte('input_image_carte2','img/',2);
upload_image_carte('input_image_carte3','img/',3);
upload_image_carte('input_image_carte4','img/',4);

// Prise en compte de modifs dans les input sinon appel des anciennes donnees de la bdd
for($i = 1; $i<5; $i++){
    if( !empty($_POST['maj_titre'.$i]) ){

      ${'maj_titre'.$i} = htmlentities($_POST['maj_titre'.$i], ENT_QUOTES); 
    }
    
    else { 
      ${'maj_titre'.$i} = ${'data_carte'.$i}[0]; 
    }

    if ( !empty($_POST['maj_description'.$i] ) ) {
      ${'maj_description'.$i} = htmlentities($_POST['maj_description'.$i], ENT_QUOTES); 
    }
    else { 
      ${'maj_description'.$i} = ${'data_carte'.$i}[1]; 
    }

    if ( !empty($_POST['carte'.$i.'_bouton']) and $_POST['carte'.$i.'_bouton']=="on" ){ 
      ${'carte'.$i.'_activation_bouton'}='1';
    }
    elseif( !empty($_POST['carte'.$i.'_bouton']) and $_POST['carte'.$i.'_bouton']=="off"){ 
      ${'carte'.$i.'_activation_bouton'}='0'; 
    }
    else {
      ${'carte'.$i.'_activation_bouton'}=${'data_carte'.$i}[2]; 
    }

    if ( !empty($_POST['maj_nom_bouton'.$i]) ) {
      ${'maj_nom_bouton'.$i}=htmlentities($_POST['maj_nom_bouton'.$i], ENT_QUOTES);
    }
    else{ 
      ${'maj_nom_bouton'.$i}=${'data_carte'.$i}[3]; 
    }
  }

  // Update des nouvelles infos modifiees dans la bdd
  for ($i = 1; $i<5; $i++){
      $requete_update_cartes = $DB->prepare("UPDATE payicam_carte SET carte_titre='${'maj_titre'.$i}',
    carte_description='${'maj_description'.$i}', carte_activation_bouton='${'carte'.$i.'_activation_bouton'}', 
    carte_bouton='${'maj_nom_bouton'.$i}' WHERE carte_id='$i'");
      $requete_update_cartes -> execute();
    }

////////////////////////////////////// Fonctions pour l'upload d'images 

function upload_image_slide($image,$dossier,$num_slide){ // fonction d'import d'image pour les slides avec sauvegarde du nom du fichier dans la bdd
 include('config.php');
 $confSQL = $_CONFIG['conf_accueil'];
 try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
    }
 
  $extensions = array('.png','.PNG', '.gif','.GIF', '.jpg','.JPG', '.jpeg','.JPEG'); // extensions de fichiers acceptees
  
    if(isset($_FILES[$image]) ){ 
      $extension = strrchr($_FILES[$image]['name'], '.');   // extension du fichier en cours d'upload

  if(!in_array($extension, $extensions))
   //Si l'extension n'est pas dans le tableau
    {
         $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
    }

  if(!isset($erreur)){

           $fichier = basename($_FILES[$image]['name']);
           $fichier = strtr($fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
           $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
           
           if(move_uploaded_file($_FILES[$image]['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
             {
                  echo 'Upload effectué avec succès !';
                  echo $fichier;
                  $requete_update_slide = $DB->prepare("UPDATE payicam_accueil_slide SET slide_image='$fichier' WHERE slide_id='$num_slide'");
                  $requete_update_slide -> execute();

             }
           else //Sinon (la fonction renvoie FALSE).
           {
                echo 'Echec de l\'upload !';
           }
      
  }
  else{
    echo $erreur;
  }
}
else{
  die();
}
}

function upload_image_carte($image,$dossier,$num_carte){ // fonction d'import d'image pour les evenements avec sauvegarde du nom du fichier dans la bdd
 include('config.php');
 $confSQL = $_CONFIG['conf_sql_vote'];
 try{
    $DB = new PDO('mysql:host='.$confSQL['sql_host'].';dbname='.$confSQL['sql_db'].';charset=utf8',$confSQL['sql_user'],$confSQL['sql_pass'],array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION ));
    } catch(Exeption $e) {
    die('erreur:'.$e->getMessage());
    }

    $extensions = array('.png','.PNG', '.gif','.GIF', '.jpg','.JPG', '.jpeg','.JPEG'); // extensions de fichiers acceptees
    
    if(isset($_FILES[$image]))
      { 
        $extension = strrchr($_FILES[$image]['name'], '.');   // extension du fichier en cours d'upload

  if(!in_array($extension, $extensions))
   //Si l'extension n'est pas dans le tableau
    {
         $erreur = 'Vous devez uploader un fichier de type png, gif, jpg ou jpeg...';
    }

  if(!isset($erreur))
  {

           $fichier = basename($_FILES[$image]['name']);
           $fichier = strtr($fichier,
            'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
            'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
           $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier);
           
           if(move_uploaded_file($_FILES[$image]['tmp_name'], $dossier . $fichier)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
             {
                  echo 'Upload effectué avec succès !';
                  echo $fichier;
                  $requete_update_slide = $DB->prepare("UPDATE payicam_carte SET carte_photo='$fichier' WHERE carte_id='$num_carte'");
                  $requete_update_slide -> execute();

             }
           else //Sinon (la fonction renvoie FALSE).
           {
                echo 'Echec de l\'upload !';
           }
      
  }

  else{
    echo $erreur;
  }
}
else{
  exit();
}
}
//////////////////////////////////////////////////////////////////////////////////////////
?>













