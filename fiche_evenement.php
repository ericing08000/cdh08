<?php

if(!isset($_GET['id'])){
    header("location:evenement.php");
}

//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

//----------------------------------------
//Préparer la requête avec id 
//----------------------------------------
$fiche_evenement = $bdd->prepare("SELECT * FROM evenement WHERE ID_Evenement = '".$_GET['id']."'");
$fiche_evenement ->execute(array());
$data_evenement = $fiche_evenement->fetch();
//var_dump( $data_club);
           
?>
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/fiche_evenement.css">
        <title>Fiche événement - <?= $data_evenement['nomEvenement'];?></title>
    </head>

    <body>
        <!----------------------->
        <!--Navbar-->
        <!----------------------->
        <?php include ('include/navbar.php');?>


        <!-------------------------->
        <!------- Parallax --------->
        <!-------------------------->
        <div class="fiche_evenement_parallax">
            <h1>Fiche événement</h1>
        </div>
        
    <!-------------------------->
    <!-- La fiche événement -->
    <!-------------------------->
    <div class="fiche_evenement">
        <h1><?= $data_evenement['nomEvenement'];?></h1>
        
        <hr>
            <div class="date">
                <div>
                    <h3>Date de début :</h3>
                    <?php
                        setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                        $dateDebut = strtotime($data_evenement['dateDebutEvenement']);?>
                        <p><?= strftime("%d %B %Y", $dateDebut);?></p>    
                </div>
                <div> 
                    <?php 
                        
                        setlocale (LC_TIME, 'fr_FR.utf8','fra'); 
                        $dateFin = strtotime($data_evenement['dateFinEvenement']);
                        if($data_evenement['dateFinEvenement'] != '0000-00-00'){?>
                            <h3>Date de fin :</h3>
                        <p><?= strftime("%d %B %Y", $dateFin);?></p> 
                    
                    <?php }?>
                        
                </div>
            </div>
            <!-- Fin de <div class="date"> -->
        <hr>
            <!-------------------------------->
            <!-- Description de l'événement -->
            <!-------------------------------->
            <section>
                <p><?= nl2br($data_evenement['txtEvenement']);?></p> 
            </section>
        <br>
            <!-------------------------->
            <!-- Activité(s) -->
            <!-------------------------->
            <section>
                <?php if(!empty($data_evenement['activiteEvenement'])){?><h2>Activité(s) proposée(s) :</h2><?php }?>
                
                <p><?= nl2br($data_evenement['activiteEvenement']);?></p> 
            </section>
        <br>
            <!-------------------------->
            <!-- Participant(s) -->
            <!-------------------------->
            <section>
            <?php if(!empty($data_evenement['participantEvenement'])){?><h2>Participant(s) :</h2><?php }?>
                    <p><?= nl2br($data_evenement['participantEvenement']);?></p> 
            </section>

    </div>
    <!--  fin de : fiche_sport --> 
    
    </div>
    <!--  fin de : fiche_sport_club -->

    <!----------------------->
    <!--footer-->
    <!----------------------->    
    <?php include ('include/footer.php');?>
        
    </body>

    <script src="js/jquery.js"></script>
</html>
