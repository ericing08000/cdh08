$(document).ready(function () {

  //Récupérer la valeur title du fichier recyclerie.php
  $(".card").click(function () {
  var title = $(this).attr("title");

    //renseigner la valeur du champ input "designation_materiel" de modal_recyclerie
    document.getElementById("designation_materiel").value = title.charAt(0).toUpperCase() + title.substring(1).toLowerCase();

    //Ouvir modal avec le titre de la card 
    document.getElementById("designation_materiel").title = title
    $("#modal_recyclerie").show();
      
  });
});

// Mettre l'élément <span> qui ferme le modal dans une variable
var span = document.getElementsByClassName("close_recyclerie")[0];
var span_2 = document.getElementsByClassName("close_recyclerie_2")[0];

// Lorsque l'utilisateur clique sur <span> (x), fermer le modal
span.onclick = function() {
  modal_recyclerie.style.display = "none";
  //Réinitialiser le formulaire
  $('#form_demande_pret')[0].reset();
  //Fermer les messages d'erreurs
  $('#error_pret').hide();
}
span_2.onclick = function() {
  modal_recyclerie.style.display = "none";

  //Réinitialiser le formulaire
  $('#form_demande_pret')[0].reset();
  //Fermer les messages d'erreurs
  $('#error_pret').hide();
}

//Lorsque l'utilisateur clique n'importe où en dehors du modal, fermez-le
// window.onclick = function(event) {
//   if (event.target == modal_recyclerie) {
//     modal_recyclerie.style.display = "none";
//   }
  
// }
