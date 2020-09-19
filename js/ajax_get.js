
$(document).ready(function(){

    //Ecouter le click du bouton
    var button = ('#ajax_get');

    $(button).on('click', function(){
        var monTexte = $(this).text();
        //alert(monTexte);
        
        $.get('ajax_get_target.php', {text: monTexte}, function(data){
            console.log(data);
            
            
        });
    });
});

/* Ajax load avec paramètres*/
$(document).ready(function(){

    $('#load_param').click(function(){
        $("#error_signin").load("ajax_load_param.php",
        {
            pseudoUser: $("#pseudoUser").val()
        });
    });


});

/* Ajax methode=post*/
$(document).ready(function(){

    $('#ajax_post:button').click(function(){

        $.post(
            '../js/ajax_post_test.php',
            {
                login : $('input#login').val(),
                mdp : $('input#mdp').val()
                
            },
            function(data){

                console.log(data);
                if(data=='Ok'){
                    $('#resultat').html("<p>Vous avez été identifier</p>");
                    $('#resultat p').addClass("hightlight2");
                }else{
                    $('#resultat').html("<p>Erreur lors de la connexion</p>");
                    $('#resultat p').addClass("erreur");
                }
            },
            'text'
            );
            
        

    });
});