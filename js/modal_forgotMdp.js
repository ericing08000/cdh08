//fermer les modals
$(document).ready(function(){

  //Fermer le modal se connecter avant d'ouvrir modal mot de passe oublié
  $("#btn_forgotMdp_seconnecter").click(function(){
    $('#modal_seconnecter').hide();
  });

});

// Mettre le modal dans une variable
var modal_forgotMdp = document.getElementById("modal_forgotMdp");

// Mettre le button dans une variable
var btn_forgotMdp = document.getElementById("btn_forgotMdp");
var btn_forgotMdp_seconnecter = document.getElementById("btn_forgotMdp_seconnecter");

// Mettre l'élément <span> qui ferme le modal dans une variable
var span = document.getElementsByClassName("close_forgotMdp")[0];
var span_2 = document.getElementsByClassName("close_forgotMdp_2")[0];

// Lorsque l'utilisateur clique sur le bouton, ouvrir le modal mot de passe oublié
btn_forgotMdp_seconnecter.onclick = function() {
  modal_forgotMdp.style.display = "block";
}

// Lorsque l'utilisateur clique sur <span> (x), fermer le modal
span.onclick = function() {
  modal_forgotMdp.style.display = "none";
  //Réinitialiser le formulaire
  $('#form_forgotMdp')[0].reset();
  //Fermer les messages d'erreurs
  $('#error_forgotMdp').hide();
}
span_2.onclick = function() {
  modal_forgotMdp.style.display = "none";

  //Réinitialiser le formulaire
  $('#form_forgotMdp')[0].reset();
  //Fermer les messages d'erreurs
  $('#error_forgotMdp').hide();
}