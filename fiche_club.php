<?php
if(!isset($_GET['id'])){
    header("location:club.php");
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
$fiche_club = $bdd->prepare("SELECT * FROM club WHERE ID_Club = '".$_GET['id']."'");
$fiche_club ->execute(array());
$data_club = $fiche_club->fetch();
//var_dump( $data_club);
           
?>

<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/fiche_club.css">
        <title>Fiche club - <?= $data_club['nomClub'];?></title>
    </head>

    <body>
        <!----------------------->
        <!--Navbar-->
        <!----------------------->    
        <?php include ('include/navbar.php');?>
    
        <!-------------------------->
        <!------- Parallax --------->
        <!-------------------------->
        <div  class="le_club_parallax">
            <h1><?= $data_club['nomClub'];?></h1>
        </div>
        
    <!----------------------------->
    <!----- La fiche club --------->
    <!----------------------------->
    <div class="le_club_info">

        <!------------------------------------------------>
        <!----- La fiche club - public accueilli --------->
        <!------------------------------------------------>
        <div class="public">
            <a href="<?= $data_club['siteClub'];?>" target="_blank" title="Accédez au club : <?= $data_club['nomClub'];?>"><img src="image/club/<?= $data_club['photoClub'];?>" alt="<?= $data_club['altPhotoClub'];?>"></a>
            <section>
                
                <?php
                $fiche_public = $bdd->prepare("SELECT cp.ID_Club, cp.ID_Public, p.nomPublic FROM club_has_public AS cp, public AS p WHERE cp.ID_Public = p.ID_Public AND ID_Club = '".$_GET['id']."'");
                $fiche_public ->execute();

                $count_public = $fiche_public->rowcount(); 

                if($count_public > 0){?>

                <h2>Public(s) accueilli(s)</h2><?php

                    while($data_public = $fiche_public->fetch()){?>
                    
                        <ul>
                            <li><?= $data_public['nomPublic'];?></li>
                            
                        </ul>
                    <?php }  ?>
                <?php }?>
            </section>
        </div> 
        <!-- Fin de : class="public" -->
    

        <!--------------------------------------->
        <!----- La fiche club - Contact --------->
        <!--------------------------------------->
        <div class="le_club_contact">

            <div class="le_club_table">
                <table>
                    <tr><th colspan=2>Contact et informations</th></tr>
                    <tr><th>Président</th><td><?= $data_club['nomPresidentClub'];?></td></tr>
                    <tr><th>Adresse</th><td><?= $data_club['adresseClub'];?></td></tr>
                    <tr><th>Code postal</th><td><?= $data_club['cpClub'];?></td></tr>
                    <tr><th>Ville</th><td><?= $data_club['villeClub'];?></td></tr>
                    <tr><th>Contact</th><td><?= $data_club['contactClub'];?></td></tr>
                    <tr><th>Téléphone</th><td><?= $data_club['telClub'];?></td></tr>
                    <tr><th>Email</th><td><?= $data_club['emailClub'];?></td></tr>
                </table>
                <div> 
                    <?php if(!empty($data_club['siteClub'])){?> 
                    <a href="<?= $data_club['siteClub'];?>" target="_blank" title="Accédez au site du club : <?= $data_club['siteClub'];?>">Accédez au site du club</a>
                    <?php }?>
                </div> 
            </div>
            <!-- Fin de : le_club_table -->
     
            <!-- <div class="le_club_googleMaps">
                <figure >
                    <iframe class="frame" src="https://www.google.com/maps/embed?pb=!1m10!1m8!1m3!1d3663.296997273754!2d4.371825260546086!3d49.51581595839666!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sfr!2sfr!4v1593765074601!5m2!1sfr!2sfr"></iframe>
                </figure>
            </div> Fin de class="club_container" -->

        </div>
        <!-- Fin de : class="le_club_contact" --> 

    </div>
    <!-- Fin de : class="le_club_info" -->  


    <!------------------------------------------>
    <!----- La fiche club - Les sports --------->
    <!------------------------------------------>
    <div id="sport" class="le_club_sport">
            <h1>Sport(s) proposé(s)</h1>
            <hr>
            <div>
            <?php
                $fiche_sport = $bdd->prepare("SELECT sc.ID_Sport, sc.ID_Club, s.nomSport, s.photoSport, s.altPhotoSport FROM sport_has_club AS sc, sport AS s WHERE sc.ID_Sport = s.ID_Sport AND ID_Club = '".$_GET['id']."'");
                $fiche_sport ->execute();

                $count = $fiche_sport->rowcount(); 

                if($count > 0){

                    while($data_sport = $fiche_sport->fetch()){?>
                    
                    <ul>
                        <li><a href="fiche_sport.php?id=<?=$data_sport['ID_Sport'];?>" title="<?=$data_sport['nomSport'];?>"><img src="image/sport/<?=$data_sport['photoSport'];?>" alt="<?=$data_sport['altPhotoSport'];?>"><?=$data_sport['nomSport'];?></a></li>
                    </ul>
                    <?php }  
                }else{?>
                    <ul>
                        <li><a title="Pas de sport à porposer pour ce club"><img src="image/sport/imageDefaut.png" alt="">Pas de sport à proposer pour ce club</a></li>
                    </ul>
                <?php }?>
            </div>
            <!-- Fin de la div -->
    </div>
    <!-- fin de : le_club_sport -->
      

        <!----------------------->
        <!--footer-->
        <!----------------------->    
        <?php include ('include/footer.php');?>
        
    </body>

    <script src="js/jquery.js"></script>
</html>
