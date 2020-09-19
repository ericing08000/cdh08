<!----------------------------------->
<!-- Fiche mot de passe oublié -->
<!----------------------------------->
<link rel="stylesheet" href="css/forgotMdp.css">

<!----------------------------------->
<!-- Mot de passe oublié -->
<!----------------------------------->
<div id="modal_forgotMdp" style="display:none">
    <div class="forgotMdp">
            <div class="logo">
                <span class="close_forgotMdp_2">&times; </span>
                <img title="Handisport Comité Départemental des Ardennes" src="image/Logo/cdh08.png" alt="Logo Handisport des Ardennes">
            </div>
        <hr>
        <div class="input"> 
        <span class="close_forgotMdp">&times;</span>
            <h3>Mot de passe oublié ?</h3>  

            <form  id="form_forgotMdp" method="post" action="traitement/trt_forgotMdp.php">
                <p>Entrez votre adresse e-mail ci-dessous et nous vous enverrons un lien pour réinitialiser votre mot de passe !</p>

                <!-- Gestion des erreurs en Ajax-->
                <p style="display:none" id="error_forgotMdp"></p>

                    <input title="Renseigner votre email" placeholder="Renseigner votre email*" type="email" name="emailUser" id="emailUser_mdp" required>
                    
                    <button title="Réinitialiser le mot de passe" type="submit">Réinitialiser le mot de passe</button>
            </form>

        </div>  
    </div>
    <!-- Fin de class="forgotMdp" -->
</div>
<!-- Fin de class="fotgotMdp_container" -->

<script src="js/jquery.js"></script>

<script>

    document.getElementById("form_forgotMdp").onsubmit = function(e) {    
    
        e.preventDefault();
        $.post(
            'js/forgotMdp_target_post.php',
            {
                emailUser : $('input#emailUser_mdp').val(),
        
            },
            function(data){

                console.log(data);

                if(data=='ok'){
                    
                    document.getElementById("form_forgotMdp").submit();
                }
                else{   
                    
                    $('#error_forgotMdp').show();
                    $('#error_forgotMdp').html("L'email n'existe pas...Veuillez resaisir votre email");
                    $('input#emailUser_mdp').val('');
                    
                    }    
                   
            },
            'text'
        );      
    };

</script>
