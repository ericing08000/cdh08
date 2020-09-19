<!--================================-->
<!-- Formulaire - Club -->
<!--================================-->

<?php
    //----------------------------------------
    //Connexion à la base de données en POO
    //----------------------------------------
    require_once('../class/Database.php');
    $connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
    $bdd = $connect->PDOConnexion();

   
    //Mettre le titre du formulaire dans un variable
    $title = "";
    $button = "";

    //Vérifier l'envoi du $_GET
    if(isset($_GET["id"])){

        $title = "Éditer un club";
        $button = "Modifier";
        //echo $_GET['id'];

    //-----------------------------------------------
    //-- Requête : ID_Club ='".$_GET['id']."' ---
    //-----------------------------------------------
    $req = $bdd->prepare("SELECT * FROM club WHERE ID_Club='".$_GET['id']."'");
    $req -> execute();

        $donnees = $req->fetch();
        //Afficher le résultat de la requête
        // echo"<pre>";
        // print_r($donnees);
        // echo"</pre>";

    }else{
        $title = "Ajouter un club";
        $button = "Ajouter";

    }

    if(isset($_GET['suppr'])){
        //echo $_GET['suppr'];
        $title = "Supprimer un club";
        $button = "Supprimer";
    }

?>
<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/trt_club_form.css">
        <title>Traitement - Club</title>
    </head>

    <body>
    <div id="trt_club_form">
        <h1><?php echo $title ?></h1>
        <!------------------------->
        <!-- Gestion des erreurs -->
        <!------------------------->
        <?php

        if(isset($_GET['error'])){
            if($_GET['error'] ==1) {?>
                <div class="error">
                    <h3>Vous devez renseigner un nom de Club.</h3>
                </div>
            <?php }
                if($_GET['error'] ==2) {?>
                    <div class="error">
                        <h3>Ce Club existe déjà ...</h3>
                    </div>
                    <?php }
                        if($_GET['error'] ==3) {?>
                            <div class="error">
                                <h3>Vous devez renseigner une adresse.</h3>
                            </div>
                        <?php }
                            if($_GET['error'] ==4) {?>
                                <div class="error">
                                    <h3>Vous devez renseigner un Code postal.</h3>
                                </div>
                            <?php }
                                if($_GET['error'] ==5) {?>
                                    <div class="error">
                                        <h3>Vous devez renseigner une ville.</h3>
                                    </div>
                                <?php }
                                    if($_GET['error'] ==6) {?>
                                        <div class="error">
                                            <h3>Vous devez renseigner un numéro de téléphone.</h3>
                                        </div>
                                    <?php }
                                        if($_GET['error'] ==7) {?>
                                        <div class="error">
                                            <h3>Vous devez ajouter une photo.</h3>
                                        </div>
                                    <?php }
                                        if($_GET['error'] ==8) {?>
                                            <div class="error">
                                                <h3>Vous devez ajouter une légende à la photo.</h3>
                                            </div>
                                        <?php }
        } ?>
        
        <!------------------------------------------>
        <!-- Formulaire de traitement Club -->
        <!------------------------------------------>
        <form  class="trt_club_form" enctype="multipart/form-data" action="trt_club.php?method=<?php
            if(!isset($_GET['id'])){
                echo 'insert';}

            else
            {
                if(isset($_GET['id']) && isset($_GET['suppr'])){
                    
                    echo 'delete&id='.$_GET['id'];
                }
                else
                {
                    if(isset($_GET['id']) && empty($_GET['suppr'])){
                    
                        echo 'edit&id='.$_GET['id'];
                    }
                }
            }
            ?>"
            method="post">

            <!-- ----------------- -->
            <!-- Le logo du Club -->
            <!-- ----------------- -->
            <fieldset class="logo">
                <div>
                    <img src="../image/club/<?php if(!isset($donnees['photoClub'])){?>imageDefaut.png<?php }else{ echo $donnees['photoClub'];}?>" alt="image par défaut">
                    <input type="file" name="downloadPhotoClub" id="downloadPhotoClub">
                    <input placeholder="Ajouter une légende au logo" type="text" name="altPhotoClub" id="altPhotoClub" value="<?php if(isset($_GET['alt'])){echo $_GET['alt'];}else{if(isset($_GET['id'])){echo $donnees['altPhotoClub'];}}?>">

                </div>
            <!-- -------------------------------------- -->
            <!-- Le formulaire public accueilli du Club -->
            <!-- -------------------------------------- -->
            <fieldset style="width:400px">
            <?php
            if(isset($_GET['id'])){?>
            
                <table class="table_public">
                    <tr class='tr_btn_public'>
                        <th colspan=2>PUBLIC(S) ACCUEILLI(S)</th>
                    </tr>
                    <tr>
                        <th colspan=2><a class="btn_public" href="../traitement/trt_club_has_public_form.php?id=<?= $donnees['ID_Club'];?>"><input type="button" value="Ajouter des publics"></a></th>
                    </tr>
                    
                    <?php
                    $public = $bdd ->prepare('SELECT cp.ID_Club, cp.ID_Public, p.nomPublic FROM club_has_public As cp, public As p WHERE cp.ID_Public = p.ID_Public AND cp.ID_Club = "'.$_GET['id'].'"');
                    $public -> execute ();
                    while($donnees_public = $public->fetch()){
                    //Afficher le résultat de la requête
                    // echo"<pre>";
                    // print_r($donnees_public);
                    // echo"</pre>";
                    ?>
                    <tr>
                        <td><?php echo $donnees_public['nomPublic'] ;?></td>
                        <td><a title="Supprimer de la liste : <?= $donnees_public['nomPublic'];?>" href="trt_club_has_public_delete.php?id=<?= $donnees_public['ID_Club'];?>&public=<?= $donnees_public['ID_Public'];?>"><img class="icon" src="../image/Icon/delete.png" alt="Supprimer"></a></td>
                    </tr>
                    <?php }?>
                </table>
            <?php }else{
            
            // Faire action si est vide
            
            }?>
            </fieldset>
            </fieldset>

            
            <!-- --------------------- -->
            <!-- Le formulaire du Club -->
            <!-- --------------------- -->

            <fieldset>
                <label for="">Nom du club : </label>
                <input placeholder="Ajouter un nom de Club *" type="text" name="nomClub" id="nomClub" value="<?php if(isset($_GET['nomClub'])){echo $_GET['nomClub'];}else{if(isset($_GET['id'])){echo $donnees['nomClub'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Président : </label>
                <input placeholder="Ajouter un Président"type="text" name="nomPresidentClub" id="nomPresidentClub" value="<?php if(isset($_GET['nomPresidentClub'])){echo $_GET['nomPresidentClub'];}else{if(isset($_GET['id'])){echo $donnees['nomPresidentClub'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Adresse : </label>
                <input placeholder="Ajouter une adresse *" type="text" name="adresseClub" id="adresseClub" value="<?php if(isset($_GET['adresseClub'])){echo $_GET['adresseClub'];}else{if(isset($_GET['id'])){echo $donnees['adresseClub'];}}?>">
            </fieldset>
            <fieldset>
                <label for="" style="margin-left:23px">Code Postal : </label>
                <input style="width:100px" placeholder="Code Postal *"type="text" name="cpClub" id="cpClub" value="<?php if(isset($_GET['cpClub'])){echo $_GET['cpClub'];}else{if(isset($_GET['id'])){echo $donnees['cpClub'];}}?>">
                <label for="" style="margin-left:0">Ville : </label>
                <input style="width:80%" placeholder="Ajouter une ville *" type="text" name="villeClub" id="villeClub" value="<?php if(isset($_GET['villeClub'])){echo $_GET['villeClub'];}else{if(isset($_GET['id'])){echo $donnees['villeClub'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Contact : </label>
                <input placeholder="Ajouter un contact" type="text" name="contactClub" id="contactClub" value="<?php if(isset($_GET['contactClub'])){echo $_GET['contactClub'];}else{if(isset($_GET['id'])){echo $donnees['contactClub'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Téléphone : </label>
                <input placeholder="Ajouter un téléphone 00.00.00.00.00*" type="tel" pattern="[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}" name="telClub" id="telClub" value="<?php if(isset($_GET['telClub'])){echo $_GET['telClub'];}else{if(isset($_GET['id'])){echo $donnees['telClub'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Email : </label>
                <input placeholder="Ajouter un email" type="email" name="emailClub" id="emailClub" value="<?php if(isset($_GET['emailClub'])){echo $_GET['emailClub'];}else{if(isset($_GET['id'])){echo $donnees['emailClub'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Adresse du site : </label>
                <input placeholder="Ajouter l'adresse du site" type="text" name="siteClub" id="siteClub" value="<?php if(isset($_GET['siteClub'])){echo $_GET['siteClub'];}else{if(isset($_GET['id'])){echo $donnees['siteClub'];}}?>">
            </fieldset>
            <!-- <fieldset>
                <label for="">GoogleMaps : </label>
                <textarea placeholder="Ajouter les coordonnées GoogleMaps du Club" class="club_maps" name="googleMapsClub" id="googleMapsClub" cols="20" rows="3"><?php if(isset($_GET['googleMapsClub'])){echo $_GET['googleMapsClub'];}else{if(isset($_GET['id'])){echo $donnees['googleMapsClub'];}}?></textarea>
            </fieldset> -->

            <!-- -------------------------------------- -->
            <!-- Le formulaire les sports du Club -->
            <!-- -------------------------------------- -->
            <fieldset id="table_sport">
            <?php
            if(isset($_GET['id'])){?>
            
                <table class="table_public">
                    <tr class='tr_btn_public'>
                        <th colspan=2>LES SPORTS DU CLUB</th>
                    </tr>
                    <tr>
                        <th colspan=2><a class="btn_public" href="../traitement/trt_club_has_sport_form.php?id=<?= $donnees['ID_Club'];?>"><input type="button" value="Ajouter des sports"></a></th>
                    </tr>
                    
                    <?php
                    $sport = $bdd ->prepare('SELECT sc.ID_Sport, sc.ID_Club, s.nomSport FROM sport_has_club As sc, sport As s WHERE sc.ID_Sport = s.ID_Sport AND sc.ID_Club = "'.$_GET['id'].'" ORDER BY s.nomsport');
                    $sport -> execute ();
                    while($donnees_sport = $sport->fetch()){
                    //Afficher le résultat de la requête
                    // echo"<pre>";
                    // print_r($donnees_sport);
                    // echo"</pre>";
                    ?>
                    <tr>
                        <td><?php echo $donnees_sport['nomSport'] ;?></td>
                        <td><a title="Supprimer : <?= $donnees_sport['nomSport'];?>" href="trt_club_has_sport_delete.php?id=<?= $donnees_sport['ID_Club'];?>&sport=<?= $donnees_sport['ID_Sport'];?>"><img class="icon" src="../image/Icon/delete.png" alt="Supprimer"></a></td>
                    </tr>
                    <?php }?>
                </table>
            <?php }else{
            
            // Faire action si est vide
            
            }?>
            </fieldset>

        <div class="button">
            <button type="submit"><?php echo $button;?></button>
        </form>
        <!-- fin de form class="trt_club_form"-->
        </div>
            <a href="../dashboard#form_club"><button>Annulé</button></a>
        </div>
        <!-- fin de  id="form_trt_club" -->

    </body>

    <script src="js/jquery.min.js"></script>
</html>
