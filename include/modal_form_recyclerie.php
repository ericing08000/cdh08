<!-------------------------------------------->
<!-- Fichier css demande de prêt recyclerie -->
<!-------------------------------------------->
<link rel="stylesheet" href="css/form_recyclerie.css">

<!------------------------------------------->
<!-- Formulaire demande de prêt recyclerie -->
<!------------------------------------------->
<div id="modal_recyclerie" style="display:none">
    <div class="form_recyclerie">
        
            <div class="logo">
                <span class="close_recyclerie_2">&times; </span> 
                <img title="Handisport Comité Départemental des Ardennes" src="image/Logo/cdh08.png" alt="Logo Handisport des Ardennes">
                
            </div>                
        <hr>
        <div class="form">
            <span class="close_recyclerie">&times;</span>
            <h3>Demande de prêt</h3>

            <!-- Gestion de l'erreur - Utilisateur non inscrit -->
            <?php if(!isset($_SESSION['pseudoUser'])){?> 
            <p id="error_recyclerie">Vous devez vous inscrire ou vous connectez pour faire une demande de prêt</p><?php } ?>

            <!-- Gestion des erreurs -->
            <p style="display:none" id="error_pret"></p>

            <form id="form_demande_pret" action="traitement/trt_demande_pret.php?id=<?php if(isset($_SESSION['id'])){ echo $_SESSION['id'];}?>&url=<?= $_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];?>" method="post">
                <label for="">Désignation :</label>
                <input id="designation_materiel" title="" type="text" name="designation_materiel" readonly>
                <label for="">Date début de location :</label>
                <input id="dateDebut" title="Date début de location" type="date"  name="dateDebut" required>
                <label for="">Date fin de location :</label>
                <input id="dateFin" title="Date fin de location" type="date"  name="dateFin" required>
                <!-- /Afficher le bouton selon la session -->
                <?php if(isset($_SESSION['pseudoUser'])){?>
                <button title="Valider votre demande" type="submit">Valider votre demande</button><?php } ?>
            </form>
        </div> 
    </div>
    <!-- Fin de class="form_recyclerie -->
</div>
<!-- Fin de id="modal_recyclerie" -->

<!-- Joindre le fichier source Jquery.js -->
<script src="js/jquery.js"></script>
<!-- Executer le script pour les actions sur le Modal -->
<script src="js/modal_form_recyclerie.js"></script>

<script>

    document.getElementById("form_demande_pret").onsubmit = function(e) {  

        //L’événement n’est pas traité
        e.preventDefault();
        //La méthode $.post de Jquery
        $.post(
            //On cible le fichier qui va recevoir les données
            'js/recyclerie_target_post.php',
            {
                //On récupère les valeurs des champs input
                dateDebut : $('input#dateDebut').val(),
                dateFin : $('input#dateFin').val(),
                
            },
            //Réception des données envoyées par le fichier js/recyclerie_target_post.php
            function(data){
                //On fait un affichage dans la console de l’explorateur
                console.log(data);
                //Si le retour est 'dateDebut_inf' alors on affiche un message d’erreur, on vide le champ et on lui donne le focus.
                if(data=='dateDebut_inf'){
                    $('#error_pret').show();
                    $('#error_pret').html("Veuillez saisir la date du jour ou une date supérieure");
                    $('input#dateDebut').val('');
                    $('input#dateDebut').focus();  
                }
                else{   
                    //Si le retour est 'dateFin_inf' alors on affiche un message d’erreur, on vide le champ et on lui donne le focus.
                    if(data=='dateFin_inf'){
                        $('#error_pret').show();
                        $('#error_pret').html("Veuillez saisir la date du jour ou une date supérieure");
                        $('input#dateFin').val('');
                        $('input#dateFin').focus();
                
                    }else{
                        //S’il n’y a pas de retour alors on exécute le traitement du formulaire
                        document.getElementById("form_demande_pret").submit();
                    }    
                }   
            },
            'text'
        );      
    };

</script>
