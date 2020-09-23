<?php

//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/evenement.css">

        <title>Les événements</title>
        
    </head>
    
    <body">
        <!----------------------->
        <!--Navbar-->
        <!----------------------->    
        <?php include ('include/navbar.php');?>

        <!-------------------------->
        <!------- Parallax --------->
        <!-------------------------->
        <div class="evenement_parallax">
            <h2>Les événements</h2>
        </div> 

        <!-------------------------------->
        <!------- Les événements -------->
        <!-------------------------------->
        <div class="evenement_intitule">
            <h1>Les événements</h1>
        <hr>

        <div class="container">

            <div class="container_news">
            <?php
                    //----------------------------------------------------
                    //-- Requête des événement limité à 3, triée par date  
                    //-----------------------------------------------------
                    $evenement = $bdd -> prepare("SELECT * FROM evenement ORDER BY dateDebutEvenement desc");
                    $evenement -> execute();
                    while($data_evenement = $evenement->fetch()){
                        //Mettre le format de la date en français
                        setlocale (LC_TIME, 'fr_FR.utf8','fra');
                        //Convertir la chaîne datetype en date
                        $dateDebut = strtotime($data_evenement['dateDebutEvenement']);
                        ?>
                        <section>
                            <div class="img">
                                <p style="font-size:12px; margin-bottom:10px"><?= strftime("%B", $dateDebut);?></p>
                                <p style="font-size:25px; margin-top:0; margin-bottom:10px"><?= strftime("%d", $dateDebut);?></p>
                            </div>
                            
                            <div class="text">
                                <a href="fiche_evenement.php?id=<?= $data_evenement['ID_Evenement'];?>"><?=$data_evenement['nomEvenement'];?></a>
                                <p><?= mb_substr($data_evenement['txtEvenement'],0,250)." ...";?></p>
                            </div>
                        </section>    
                    
                    <?php }?>
            </div>

        </div>
        <!-- Fin de <div class="container"> -->


        <!----------------------->
        <!--footer-->
        <!----------------------->    
        <?php include ('include/footer.php');?>
     
        <script src="js/jquery.js"></script>
        
</body>
</html>