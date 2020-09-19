
<!----------------------------------->
<!-- Fiche s'inscrire -->
<!----------------------------------->
<link rel="stylesheet" href="css/sinscrire.css">


<!----------------------------------->
<!-- Fiche s'inscrire -->
<!----------------------------------->
<div id="modal_sinscrire" style="display:none">
    <div class="sinscrire">
        
            <div class="logo">
                <span class="close_sinscrire_2">&times; </span> 
                <img title="Handisport Comité Départemental des Ardennes" src="image/Logo/cdh08.png" alt="Logo Handisport des Ardennes">
                
            </div>                
        <hr>
        <div class="input">
            <span class="close_sinscrire">&times;</span>
            <h3>Création de compte</h3>          
            <form id="form_sinscrire" action="traitement/trt_sinscrire.php?url=<?= $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>" method="post">

                <!-- Gestion des erreurs -->
                <p style="display:none" id="error_signin"></p>

                <input id="pseudoUser" title="Renseigner votre pseudo" placeholder="Pseudo*" type="text" name="pseudoUser" required>    
                <input id="nomUser" title="Renseigner votre nom" placeholder="Nom*" type="text" name="nomUser" required>
                <input id="prenomUser" title="Renseigner votre prénom" placeholder="Prénom*" type="text" name="prenomUser" required>
                <input id="telUser" title="Téléphone ou portable 00.00.00.00.00" placeholder="Téléphone ou portable 00.00.00.00.00*" type="tel" pattern="[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}" name="telUser" required>
                <input id="emailUser" title="Renseigner votre email" placeholder="Email*" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,}$" name="emailUser" required>
                <input id="mdpUser" title="Renseigner votre mot de passe" placeholder="Mot de passe*" type="password" name="mdpUser" required>
                <input id="mdpUser_confirme" title="Confirmer votre mot de passe" placeholder="Confirmer mot de passe*" type="password" name="mdpUser_confirme" required>
                
                <button id="btn_signin" title="Créer un compte" type="">Créer un compte</button>
               
            </form>
            
            <hr>
            <div class="button">
                <!-- <a id="btn_forgotMdp" title="Mot de passe oublié ?"  >Mot de passe oublié ?</a> -->
                <p title="Vous avez déjà un compte ?"  >Vous avez déjà un compte ?</p>
                <br>
                <a id="btn_seconnecter" title="Se connecter">Se connecter</a>
            </div>
        </div> 
    </div>
    <!-- Fin de class="sinscrire" -->
</div>
<!-- Fin de class="sinscrire_container" -->

<script src="js/jquery.js"></script>

<script>

    document.getElementById("form_sinscrire").onsubmit = function(e) {    
    
        e.preventDefault();
        $.post(
            'js/sinscrire_target_post.php',
            {
                pseudoUser : $('input#pseudoUser').val(),
                emailUser : $('input#emailUser').val(),
                mdpUser : $('input#mdpUser').val(),
                mdpUser_confirme : $('input#mdpUser_confirme').val(),
            },
            function(data){

                console.log(data);

                if(data=='pseudo_existe'){
                    $('#error_signin').show();
                    $('#error_signin').html("Le pseudo existe déjà");
                    $('input#pseudoUser').val('');
                    $('input#pseudoUser').focus();
                    
                }
                else{   
                    if(data=='email_existe'){
                        $('#error_signin').show();
                        $('#error_signin').html("L'email existe déjà");
                        $('input#emailUser').val('');
                        $('input#emailUser').focus();
                        
                    }else{
                        if(data=='mdp false'){
                            $('#error_signin').show();
                            $('#error_signin').html("La confirmation du mot de passe n'est pas valide");
                            $('input#mdpUser_confirme').val('');
                            // $('input#mdpUser_confirme').focus();


                        }else{
                            document.getElementById("form_sinscrire").submit();
                        }
                        
                    }    
                }   
            },
            'text'
        );      
    };

</script>
