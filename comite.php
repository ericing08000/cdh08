<?php

//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

?>

<!DOCTYPE html>

<html lang="fr" style="margin-top:85px">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/comite.css">
        <title>Le Comité Handisport</title>
    </head>

    <body >
        <!----------------------->
        <!--Navbar-->
        <!----------------------->    
        <?php include ('include/navbar.php');?>


        <!-------------------------->
        <!------- Parallax --------->
        <!-------------------------->
        <div  id="comite" class="comite_parallax">
            <h2>Le Bureau et l'équipe Handisport</h2>
        </div>


        <!-------------------------->
        <!-- Le comité Handisport -->
        <!-------------------------->
        <div class="comite_intitule">
            <h1>Le Comité Handisport</h1>
            <hr>
            
            <section>
                <p>La Maison Départementale des Sports, située à Bazeilles est la propriété du Conseil Général des Ardennes. Sur près de 4 400 m², elle se compose de 4 salles d'activités sportives et de bureaux qui abritent le service des sports du département et sont aussi le siège de plusieurs comités et associations.</p>
                <img src="image/logo/cdh08.png" alt="logo">
            </section>
        </div>

        <!-------------------------->
        <!-------- Missions -------->
        <!-------------------------->
        <div class="mission_intitule">
            <h1>Nos missions</h1>
            <hr>
            <div class="mission">
                <ul class="nav">
                    <li class="nav-item">Sensibiliser les valides pour une meilleure intégration sociale.</li>
                    <li class="nav-item">Sensibiliser avantage les personnes handicapées en les informant sur les activités pratiquées dans le département.</li>
                    <li class="nav-item">Faire découvrir de nouvelles activités aux personnes en situation de handicap pour leurs épanouissements personnels.</li>
                    <li class="nav-item">Travailler un maximum avec les établissements spécialisés pour un accès plus large sur les activités existantes.</li>
                </ul>
                <ul class="nav">
                    <li class="nav-item">Créer de nouveaux clubs handisport ainsi que des sections dans les clubs valides​.</li>
                    <li class="nav-item">Développer la pratique sportive en faveur des personnes atteintes d'un handicap physique ou sensoriel, afin de dynamiser leur quotidien.</li>
                    <li class="nav-item">Travailler un maximum avec les établissements spécialisés pour un accés plus large sur les activités existantes.</li>
                    <li class="nav-item">Inciter les clubs à organiser des pratique.</li>
                    <li class="nav-item">Le sport devient accessible à tous.
                    
                    </li>
                </ul>
            </div>
        </div>

        <!-------------------------------->
        <!------- bureau-Parallax --------->
        <!-------------------------------->
        <div class="bureau_parallax">
                <h2>Soutenez le développement du sport pour tous</h2>
                <div><a href="soutien.php" title="Soutenez-nous">En savoir plus</a></div>  
        </div>


        <!-------------------------->
        <!------- Le bureau -------->
        <!-------------------------->
        <div class="lecomite_intitule">
            <h1>Le Bureau</h1>
            <hr>
            <div class="bureau">
                <div class="photo">
                    <?php
                    //--------------------------------------------------
                    //-- Préparer le requête pour les membres du Bureau 
                    //--------------------------------------------------
                    $req = $bdd->prepare("SELECT * FROM bureau WHERE statusBureau = 1 ORDER BY classementBureau");
                    $req -> execute();
                    while($donnees = $req->fetch()){
                        //Afficher le résultat de la requête
                        //var_dump($donnees);
                        
                        ?>
                        <div class="card" title="<?= $donnees['designationBureau'].' - '.$donnees['prenomBureau'].' '.$donnees['nomBureau'];?>">
                        <figure>
                            <figcaption><?php echo $donnees['designationBureau'];?></figcaption>
                                <img src="image/photo/<?php echo $donnees['photoBureau'];?>" alt="">
                            <figcaption><?php echo $donnees['prenomBureau'].' '.$donnees['nomBureau'];?></figcaption>
                        </figure>
                        </div>
                    <?php   }   $req -> closeCursor(); ?>  
                </div>
            </div>
        </div>

        <!-------------------------->
        <!------- L'équipe --------->
        <!-------------------------->
        <div class="lecomite_intitule">
            <h1>L'équipe</h1>
            <hr>
            <div class="bureau">
                <div class="photo">
                    <?php
                    //--------------------------------------------------
                    //-- Préparer le requête pour les membres du Bureau 
                    //--------------------------------------------------
                    $req = $bdd->prepare("SELECT * FROM equipe WHERE statusEquipe = 1");
                    $req -> execute();
                    while($donnees = $req->fetch()){
                        //Afficher le résultat de la requête
                        //var_dump($donnees);
                        
                        ?>
                        <div class="card" title="<?= $donnees['designationEquipe'].' - '.$donnees['prenomEquipe'].' '.$donnees['nomEquipe'];?>">
                        <figure>
                            <figcaption><?php echo $donnees['designationEquipe'];?></figcaption>
                                <img src="image/photo/<?php echo $donnees['photoEquipe'];?>" alt="">
                            <figcaption><?php echo $donnees['prenomEquipe'].' '.$donnees['nomEquipe'];?></figcaption>
                        </figure>
                        </div>
                    <?php   }   $req -> closeCursor(); ?>  
                </div>
            </div>
        </div>

        <!-------------------------------->
        <!------- Salle-Parallax --------->
        <!-------------------------------->
        <div class="salle_parallax">
                <h2>Envie de faire du sport ?</h2>
                <div><a href="sport.php" title="découvrir nos sports">Découvrir nos sports</a></div>  
        </div>

        <!-------------------------->
        <!------- Les salles ------->
        <!-------------------------->
        <div class="salle_intitule">
            <h1>Les salles adaptées à la pratique Handisport</h1>
            <hr>
            <div class="salle">
                <div class="photo">
                    <div class="card" title="Dojo de 1030 m² (650 m² de tatmis)">
                        <figure>
                            <img src="image/photo/dojo.jpg" alt="Dojo de 1 030 m²">
                                <figcaption>Dojo de 1030 m² (650 m² de tatmis)</figcaption>
                        </figure>
                    </div>
                    <div class="card" title="Salle omnisport de 315 m²">
                        <figure>
                            <img src="image/photo/omnisport.jpg" alt="Salle omnisport de 315 m²">
                                <figcaption>Salle omnisport de 315 m²</figcaption>
                        </figure>
                    </div>
                    <div class="card" title="Salle de boxe de 325 m²">
                        <figure>
                            <img src="image/photo/boxe.jpg" alt="Salle de boxe de 325 m²">
                                <figcaption>Salle de boxe de 325 m²</figcaption>
                        </figure>
                    </div>
                    <div class="card" title="Salle de musculation de 90 m²">
                        <figure>
                            <img src="image/photo/muscu.jpg" alt="Salle de musculation de 90 m²">
                                <figcaption>Salle de musculation de 90 m²</figcaption>
                        </figure>   
                    </div>
                    <div class="card" title="Plateforme de 4000m² aménagée pour voitures radiotélécommandées">
                        <figure>
                            <img src="image/photo/modelisme.jpg" alt="Plateforme de 4000m² aménagée pour voitures radiotélécommandées">
                                <figcaption>Plateforme de 4000m² aménagée <br>pour voitures radiotélécommandées</figcaption>
                        </figure>
                    </div>
                </div>
            </div>
        </div> 


        <!----------------------------->
        <!-- Gestion des erreurs -->
        <!-----------------------------> 
        <?php
        //Vérifier s'il y a une variable error
            if(isset($_GET['success'])){
                if($_GET['success']==1){?>
                    <div id="success_nav" class="success">
                        <h3>Votre inscription a bien été enregistrée, vous pouvez vous connecter</h3>    
                    </div>    
                <?php }
            }
        ?> 

        <!----------------------->
        <!--footer-->
        <!----------------------->    
        <?php include ('include/footer.php');?>

    </body>

    <script src="js/jquery.js"></script>
    
</html>