<!----------------------------------->
<!-- Formulaire - club_has_sport -->
<!----------------------------------->

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

        $title = "Ajouter un sport";
        $button = "Ajouter";
        //echo $_GET['id'];
        
    //-----------------------------------------------
    //-- Requête : ID_Sport ='".$_GET['id']."' ---
    //-----------------------------------------------
    $tmp=[];
    $req = $bdd->prepare("SELECT * FROM sport_has_club WHERE ID_Club='".$_GET["id"]."' ");
    $req -> execute();

        while ($donnees = $req->fetch()) {
        //Afficher le résultat de la requête  
        array_push($tmp, $donnees[0]);
        }
    }
    //var_dump($tmp);
?>


<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/trt_club_has_sport_form.css">
        <title>Traitement - Ajouter les sports au club</title>
    </head>

    <body>
    <div id="trt_club_has_sport">
        <h1><?php echo $title ?></h1>

        <!----------------------------------------------->
        <!-- Formulaire de traitement club_has_sport  -->
        <!----------------------------------------------->
        <form  class="trt_club_has_sport" action="trt_club_has_sport.php?id=<?= $_GET['id']?>" method="post">

        <!-- ------------------- -->
        <!-- Les sports du Club -->
        <!-- ------------------- -->
        <fieldset class="trt_club_has_sport">
            <table>
                <!-- <tr>
                    <th colspan=2><h2 style="margin:0 0">Les sport</h2></th>
                </tr>
                -->
                <?php
                $sport = $bdd->prepare("SELECT * FROM sport ORDER BY nomSport");
                $sport -> execute();
                while($donnees_sport = $sport->fetch()){?>
                    <tr>
                        <td><label for=""><?= $donnees_sport['nomSport'];?></label></td>

                        <td><img style="width:25px;height:25px"src="../image/sport/<?= $donnees_sport['photoSport'];?>" alt="<?= $donnees_sport['altPhotoSport'];?>"></td>

                        <td><input type="checkbox" name="handi_sport[<?= $donnees_sport['ID_Sport'];?>]" id="<?= $donnees_sport['ID_Sport'];?>" value="<?= $donnees_sport['nomSport'];?>"<?php if(in_array($donnees_sport['ID_Sport'], $tmp)) {?> checked="checked"<?php } ?>
                        ></td>
                    </tr>
                    <?php }
                    
                $sport -> closeCursor();
                ?>     
            </table>
        </fieldset>
            
        <div class="button">
            <button type="submit"><?php echo $button;?></button>
        </div>          
    </form>
        <a href="trt_club_form.php?id=<?= $_GET['id'];?>"><button>Annulé</button></a>
    </div>
    <!-- fin de  id="trt_user_form"-->
    
    </body>

</html>
