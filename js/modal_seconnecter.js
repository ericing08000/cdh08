
$(document).ready(function(){
  //Fermer la div success création de compte
  $("#btn_seconnecter_nav").click(function(){
    $('#success').hide();
    });
  //     //Fermer le modal mot de passe oublié
  //     $("#btn_sinscrire").click(function(){
  //       $('#modal_seconnecter').hide();
  //     });
  //       //Fermer le modal se connecter
  //       $("#btn_sinscrire_seconnecter").click(function(){
  //         $('#modal_seconnecter').hide();
  //       });
  //         //Fermer le modal se connecter
  //         // $("#btn_forgotMdp_seconnecter").click(function(){
  //         //   $('#modal_seconnecter').hide();
  //         // });
});

// Mettre le modal dans une variable
var modal_seconnecter = document.getElementById("modal_seconnecter");

// Mettre le button dans une variable
var btn_seconnecter = document.getElementById("btn_seconnecter");
var btn_seconnecter_mdp = document.getElementById("btn_seconnecter_mdp");
var btn_seconnecter_dropmenu = document.getElementById("btn_seconnecter_dropmenu");

// Mettre l'élément <span> qui ferme le modal dans une variable
var span = document.getElementsByClassName("close_seconnecter")[0];
var span_2 = document.getElementsByClassName("close_seconnecter_2")[0];

// Lorsque l'utilisateur clique sur le bouton, ouvrir le modal
btn_seconnecter.onclick = function() {
  modal_seconnecter.style.display = "block";
}
  btn_seconnecter_dropmenu.onclick = function() {
    modal_seconnecter.style.display = "block";
  }

// Lorsque l'utilisateur clique sur <span> (x), fermer le modal
span.onclick = function() {
  modal_seconnecter.style.display = "none";
  //Réinitialiser le formulaire
  $('#form_seconnecter')[0].reset();
  //Fermer les messages d'erreurs
  $('#error_signup').hide();
}
span_2.onclick = function() {
  modal_seconnecter.style.display = "none";

  //Réinitialiser le formulaire
  $('#form_seconnecter')[0].reset();
  //Fermer les messages d'erreurs
  $('#error_signup').hide();
}