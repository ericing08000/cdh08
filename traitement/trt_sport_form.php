<!--================================-->
<!-- Formulaire - Sport -->
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

        $title = "Éditer un sport";
        $button = "Modifier";
        //echo $_GET['id'];

    //-----------------------------------------------
    //-- Requête : ID_Sport ='".$_GET['id']."' ---
    //-----------------------------------------------
    $req = $bdd->prepare("SELECT * FROM sport WHERE ID_Sport='".$_GET['id']."'");
    $req -> execute();

        $donnees = $req->fetch();
        //Afficher le résultat de la requête
        // echo"<pre>";
        // print_r($donnees);
        // echo"</pre>";

    }else{
        $title = "Ajouter un sport";
        $button = "Ajouter";

    }

    if(isset($_GET['suppr'])){
        //echo $_GET['suppr'];
        $title = "Supprimer un sport";
        $button = "Supprimer";
    }

?>


<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/trt_sport_form.css">
        <title>Traitement - Sport</title>
    </head>

    <body>
    <div id="trt_sport_form">
        <h1><?php echo $title ?></h1>

        <!------------------------->
        <!-- Gestion des erreurs -->
        <!------------------------->
        <?php
                
        if(isset($_GET['error'])){
            if($_GET['error'] ==1) {?>
                <div class="error">
                    <h3>Vous devez renseigner un nom de sport.</h3>
                </div>
            <?php }
                if($_GET['error'] ==2) {?>
                    <div class="error">
                        <h3>Vous devez renseigner une légende à la photo.</h3>
                    </div>
                <?php }
                    if($_GET['error'] ==3) {?>
                    <div class="error">
                        <h3>Le sport existe déjà ...</h3>
                    </div>
                    <?php }
                        if($_GET['error'] ==4) {?>
                            <div class="error">
                                <h3>Le sport est utilisé par <?php echo $_GET['nomclub']?></h3>
                            </div>
                        <?php }
                            if($_GET['error'] ==5) {?>
                            <div class="error">
                                <h3>Vous devez ajouter une photo.</h3>
                            </div>
                        <?php }} ?>

        <!------------------------------------------>
        <!-- Formulaire de traitement Sport -->
        <!------------------------------------------>
        <form  class="trt_sport_form" enctype="multipart/form-data" action="trt_sport.php?method=<?php
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
            <div id="photo">
                <fieldset class="photo">
                    <img value="photoSport" name="photoSport" src="../image/sport/<?php if(!isset($donnees['photoSport'])){?>imageDefaut.png<?php }else{ echo $donnees['photoSport'];}?>" alt="image défaut">
                </fieldset>
                <fieldset>
                    <label for="">Ajouter une photo : </label>
                    <input type="file" name="downloadPhoto" id="downloadPhoto">
                </fieldset>
                <fieldset>
                    <label for="">Ajouter une légende : </label>
                    <input placeholder="Ajouter une légende à la photo*" type="text" name="altPhotoSport" id="altPhotoSport" value="<?php if(isset($_GET['alt'])){echo $_GET['alt'];}else{if(isset($_GET['id'])){echo $donnees['altPhotoSport'];}}?>">
                </fieldset>
            </div>
            <br>
            <fieldset>
                <label for="">Nom du sport: </label>
                <input placeholder="Nom du sport*" type="text" name="nomSport" id="nomSport" value="<?php if(isset($_GET['nomSport'])){echo $_GET['nomSport'];}else{if(isset($_GET['id'])){echo $donnees['nomSport'];}}?>">
            </fieldset>
            <fieldset class="textarea">
                <p>Capacité(s):<p>
                <textarea placeholder="Capacité(s) développée(s)" name="capaciteSport" cols="70" rows="5" value=""><?php if(isset($_GET['capaciteSport'])){echo $_GET['capaciteSport'];}else{if(isset($_GET['id'])){echo $donnees['capaciteSport'];}}?></textarea>
            </fieldset>
            <fieldset class="textarea">
                <p>Description du sport</p> 
                <textarea placeholder="Description du sport" name="descriptionSport" cols="70" rows="7" value=""><?php if(isset($_GET['descriptionSport'])){echo $_GET['descriptionSport'];}else{if(isset($_GET['id'])){echo $donnees['descriptionSport'];}}?></textarea>
            </fieldset>
            <fieldset class="textarea">
                <p>Pratique</p> 
                <textarea placeholder="Pratique du sport" name="pratiqueSport" cols="70" rows="7" value=""><?php if(isset($_GET['pratiqueSport'])){echo $_GET['pratiqueSport'];}else{if(isset($_GET['id'])){echo $donnees['pratiqueSport'];}}?></textarea>
            </fieldset>
            <fieldset class="textarea">
                <p>Le réglement</p> 
                <textarea placeholder="Le réglement du sport" name="reglementSport" cols="70" rows="7" value=""><?php if(isset($_GET['reglementSport'])){echo $_GET['reglementSport'];}else{if(isset($_GET['id'])){echo $donnees['reglementSport'];}}?></textarea>
            </fieldset>
            

            <div class="button">
                <button type="submit"><?php echo $button;?></button>
            </div>
        </form>
        <a href="../dashboard#form_sport"><button>Annulé</button></a>
    </div>
    <!-- fin de id="trt_bureau_form" -->
    </body>

</html>
