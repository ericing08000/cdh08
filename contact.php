<!DOCTYPE html>

<html lang="fr" style="margin-top:85px">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/contact.css">
        <title>Contactez-nous</title>
    </head>

    <body>
    <!----------------------->
    <!--Navbar-->
    <!----------------------->    
    <?php include ('include/navbar.php');?>

    <!-------------------------->
    <!------- Parallax --------->
    <!-------------------------->
    <div class="contact_parallax"></div>

    <!-------------------------->
    <!-- Contactez-nous -->
    <!-------------------------->
    
    <div class="contact">
        
        <div class="titre">
            <h1>Contactez-nous</h1>
            <hr>
        </div> 
        <!-- Fin de class="titre" -->

        <div class="container">
            <section>
                <h2>Comité Départemental Handisport des Ardennes 08</h2>
                    <p>Jean-Pierre GARNIER<br>Président du Comité Handisport<br>
                    <br>
                    Tél : 03.24.32.46.89<br>Portable : 06.02.36.79.42 - 07.82.46.12.29<br>
                    <br>
                    Maison Départementale des Sports<br>Route de la Moncelle<br>08140 Bazeilles
                    </p>
            </section> 
            <!-- Fin de section -->

                
            <figure>
                <iframe class="frame" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2581.586226688306!2d4.985965009027256!3d49.68093237695818!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47ea6f43f9547a63%3A0x9adc2f013504a32f!2sMaison%20D%C3%A9partementale%20des%20Sports!5e0!3m2!1sfr!2sfr!4v1593518185694!5m2!1sfr!2sfr" width="1200" height="350"></iframe>
            </figure> <!-- Fin de figure -->
        </div> 
        <!-- Fin de class="container" -->
        <div id="error"></div>

        
                   

        <!----------------------------->
        <!-- Formulaire -->
        <!----------------------------->
        <div id="success"></div>
        <div id="error" class="form">
            <form action="traitement/trt_contact.php" method="post">

            <!----------------------------->
            <!-- Gestion des erreurs -->
            <!----------------------------->   
            <?php
            //Vérifier s'il y a une variable error
            if(isset($_GET['error'])){
                if($_GET['error']==1){?>
                    <div class="error">
                        <h3>Vous devez renseigner un nom</h3>
                    </div>
                <?php }
                    if($_GET['error']==2){?>
                        <div class="error">
                            <h3>Vous devez renseigner un prénom</h3>
                        </div>
                    <?php }
                        if($_GET['error']==3){?>
                            <div class="error">
                                <h3>Vous devez renseigner un sujet</h3>
                            </div>
                        <?php }
                            if($_GET['error']==4){?>
                                <div class="error">
                                    <h3>Vous devez renseigner un message</h3>
                                </div>
                            <?php }
            }else{
                if(isset($_GET['success'])){
                    if($_GET['success']==1){?>
                        <div class="success">
                        <h3>Votre message a bien été envoyé avec succès</h3>
                        </div>
                    <?php }
                }
            }?>
                <input placeholder="Nom*"type="text" name="nomContact" id="nomContact" tabindex="1" value="<?php if(isset($_GET['nomContact'])){ echo $_GET['nomContact'];}else{echo '';};?>">
                <input placeholder="Prénom*"type="text" name="prenomContact" id="prenomContact" tabindex="2" value="<?php if(isset($_GET['prenomContact'])){ echo $_GET['prenomContact'];}else{echo '';};?>">
                <input placeholder="Sujet*"type="text" name="sujetContact" id="sujetContact" tabindex="3" value="<?php if(isset($_GET['sujetContact'])){ echo $_GET['sujetContact'];}else{echo '';};?>">
                <textarea placeholder="Message*" name="messageContact" id="" cols="30" rows="10" tabindex="4" value="<?php if(isset($_GET['messageContact'])){ echo $_GET['messageContact'];}else{echo '';};?>"></textarea>
                <button type="submit" value="envoi">Envoyer</button>
            </form>
            <!-- Fin de form -->
        </div> 
        <!-- Fin de class="form" -->
                
    </div> 
    <!-- Fin de class="contact" -->
    

    <!----------------------->
    <!--footer-->
    <!----------------------->    
    <?php include ('include/footer.php');?>
                
    </body>

    <script src="js/jquery.min.js"></script>
</html>
