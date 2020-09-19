// Ajax $_post

$(document).ready(function(){

    $('#btn_ajax_post').click(function() {

        $.post(
            'dashboard#form_sport.php',
            {
                nomSport: $("input#nomSport").val()
            },
            function(data){
                console.log(data);
                
                
            },
            
        );

    })
    
    
});
