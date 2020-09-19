
$(document).ready(function(){
    //Récupérer la valeur de l'ancre
    var anchor = window.location.hash;

    //Sélectionner chaque onglets de la div id="dashboard_link"
    $("#dashboard_link").each(function(){

    //Récupérer l'onglet current
    var current = null;
    
    if(anchor != ''){
        current = anchor;
    }
    else
    {
        //Récupérer l'id du premier onglet current
        current = $(this).find('a:first').attr('href');
    }
    
    //Appliquer la class active à l'onglet
    $(this).find('a[href="'+current+'"]').addClass('active'); 
      
        //Masquer les div et afficher la div current    
        $(current).siblings().hide();
        
        //Écouter les onglets
        $(this).find('a').click(function(){
            if($(this).attr('href') == current){
                return false;
            }
            else
            {
                $('a').removeClass('active');
                current = $(this).attr('href');
                $(current).show().siblings().hide();
                $(this).addClass('active');
            }
        });
  });
});

