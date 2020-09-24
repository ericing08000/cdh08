//fermer les modals
$(document).ready(function(){

  //Fermer le modal s'inscrire avant d'ouvrir modal se connecter
  $("#btn_seconnecter").click(function(){
    $('#modal_sinscrire').hide();
    });     
});

// Mettre le modal dans une variable
var modal_sinscrire = document.getElementById("modal_sinscrire");

// Mettre le button dans une variable
var btn_sinscrire = document.getElementById("btn_sinscrire");
var btn_sinscrire_dropmenu = document.getElementById("btn_sinscrire_dropmenu");

// Mettre l'élément <span> qui ferme le modal dans une variable
var span = document.getElementsByClassName("close_sinscrire")[0];
var span_2 = document.getElementsByClassName("close_sinscrire_2")[0];

// Lorsque l'utilisateur clique sur le bouton, ouvrir le modal s'inscrire
btn_sinscrire.onclick = function() {
  modal_sinscrire.style.display = "block";
}
btn_sinscrire_dropmenu.onclick = function() {
  modal_sinscrire.style.display = "block";
}

// Lorsque l'utilisateur clique sur <span> (x), fermer le modal
span.onclick = function() {
  modal_sinscrire.style.display = "none";

  //Réinitialiser le formulaire
  $('#form_sinscrire')[0].reset();
  //Fermer les messages d'erreurs
  $('#error_signin').hide();
}
span_2.onclick = function() {
  modal_sinscrire.style.display = "none";

  //Réinitialiser le formulaire
  $('#form_sinscrire')[0].reset();
  //Fermer les messages d'erreurs
  $('#error_signin').hide();
}
