
<?php 
  require_once 'includes/_header.php';
    $Auth->allow('member');
  include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
  include('config.php');
	$ConnexionBD = mysqli_connect($confSQL['sql_host'], $confSQL['sql_user'], $confSQL['sql_pass'], $confSQL['sql_db']);
  $Resultat1 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=1");
  $Resultat2 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=2");
  $Resultat3 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=3");
  $Resultat4 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=4");
  $Resultat5 = mysqli_query($ConnexionBD, "SELECT accueil_titre, accueil_message FROM payicam_accueil WHERE accueil_id=5");

  $data_baniere = mysqli_fetch_array($Resultat1);
  $data_slide1 = mysqli_fetch_array($Resultat2);
  $data_slide2 = mysqli_fetch_array($Resultat3);
  $data_slide3 = mysqli_fetch_array($Resultat4);
  $data_slide4 = mysqli_fetch_array($Resultat5);
?>


<div class="container"> <!-- ferme dans le footer-->
<DIV class='jumbotron ' id="#">

 <fieldset style='margin-left: 50px;'>    <!-- Formulaire pour mettre à jour le titre et le message d'accueil de payicam sur index.html -->
   <legend><h3><u> Modifier le message d'accueil : </u></h3></legend>  
     <FORM method="POST" action="accueil_admin.php" enctype="multipart/form-data" onSubmit="envoi()">   <!-- le formulaire global commence ici et se termine en bas de la page --> 
       <div class="form-group">
          <label for="maj_titre"><h5> Titre d'accueil : </h5></label><br/>
          <textarea class="form-control" name= "maj_titre" id="maj_titre"  autofocus placeholder="<?php echo $data_baniere[0];?>" rows="1"></textarea> <br/>       
          <label for="maj_message"><h5> Message d'accueil : </h5></label><br/>
          <textarea class="form-control" name= "maj_message" id="maj_message"  autofocus placeholder="<?php echo $data_baniere[1];?>" rows="3"></textarea>
       </div>
       
       <legend><h3><u> Modifier le Carousel : </u></h3></legend>
       <div class="row" >
         <div class="col-lg">
           <label><h5><b> Photo 1 </b></h5></label><br/>
           <div class="form-group">
              <label for="maj_titre_slide1"><h5> Titre : </h5></label><br/>
              <textarea class="form-control" name= "maj_titre_slide1" id="maj_titre_slide1"  autofocus placeholder="<?php echo $data_slide1[0];?>" rows="1"></textarea> <br/>       
              <label for="maj_message_slide1"><h5> Message : </h5></label><br/>
              <textarea class="form-control" name= "maj_message_slide1" id="maj_message_slide1"  autofocus placeholder="<?php echo $data_slide1[1];?>" rows="3"></textarea>
           </div>
          </div>
           <div class="col-lg">
           <label><h5><b> Photo 2 </b></h5></label><br/>
           <div class="form-group">
              <label for="maj_titre_slide2"><h5> Titre : </h5></label><br/>
              <textarea class="form-control" name= "maj_titre_slide2" id="maj_titre_slide2"  autofocus placeholder="<?php echo $data_slide2[0];?>" rows="1"></textarea> <br/>       
              <label for="maj_message_slide2"><h5> Message : </h5></label><br/>
              <textarea class="form-control" name= "maj_message_slide2" id="maj_message_slide2"  autofocus placeholder="<?php echo $data_slide2[1];?>" rows="3"></textarea>
           </div>
          </div>
        </div>
        <div class="row" >
         <div class="col-lg">
           <label><h5><b> Photo 3 </b></h5></label><br/>
           <div class="form-group">
              <label for="maj_titre_slide3"><h5> Titre : </h5></label><br/>
              <textarea class="form-control" name= "maj_titre_slide3" id="maj_titre_slide3"  autofocus placeholder="<?php echo $data_slide3[0];?>" rows="1"></textarea> <br/>       
              <label for="maj_message_slide3"><h5> Message : </h5></label><br/>
              <textarea class="form-control" name= "maj_message_slide3" id="maj_message_slide3"  autofocus placeholder="<?php echo $data_slide3[1];?>" rows="3"></textarea>
           </div>
          </div>
           <div class="col-lg">
           <label><h5><b> Photo 4 </b></h5></label><br/>
           <div class="form-group">
              <label for="maj_titre_slide4"><h5> Titre : </h5></label><br/>
              <textarea class="form-control" name= "maj_titre_slide4" id="maj_titre_slide4"  autofocus placeholder="<?php echo $data_slide4[0];?>" rows="1"></textarea> <br/>       
              <label for="maj_message_slide4"><h5> Message : </h5></label><br/>
              <textarea class="form-control" name= "maj_message_slide4" id="maj_message_slide4"  autofocus placeholder="<?php echo $data_slide4[1];?>" rows="3"></textarea>
           </div>
          </div>
        </div>

 </fieldset><br/>
     
<?php
// BANDEAU ACCUEIL

// on récupère le titre d'accueil depuis le form s'il y en a un nouveau
if (!empty($_POST['maj_titre'])){  $maj_titre = htmlentities($_POST['maj_titre'], ENT_QUOTES); }    
// saisi sinon on garde l'ancien de la bdd
else {  $maj_titre = $data_baniere[0]; }                                                    

// de même avec le message d'accueil
if (!empty($_POST['maj_message'])){ $maj_message = htmlentities($_POST['maj_message'], ENT_QUOTES);}   
else { $maj_message = $data_baniere[1]; }

// SLIDE 1

if (!empty($_POST['maj_titre_slide1'])){  $maj_titre_slide1 = htmlentities($_POST['maj_titre_slide1'], ENT_QUOTES); }    
else {  $maj_titre_slide1 = $data_slide1[0]; }                                                    

if (!empty($_POST['maj_message_slide1'])){ $maj_message_slide1 = htmlentities($_POST['maj_message_slide1'], ENT_QUOTES);}  
else { $maj_message_slide1 = $data_slide1[1]; }

// SLIDE 2

if (!empty($_POST['maj_titre_slide2'])){  $maj_titre_slide2 = htmlentities($_POST['maj_titre_slide2'], ENT_QUOTES); }    
else {  $maj_titre_slide2 = $data_slide2[0]; }                                                    

if (!empty($_POST['maj_message_slide2'])){ $maj_message_slide2 = htmlentities($_POST['maj_message_slide2'], ENT_QUOTES);}  
else { $maj_message_slide2 = $data_slide2[1]; }

// SLIDE 3

if (!empty($_POST['maj_titre_slide3'])){  $maj_titre_slide3 = htmlentities($_POST['maj_titre_slide3'], ENT_QUOTES); }    
else {  $maj_titre_slide3 = $data_slide3[0]; }                                                    

if (!empty($_POST['maj_message_slide3'])){ $maj_message_slide3 = htmlentities($_POST['maj_message_slide3'], ENT_QUOTES);}  
else { $maj_message_slide3 = $data_slide3[1]; }

// SLIDE 4

if (!empty($_POST['maj_titre_slide4'])){  $maj_titre_slide4 = htmlentities($_POST['maj_titre_slide4'], ENT_QUOTES); }    
else {  $maj_titre_slide4 = $data_slide4[0]; }                                                    

if (!empty($_POST['maj_message_slide4'])){ $maj_message_slide4 = htmlentities($_POST['maj_message_slide4'], ENT_QUOTES);}  
else { $maj_message_slide4 = $data_slide4[1]; }



  
  $Requete_update_accueil= "UPDATE payicam_accueil SET accueil_titre='$maj_titre', accueil_message='$maj_message' WHERE accueil_id='1'";   // requete pour mettre a jour les infos titre et message d'accueil
  $Requete_update_accueil_slide1= "UPDATE payicam_accueil SET accueil_titre='$maj_titre_slide1', accueil_message='$maj_message_slide1' WHERE accueil_id='2'";   // 
  $Requete_update_accueil_slide2= "UPDATE payicam_accueil SET accueil_titre='$maj_titre_slide2', accueil_message='$maj_message_slide2' WHERE accueil_id='3'";
  $Requete_update_accueil_slide3= "UPDATE payicam_accueil SET accueil_titre='$maj_titre_slide3', accueil_message='$maj_message_slide3' WHERE accueil_id='4'";
  $Requete_update_accueil_slide4= "UPDATE payicam_accueil SET accueil_titre='$maj_titre_slide4', accueil_message='$maj_message_slide4' WHERE accueil_id='5'";

  // $ConnexionBD = mysqli_connect($bdd_url, $bdd_login, $bdd_password, $bdd_database);
  $Update1= mysqli_query($ConnexionBD,$Requete_update_accueil);
  $Update2= mysqli_query($ConnexionBD,$Requete_update_accueil_slide1);
  $Update3= mysqli_query($ConnexionBD,$Requete_update_accueil_slide2);
  $Update4= mysqli_query($ConnexionBD,$Requete_update_accueil_slide3);
  $Update5= mysqli_query($ConnexionBD,$Requete_update_accueil_slide4);

?> 
<?php                       // préparation de la connection et selection des données de l'évènement 1 actuel
 // $ConnexionBD = mysqli_connect($bdd_url, $bdd_login, $bdd_password, $bdd_database);
 $Resultat6 = mysqli_query($ConnexionBD, "SELECT evenement_titre, evenement_description, evenement_bouton, evenement_activation_bouton,evenement_afficher_cacher FROM payicam_evenement WHERE evenement_id='1'");
 $data_accueil_evenement1 = mysqli_fetch_array ($Resultat6)
?>

 <fieldset style='margin-left: 50px;'> 
 <legend><h3><u> Modifier un évènement : </u></h3></legend>
 </fieldset>

<DIV class="container">
<div class="row" >
  <div class="col-lg">                         <!-- Début du formulaire de mise à jour de l'évènement 1 -->
      <fieldset style='margin-left: 50px;'>
      <label><h5><b> Evènement 1 </b></h5></label><br/>
            <div class="form-group">
              <label for="maj_titre1"><h5> Titre évènement 1 : </h5></label><br/>
              <textarea class="form-control" name= "maj_titre1" id="maj_titre1"  autofocus  placeholder="<?php echo $data_accueil_evenement1[0];?>" rows="1"></textarea>
            </div>
            <div class="form-group">
              <label for="maj_description1"><h5> Description évènement 1 : </h5> </label><br/>
              <textarea class="form-control" name= "maj_description1" id="maj_description1"  autofocus  placeholder="<?php echo $data_accueil_evenement1[1];?>" rows="3"></textarea>
            </div>

            <div class="row">        
              <div class="col md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="evenement1_bouton" value="on"  > Activer le bouton 
                  </label>
                </div>
              </div>
              
              <div class="col md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="evenement1_bouton" value="off"> Désactiver le bouton 
                  </label>
                </div>
              </div>

              <div class="col md-4">          
                <div class="form-group">
                  <label for="maj_nom_bouton1"> Nom bouton évènement 1 :</label>
                  <input class="form-control" name= "maj_nom_bouton1" id="maj_nom_bouton1" autofocus placeholder="<?php echo $data_accueil_evenement1[2];?>">
                </div>
              </div>
            </div>
            
           <!--  <div class="form-group">
              <label for="photo1">Example file input</label>
               
              <input type="file" name="evenement1_photo" class="form-control-file" id="photo1">
            </div> -->
      
      </fieldset>
  </div>                          <!-- Fin du formulaire de mise à jour de l'évènement 1 -->

<?php
// if ((isset($_FILES["evenement1_photo"]['temp_name'])&&($_FILES["evenement1_photo"]['error'] == UPLOAD_ERR_OK))) {     
// $chemin_destination = '../img/';     
// move_uploaded_file($_FILES["evenement1_photo"]['tmp_name'], $chemin_destination.$_FILES["evenement1_photo"]['name']);     
// }     

// Vérification de saisie et préparation des données pour la mise a jour des infos de l'évènement 1
if (!empty($_POST['evenement1_afficher_cacher']) and $_POST['evenement1_afficher_cacher']=="on" ){ $evenement1_afficher_cacher='1';}    
elseif(!empty($_POST['evenement1_afficher_cacher']) and $_POST['evenement1_afficher_cacher']=="off"){ $evenement1_afficher_cacher='0'; }
else {$evenement1_afficher_cacher=$data_accueil_evenement1[4]; }

if (!empty($_POST['evenement1_bouton']) and $_POST['evenement1_bouton']=="on" ){ $evenement1_activation_bouton='1';}
elseif(!empty($_POST['evenement1_bouton']) and $_POST['evenement1_bouton']=="off"){ $evenement1_activation_bouton='0'; }
else {$evenement1_activation_bouton=$data_accueil_evenement1[3]; }

if(!empty($_POST['maj_titre1']) ){ $maj_titre1 = htmlentities($_POST['maj_titre1'], ENT_QUOTES); }
else {  $maj_titre1 = $data_accueil_evenement1[0]; }

if ( !empty($_POST['maj_description1'])) { 
  $maj_description1 = htmlentities($_POST['maj_description1'], ENT_QUOTES); }
else { $maj_description1 = $data_accueil_evenement1[1]; }

if (!empty($_POST['maj_nom_bouton1'])) { $maj_nom_bouton1=htmlentities($_POST['maj_nom_bouton1'], ENT_QUOTES);}
else{ $maj_nom_bouton1=$data_accueil_evenement1[2]; }

// requete de mise a jour de l'evenement 1
$Requete_update_evenement1= "UPDATE payicam_evenement SET evenement_titre='$maj_titre1',
    evenement_description='$maj_description1', evenement_activation_bouton='$evenement1_activation_bouton',
    evenement_bouton='$maj_nom_bouton1', evenement_afficher_cacher='$evenement1_afficher_cacher' WHERE evenement_id='1'";
   
// $ConnexionBD = mysqli_connect($bdd_url, $bdd_login, $bdd_password, $bdd_database);
$Update6= mysqli_query($ConnexionBD,$Requete_update_evenement1);
?>

<?php     // préparation de la connection et selection des données de l'évènement 2 actuel
 // $ConnexionBD = mysqli_connect($bdd_url, $bdd_login, $bdd_password, $bdd_database);
 $Resultat7 = mysqli_query($ConnexionBD, "SELECT evenement_titre, evenement_description, evenement_bouton, evenement_activation_bouton FROM payicam_evenement WHERE evenement_id='2'");
 $data_accueil_evenement2 = mysqli_fetch_array ($Resultat7);
?>

<div class="col-lg">        <!-- Début du formulaire de mise à jour de l'évènement 2 -->
     <fieldset style='margin-left: 50px;'> 
            <label><h5><b> Evènement 2 </b></h5></label><br/>
            <div class="form-group">
              <label for="maj_titre2"><h5> Titre évènement 2 : </h5></label><br/>
              <textarea class="form-control" name= "maj_titre2" id="maj_titre2"  autofocus  placeholder="<?php echo $data_accueil_evenement2[0];?>" rows="1"></textarea>
            </div>
            <div class="form-group">
              <label for="maj_description2"><h5> Description évènement 2 : </h5> </label><br/>
              <textarea class="form-control" name= "maj_description2" id="maj_description2"  autofocus  placeholder="<?php echo $data_accueil_evenement2[1];?>" rows="3"></textarea>
            </div>

            <div class="row">        
              <div class="col md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="evenement2_bouton" value="on"  > Activer le bouton 
                  </label>
                </div>
              </div>
              
              <div class="col md-4">
                <div class="form-check">
                  <label class="form-check-label">
                    <input class="form-check-input" type="radio" name="evenement2_bouton" value="off"> Désactiver le bouton 
                  </label>
                </div>
              </div>

              <div class="col md-4">          
                <div class="form-group">
                  <label for="maj_nom_bouton2"> Nom bouton évènement 2 :</label>
                  <input class="form-control" name= "maj_nom_bouton2" id="maj_nom_bouton2" autofocus placeholder="<?php echo $data_accueil_evenement2[2];?>">
                </div>
              </div>
            </div>
                    
     </fieldset>
</div>               <!-- Fin du formulaire de mise à jour de l'évènement 2 -->

</div> <!-- /row Evenement1 et Evenement 2-->

</DIV> <!-- /Container Evenements -->

<fieldset style='margin-left: 50px;'>      <!-- boutons d'envoi du formulaire -->
    <div class="row">
      <div class="col md-">
        <button  onclick="envoi();" style='text-align:center' class="btn btn-primary btn-lg" role="button" type=submit> Enregistrer</button>
         <button  style='text-align:center' class="btn btn-primary btn-lg" href='index.php' style='color:white' >Annuler</button>   
        </FORM>
      </div>
      <div class="col sm-" id="modif">
        <script> function envoi(){
          document.getElementById('modif').innerHTML="<i>Modifications enregistrées sur la page d'accueil</i>";
        }  </script>
      </div>
    </div>
</fieldset>

</DIV> <!-- /jumbotron-->

<?php
// Vérification de saisie et préparation des données pour la mise a jour des infos de l'évènement 2
if (!empty($_POST['evenement2_bouton']) and $_POST['evenement2_bouton']=="on" ){ $evenement2_activation_bouton='1';}
elseif(!empty($_POST['evenement2_bouton']) and $_POST['evenement2_bouton']=="off"){ $evenement2_activation_bouton='0'; }
else {$evenement2_activation_bouton=$data_accueil_evenement2[3]; }

if(!empty($_POST['maj_titre2']) ){ $maj_titre2 = htmlentities($_POST['maj_titre2'], ENT_QUOTES); }
else {  $maj_titre2 = $data_accueil_evenement2[0]; }

if ( !empty($_POST['maj_description2'])) { $maj_description2 = htmlentities($_POST['maj_description2'], ENT_QUOTES); }
else { $maj_description2 = $data_accueil_evenement2[1]; }

if (!empty($_POST['maj_nom_bouton2'])){ $maj_nom_bouton2=htmlentities($_POST['maj_nom_bouton2'], ENT_QUOTES);}
else{ $maj_nom_bouton2=$data_accueil_evenement2[2]; }

$Requete_update_evenement2= "UPDATE payicam_evenement SET evenement_titre='$maj_titre2',
    evenement_description='$maj_description2', evenement_activation_bouton='$evenement2_activation_bouton', 
    evenement_bouton='$maj_nom_bouton2' WHERE evenement_id='2'";

// $ConnexionBD = mysqli_connect($bdd_url, $bdd_login, $bdd_password, $bdd_database);
$Update7= mysqli_query($ConnexionBD,$Requete_update_evenement2);

include 'includes/footer.php';
?>
