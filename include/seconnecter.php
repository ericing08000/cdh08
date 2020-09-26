<!-------------------------------->
<!-- Fichier css - Se connecter -->
<!-------------------------------->
<link rel="stylesheet" href="css/seconnecter.css">

<!----------------------------------->
<!-- Fiche se connecter -->
<!----------------------------------->
<div id="modal_seconnecter" style="display:none">
    <div class="seconnecter">
        
            <div class="logo">
            <span class="close_seconnecter_2">&times; </span>
                <img title="Handisport Comité Départemental des Ardennes" src="image/Logo/cdh08.png" alt="Logo Handisport des Ardennes">
            </div>
            
        
        <hr>
        <div class="input">
        <span class="close_seconnecter">&times;</span>
                <h3>Se connecter</h3>
                
            
            <form  id="form_seconnecter" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

                <!-- Gestion des erreurs -->
                <p style="display:none" id="error_signup"></p>

                <input id="pseudo_signup" title="Renseigner votre pseudo" placeholder="Pseudo*" type="text" name="pseudoUser" required>
                <input id="mdp_signup" title="Renseigner votre mot de passe" placeholder="Mot de passe*" type="password" name="mdpUser" required>            
                <button id="btn_signup" title="Se connecter" type="submit">Se connecter</button>
            </form>

            <hr>
            <div class="button">
                <a id="btn_forgotMdp_seconnecter" title="Mot de passe oublié ?">Mot de passe oublié ?</a>
            </div>

        </div>
        <!-- fin de class="input" -->
    </div>
    <!-- fin de class="seconnecter"-->
</div>
<!-- fin de class="seconnecter_container" -->

<script src="js/jquery.js"></script>

<script>

    document.getElementById("form_seconnecter").onsubmit = function(e) {    
    
        e.preventDefault();
        $.post(
            'js/seconnecter_target_post.php',
            {
                pseudo_signup : $('input#pseudo_signup').val(),
                mdp_signup : $('input#mdp_signup').val(),
                
            },
            function(data){

                console.log(data);

                if(data=='ok'){

                    document.getElementById("form_seconnecter").submit();
                }else{   
                    if(data=='false'){
                        $('#error_signup').show();
                         $('#error_signup').html("Le pseudo ou le mot de passe n'est pas valide");
                        //Vider les inputs
                        $('input#pseudo_signup').val('');
                        $('input#mdp_signup').val('');
                        //donner le focus au pseudo
                        //$('input#pseudo_signup').focus();
                     }
                }   
            },
            'text'
        );      
    };

</script>