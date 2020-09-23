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
        <link rel="stylesheet" href="css/index.css">

        <title>Comité Départemental Handisport des Ardennes</title>
        
    </head>
    
    <body>
        <!----------------------->
        <!--Navbar-->
        <!----------------------->    
        <?php include ('include/navbar.php');?>
        
        
        <!-------------------------->
        <!------- Parallax --------->
        <!-------------------------->
        <div  id="index" class="index_parallax">
            <h2>Comité Départemental Handisport des Ardennes</h2>
        </div>
        
        <!-------------------------------->
        <!------- Les événements -------->
        <!-------------------------------->
        <div class="index_intitule_evenement">
            <h1>Derniers événements</h1>
        <hr>
            
        <div class="container">
            <!-------------------------------->
            <!------- Les news -------->
            <!-------------------------------->
            <div class="container_news">
                <?php
                    //----------------------------------------------------
                    //-- Requête des événement limité à 3, triée par date  
                    //-----------------------------------------------------
                    $evenement = $bdd -> prepare("SELECT * FROM evenement ORDER BY dateDebutEvenement DESC LIMIT 3");
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
                                <p><?= mb_substr($data_evenement['txtEvenement'], 0,250)." ...";?></p>
                            </div>
                        </section>    
                    
                    <?php }?>
            </div>
            <!-- Fin de <div class="container_news"> -->

            <!----------------------------->
            <!------- Les old news -------->
            <!----------------------------->    
            <div class="container_evenement">
                <ul>
                    <?php
                        //--------------------------------------------------
                        //-- Affichage aléatoire des événement limité à 3 -- 
                        //--------------------------------------------------
                        $req_evenement = $bdd->prepare('SELECT * FROM evenement ORDER BY rand() LIMIT 3 ');
                        $req_evenement -> execute();
                        while($data_req_evenement = $req_evenement->fetch()){
                            //Mettre le format de la date en français
                            setlocale (LC_TIME, 'fr_FR.utf8','fra');
                            //Convertir la chaîne datetype en date
                            $dateDebut = strtotime($data_req_evenement['dateDebutEvenement']);?>   
                            <li>
                                <p><?=$data_req_evenement['nomEvenement'];?></p> 
                                <p><?= strftime("%d %B %Y", $dateDebut);?></p></li>
                            </li>
                        <?php }?>
                </ul> 
                <div>
                    <a href="evenement.php"title="Voir tous les événements">Voir tous les événements</a>
                </div>
            </div>
            <!-- Fin de <div class="container_evenement"> -->

        </div>
        <!-- Fin de <div class="container"> -->


        <!-------------------------------->
        <!------- slogan -------->
        <!-------------------------------->
        <div class="index_intitule_slogan">
            <div class="text">
                <p><i>"Notre association a pour but de contribuer à la réinsertion sociale des personnes handicapées à travers la passion et la pratique du sport."</i></p>
            </div>
            
            <div class="button">
                <a href="contact.php" title="Contactez-nous">Contactez-nous</a>
                <a href="soutien.php" title="Soutenez-nous">Soutenez-nous</a>
            </div>
        </div>
        <!-- Fin de class="index_intitule_slogan" -->
        

        <!-------------------------------->
        <!------- Les partenaires -------->
        <!-------------------------------->
        <div class="index_intitule_partenaire">
            <h1>Les partenaires</h1>
            <hr>
            <div class="partenaire">
                <div class="photo">
                    <?php
                    //--------------------------------------------------
                    //-- Préparer le requête pour les membres du Bureau 
                    //--------------------------------------------------
                    $req = $bdd->prepare("SELECT * FROM partenaire ORDER BY classementPartenaire");
                    $req -> execute();
                    while($donnees = $req->fetch()){
                        //Afficher le résultat de la requête
                        //var_dump($donnees);
                        
                        ?>
                        <div class="card">
                        <figure title="<?= $donnees['altPhotoPartenaire'];?>">
                            <!-- <figcaption><?php echo $donnees['nomPartenaire'];?></figcaption> -->
                                <img src="image/partenaire/<?= $donnees['photoPartenaire'];?>" alt="">
                            <figcaption><?= $donnees['nomPartenaire'];?></figcaption>
                        </figure>
                        </div>
                    <?php   }   $req -> closeCursor(); ?>  
                </div>
                <!-- Fin de  <div class="photo"> -->
            </div>
            <!-- Fin de <div class="partenaire"> -->
            
        </div>
        <!-- Fin de <div class="index_intitule_partenaire"> -->

        <!----------------------->
        <!--footer-->
        <!----------------------->    
        <?php include ('include/footer.php');?>
     
        <script src="js/jquery.js"></script>
        
</body>
</html>