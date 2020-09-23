<?php

if(!isset($_GET['id'])){
    header("location:sport.php");
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
$fiche_sport = $bdd->prepare("SELECT * FROM sport WHERE ID_Sport = '".$_GET['id']."'");
$fiche_sport ->execute(array());
$data_sport = $fiche_sport->fetch();
//var_dump( $data_club);
           
?>
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/fiche_sport.css">
        <title>Fiche sport - <?= $data_sport['nomSport'];?></title>
    </head>

    <body>
        <!----------------------->
        <!--Navbar-->
        <!----------------------->
        <?php include ('include/navbar.php');?>

        <!------- Parallax --------->
        <!-------------------------->
        <div class="fiche_sport_parallax">
            <h1><?= $data_sport['nomSport'];?></h1>
        </div>
        
    <!-------------------------->
    <!-- La fiche sport -->
    <!-------------------------->
    <div class="fiche_sport">
        <!-- <h1><?= $data_sport['nomSport'];?></h1>   -->
        
        <!-- <hr> -->
            <section>
                <h2>Capacité(s) développée(s)</h2>
                <p><?= nl2br($data_sport['capaciteSport']);?></p>
            </section>
        <hr>
            <!-------------------------->
            <!-- Description du sport -->
            <!-------------------------->
            <section>
                <p><?= $data_sport['descriptionSport'];?></p> 
            </section>
        <br>
            <!-------------------------->
            <!-- Pratique du sport -->
            <!-------------------------->
            <section>
                <?php if(!empty($data_sport['pratiqueSport'])){?><h2>Pratique</h2><?php }?>
                
                <p><?= nl2br($data_sport['pratiqueSport']);?></p> 
            </section>
        <br>
            <!-------------------------->
            <!-- Réglement du sport -->
            <!-------------------------->
            <section>
            <?php if(!empty($data_sport['reglementSport'])){?><h2>Le règlement</h2><?php }?>
                    <p><?= nl2br($data_sport['reglementSport']);?></p> 
            </section>

    </div>
    <!--  fin de : fiche_sport -->
    
    <br>
    <!--------------------------------->
    <!----- fiche pédagogique --------->
    <!--------------------------------->
    <div class="fiche_sport_download">
        <a href="pdf/fiche_pedagogique.php?id=<?=$data_sport['ID_Sport'];?>" title="Télécharger la fiche pédagogique - <?=$data_sport['nomSport'];?>"target="_blank">Télécharger la fiche pédagogique - <?=$data_sport['nomSport'];?></a>
    </div>
    <br>
    
    <!------------------------------------------------>
    <!----- Les clubs qui porposent le sport --------->
    <!------------------------------------------------>
    <div class="fiche_sport_club">
        <h1>Club(s) qui propose ce sport</h1>   
    <hr>
        <div class="fiche_sport_card">
            <?php
            $req = $bdd->prepare('SELECT sc.ID_Sport, sc.ID_Club, c.nomClub, c.photoClub, c.altPhotoClub FROM sport_has_club AS sc, club AS c WHERE sc.ID_Club = c.ID_Club AND sc.ID_Sport = "'.$_GET['id'].'"');
            $req->execute();
            while($data = $req->fetch()){?>
            <!-- var_dump($data);  -->
                <div class="card" title="<?= $data['nomClub'];?>">
                    <a href="fiche_club.php?id=<?= $data['ID_Club'];?>"><figure>
                        <img src="image/club/<?= $data['photoClub'];?>" alt="">
                            <figcaption class="color_1"><?= $data['nomClub'];?></figcaption>
                    </figure></a>
                </div>

            <?php }?>
            
        </div >
        <!--  fin de : fiche_sport_card -->

    </div>
    <!--  fin de : fiche_sport_club -->

    <!----------------------->
    <!--footer-->
    <!----------------------->    
    <?php include ('include/footer.php');?>
        
    </body>

    <script src="js/jquery.js"></script>
</html>
