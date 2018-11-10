<?php
require_once 'includes/_header.php';
$Auth->allow('member');
$title_for_layout = 'FAQ';
$js_for_layout = array('faq');
include 'includes/header.php'; // insertion du fichier header.php : entête, barre de navigation
?>
<h1 class="page-header">Foire Aux Questions</h1>
<p>Cette section va tenter de vous répondre aux questions que vous avez : </p>
<p><i>N.B: Vous pouvez cliquer sur la question pour afficher la réponse! </i></p>


<section class="faq">
  <h2 class="titreCategoryFaq">Questions générales</h2>
  <dl>
    <dt>Qu'est ce que PayIcam?</dt>
    <dd>PayIcam est une association étudiante servant à la base de système de virtualisation de l'argent de l'ICAM. Au fur et à mesure, d'autres utilités lui ont été vues.</dd>

    <dt>De quand date PayIcam ?</dt>
    <dd>PayIcam a été lancé à l'Icam au début de l'année 2014-2015. Il n'a fait que grandir depuis.</dd>

    <dt>Qui s'occupe de PayIcam?</dt>
    <dd>Ce sont des étudiants de l'Icam qui s'occupent de la maintenance et de l'ajout de fonctionnalités à PayIcam.</dd>

    <dt>Comment s'inscrire ?</dt>
    <dd>L'inscription n'est possible qu'avec une adresse mail ICAM et aucune autre. Lors de la première connexion vous signez une chartre.</dd>

    <dt>Comment remettre de l'argent sur mon compte ?</dt>
    <dd>En utilisant Casper (voir en dessous)</dd>

    <dt>Comment effectuer des achats en ligne ?</dt>
    <dd>En utilisant Shotgun (voir en dessous)</dd>

    <dt>Ma carte ne marche plus que faire ?</dt>
    <dd>Il arrive qu'il faille réencoder les cartes de temps en temps, il faut alors demander aux personnes du BDE
      ou un membre de l'administration PayIcam</dd>

    <dt>Je ne retrouve plus ma carte ou elle est abimée, c'est grave docteur ?</dt>
    <dd>Oui, contacter un membre du BDE qui vous redirigera vers la personne qui gère la distribution des cartes en espace direction. Vous ne pouvez pas demander une autre carte que celle à votre nom</dd>

    <dt>Les cartes se renouvellent tous les ans ?</dt>
    <dd>Non, chaque carte contient une puce qui ets unique et qui coûte cher, vous gardez donc votre carte durant toutes vos études à l'ICAM</dd>

    <dt>L'année de la carte ne change pas ?</dt>
    <dd>Si! Des autocollants officiels (avec cryptograme) vous sont distribués tous les ans par l'ICAM via les BDPs avec l'année en cours de validité afin de garder cette même carte comme carte étudiante</dd>



  <h2 class="titreCategoryFaq">Casper</h2>
  <dl>
    <dt>Qu'est ce que Casper ?</dt>
    <dd><p>Casper est l'interface de rechargement de votre compte PayIcam, c'est via cette interface que vous gérez votre compte.</p>
      <p><a href="https://www.youtube.com/watch?v=hHvvZ2qs0Pg" title="Vidéo_tuto_recharger_casper" target="_blank">Lien vers le tutoriel vidéo de rechargement de son compte PayIcam</a></p></dd>

    <dt>Quel est le rechargement minimum/ maximum?</dt>
    <dd>Le rechargement minimum est de 10€ et le maximum de 250€</dd>

    <dt>Il y a t'il un montant maximum sur le compte ?</dt>
    <dd>Oui, le montant maximum sur un compte est de 1 000€</dd>

    <dt>Qu'est ce que le virement à un ami ?</dt>
    <dd>Vous pouvez virer de l'argent à un ami à qui vous devez de l'argent ou juste comme cadeau à condition que celui-ci soit inscrit sur le système PayIcam. Il recevra un email pour le prévenir. de votre virement.</dd>

    <dt>Je ne peux pas payer en ligne avec ma carte, il y a t'il un autre moyen de recharger mon compte ?</dt>
    <dd>Oui, le plus simple est de demander à un ami de recharger son compte est de vous faire un virement, ainsi vous pouvez lui rembourser en liquide!</dd>

    <dt>A quoi sert le bouton "bloquer mon compte ?"</dt>
    <dd>Le bouton de blocage de badge sert en cas de perte ou de vol de votre carte, afin d'eviter que une autre personne paye avec votre badge. Il est possible de réactiver sa carte instantannément si vous la bloquez.</dd>




  <h2 class="titreCategoryFaq">Shotgun</h2>
  <dl>
    <dt>Qu'est ce que Shotgun ?</dt>
    <dd>Shotgun est l'interface de payement en ligne, c'est grâce à elle que vous pouvez reserver des places ou des goodies.</dd>

    <dt>Comment payer en ligne avec shotgun ?</dt>
    <dd><a href="https://www.youtube.com/watch?v=dLDtx0rhRhk" title="Vidéo_tuto_shotgun" target="_blank">Lien vers le tutoriel vidéo de payement avec shotgun</a></dd>

  </dl>


  <?php if ($Auth->hasRole('admin')): // uniquement pour les admin et super-admin ?>
    <h2>Pour les administrateurs</h2>
    <h3 class="titreCategoryFaq">Scoobydoo</h3>
    <dl>
      <dt>Qu'est ce que scoobydoo ?</dt>
      <dd>Scoobydoo est l'interface de gestion des associations et des articles.</dd>

      <dt>La gestion de la trésorerie</dt>
      <dd><a href="https://www.youtube.com/watch?v=ZvP8LPI5zPs" title="Vidéo_tuto_gestion_treso" target="_blank">Lien vers le tutoriel vidéo de gestion de la trésorerie</a></dd>

      <dt>La gestion des droits</dt>
      <dd><a href="https://www.youtube.com/watch?v=qoAEoVk473c" title="Vidéo_tuto_gestion_droits" target="_blank">Lien vers le tutoriel vidéo de gestion des droits</a></dd>

       <dt>La gestion des articles</dt>
      <dd><a href="https://www.youtube.com/watch?v=H4Ku3-sw98o" title="Vidéo_tuto_gestion_droits" target="_blank">Lien vers le tutoriel vidéo de gestion des articles</a></dd>





    </dl>

    <h3 class="titreCategoryFaq">Shotgun</h3>
    <dl>
      <dt>Comment administrer Shotgun ?</dt>
      <dd>Vidéo tuto à venir!</dd>

    </dl>

    <h3 class="titreCategoryFaq">Mozart</h3>
    <dl>
      <dt>Qu'est ce que Mozart ?</dt>
      <dd>Mozart est l'interface de vente.</dd>

      <dt>Qu'est ce que Mozart utilise ?</dt>
      <dd>Mozart s'utilise sur un ordinateur connecté à internet avec une badgeuse et peut imprimer les tickets sur une imprimante spéciale. Il a été concu pour fonctioner avec un écran tactile mais peut aussi fonctioner avec une souris</dd>

      <dt>Comment mettre en place un point de vente?</dt>
      <dd>Un point de vente se met en place par l'instalation du driver de la badgeuse ainsi que la validation des droits de vente sur Scoobydoo. Il faut l'autorisation d'un administrateur.</dd>

      <dt>La badgeuse ne fonctionne pas que faire ?</dt>
      <dd>Vérifier que la badgeuse est correctement branchée, lancer le script de "démarrage badgeuse" qui a été installé sur l'ordinateur et accepter l'utilisation des scripts à risques dans le navigateur</dd>

      <dt>Comment accepeter l'utilisation des des scripts à risques ?</dt>
      <dd>Dans la barre d'adresse de votre navigateur (chrome) il y a normalement un petit bouclier tout à droite, cliquez dessus et appuyez sur "charger les scripts à risques". La page va se recharger.</dd>

      <dt>Puis-je annuler une transaction ?</dt>
      <dd>Oui! En cas d'erreur une transaction peut être annulée en repassant la carte en question sur la badgeuse, un pop-up s'affiche et vous propose d'annuler les transactions effectuées dans les 15 minutes précédentes.</dd>

          </dl>

    <h3 class="titreCategoryFaq">Admin_Ginger</h3>
    <dl>
      <dt>Qu'est ce que Admin_Ginger ?</dt>
      <dd>Admin_Ginger est l'interface de gestion de la base de donnée Ginger qui est la base de donnée utilisateur reliée au Cas Icam.</dd>

      <dt>Qui y a accès?</dt>
      <dd>Une liste nominative qui est gérée par PayICAM et le bureau du BDE</dd>

      <dt>Réencoder des cartes ?</dt>
      <dd>C'est en effet la principale fonction de admin-ginger</dd>


    </dl>
  <?php endif ?>
</section>

<?php include 'includes/footer.php';?>