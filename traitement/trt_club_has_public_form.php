<!----------------------------------->
<!-- Formulaire - club_has_public -->
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

        $title = "Ajouter un public";
        $button = "Ajouter";
        //echo $_GET['id'];
        
    //-----------------------------------------------
    //-- Requête : ID_Public ='".$_GET['id']."' ---
    //-----------------------------------------------
    $tmp=[];
    $req = $bdd->prepare("SELECT * FROM club_has_public WHERE ID_Club='".$_GET["id"]."' ");
    $req -> execute();

        while ($donnees = $req->fetch()) {
        //Afficher le résultat de la requête  
        array_push($tmp, $donnees[1]);
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
        <link rel="stylesheet" href="../css/trt_club_has_public_form.css">
        <title>Traitement - Utilisateur</title>
    </head>

    <body>
    <div id="trt_public_form">
        <h1><?php echo $title ?></h1>

        <!----------------------------------------------->
        <!-- Formulaire de traitement club_has_public  -->
        <!----------------------------------------------->
        <form  class="trt_public_form" action="trt_club_has_public.php?id=<?= $_GET['id']?>" method="post">

        <!-- --------------------------- -->
        <!-- Le public accueilli du Club -->
        <!-- --------------------------- -->
        <fieldset class="public">
            <table>
                <!-- <tr>
                    <th colspan=2><h3 style="margin:0 0">Public(s) accueilli(s)</h3></th>
                </tr>            
                 -->
                <?php
                $public = $bdd->prepare("SELECT * FROM public");
                $public -> execute();
                while($donnees_public = $public->fetch()){?>
                    <tr>
                        <td><label for="handi_debout"><?= $donnees_public['nomPublic'];?></label></td>
                        <td><input type="checkbox" 
                        name="handi_public[<?= $donnees_public['ID_Public'];?>]" id="<?= $donnees_public['ID_Public'];?>" value="<?= $donnees_public['nomPublic'];?>"<?php if(in_array($donnees_public['ID_Public'], $tmp)) {?> checked="checked"<?php } ?>
                        ></td>
                    </tr>
                    <?php }
                $public -> closeCursor();
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
