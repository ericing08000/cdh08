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
        <link rel="stylesheet" href="css/sport.css">
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
        <div class="sport_parallax">
            <h2>Les Sports de nos Clubs</h2>
        </div>
        
        <!-------------------------->
        <!----- Les sports --------->
        <!-------------------------->
        <div class="sport">
            <h1>Les sports</h1>
            <hr>
        </div>
        
        <div class="sport_card">
            
            <?php
            
            $sport = $bdd->prepare('SELECT DISTINCT sc.ID_Sport, s.nomSport, s.photoSport, s.altPhotoSport FROM sport_has_club As sc, sport AS s WHERE sc.ID_Sport = s.ID_Sport ORDER BY s.nomsport ASC');
            $sport->execute();
            
            while($data_sport = $sport->fetch()){?> 

            <div class="card" title="<?= $data_sport['altPhotoSport'];?>">
                <a href="fiche_sport.php?id=<?= $data_sport['ID_Sport'];?>"><figure>
                    <img src="image/sport/<?= $data_sport['photoSport'];?>" alt="">
                        <figcaption class="color_1"><?= $data_sport['nomSport'];?></figcaption>
                </figure></a>
            </div>
            <!-- Fin de div class="card" -->
        <?php } ?> 

        </div >
        <!-- Fin div class="sport_card" -->

        

        <!----------------------->
        <!--footer-->
        <!----------------------->    
        <?php include ('include/footer.php');?>
        
    </body>

    <script src="js/jquery.js"></script>
    
</html>
