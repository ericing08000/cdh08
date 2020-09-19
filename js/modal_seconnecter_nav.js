
// Mettre le modal dans une variable
var modal_seconnecter = document.getElementById("modal_seconnecter");

// Mettre le boutton dans une variable
var btn_seconnecter_nav = document.getElementById("btn_seconnecter_nav");


// Mettre l'élément <span> qui ferme le modal dans une variable
var span = document.getElementsByClassName("close_seconnecter")[0];

// Lorsque l'utilisateur clique sur le bouton, ouvrir le modal se connecter
btn_seconnecter_nav.onclick = function() {
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

// Lorsque l'utilisateur clique n'importe où en dehors du modal, fermez-le
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal_seconnecter.style.display = "none";
//   }
// } 