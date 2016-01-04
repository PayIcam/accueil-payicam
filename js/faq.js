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
    else {$(this).next().slideUp();} // Referme si c'est ouvert
  });

  // $("dl").hide();
  // $(".titreCategoryFaq").css("cursor", "pointer");
  // $(".titreCategoryFaq").click(function() {
  //   if($(this).next().is(":visible") == false) {
  //     $("dl").slideUp();
  //     $(this).next().slideDown();
  //   }
  //   else {$(this).next().slideUp();}
  // });
});