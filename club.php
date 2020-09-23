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
        <link rel="stylesheet" href="css/club.css">
        <title>Nos sports</title>
    </head>

    <body>
        <!----------------------->
        <!--Navbar-->
        <!----------------------->
        <?php include ('include/navbar.php');?>

        <!-------------------------->
        <!------- Parallax --------->
        <!-------------------------->
        <div id="club"></div>
        <div class="club_parallax">
            <h2>Soutenez le développement du sport pour tous</h2>
                <div><a href="soutien.php" title="Soutenez-nous">En savoir plus</a></div>  
        </div>

        <!-------------------------->
        <!------- Les clubs ------->
        <!-------------------------->
        <div class="club_container">
            <div  class="club">
                <h1>Les clubs</h1>
                <hr>
            </div>
            <!-- fin de class="club" -->

            <div class="club_card">
                <?php
                    //--------------------------------------------------
                    //-- Préparer le requête pour les membres du Bureau 
                    //--------------------------------------------------
                    $req = $bdd->prepare("SELECT * FROM club ORDER BY nomClub");
                    $req -> execute();
                    
                    while($donnees = $req->fetch()){
                        //Afficher le résultat de la requête
                        //var_dump($donnees);
                        
                        ?>
                        <div class="card" title="<?= $donnees['altPhotoClub'];?>">
                            <a href="fiche_club.php?id=<?= $donnees['ID_Club'];?>"><figure>
                                <img src="image/club/<?= $donnees['photoClub'];?>" alt="<?= $donnees['altPhotoClub'];?>">
                            <figcaption><?= $donnees['nomClub'];?></figcaption>
                            </figure></a>
                        </div>
                       
                    <?php  }   $req -> closeCursor(); ?>  
            </div>
            <!-- fin de class="club_card" -->
            
        </div>
        <!-- Fin de class="club_container" -->
        
        <!----------------------->
        <!--footer-->
        <!----------------------->    
        <?php include ('include/footer.php');?>
        
        <script src="js/jquery.js"></script>    
    </body>  
    
</html>
