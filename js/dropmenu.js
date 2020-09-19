//------------------------------------
//----------Dropmenu-----------
//------------------------------------

// Mettre le modal dans une variable
var modal_dropmenu = document.getElementById("modal_dropmenu");

// Mettre le button dans une variable
var btn_dropmenu = document.getElementById("btn_dropmenu");

// Lorsque l'utilisateur clique sur le bouton, ouvrir le modal
btn_dropmenu.onclick = function() {
   if(modal_dropmenu.style.display === "none"){
    modal_dropmenu.style.display = "block";
   }
   else
   {
    modal_dropmenu.style.display = "none"; 
   } 
}

// Lorsque l'utilisateur clique n'importe où en dehors du modal, fermez-le
window.onclick = function(event) {
  if (event.target == modal_dropmenu) {
    modal_dropmenu.style.display = "none";
  }
  
}