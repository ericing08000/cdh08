<!--================================-->
<!-- Formulaire - Événements -->
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

        $title = "Éditer un événement";
        $button = "Modifier";
        //echo $_GET['id'];

    //-----------------------------------------------
    //-- Requête : ID_Evenement ='".$_GET['id']."' ---
    //-----------------------------------------------
    $req = $bdd->prepare("SELECT * FROM evenement WHERE ID_Evenement='".$_GET['id']."'");
    $req -> execute();

        $donnees = $req->fetch();
        //Afficher le résultat de la requête
        // echo"<pre>";
        // print_r($donnees);
        // echo"</pre>";

    }else{
        $title = "Ajouter un événement";
        $button = "Ajouter";

    }

    if(isset($_GET['suppr'])){
        //echo $_GET['suppr'];
        $title = "Supprimer un événement";
        $button = "Supprimer";
    }

?>


<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/trt_evenement_form.css">
        <title>Traitement - Les événements</title>
    </head>

    <body>
    <div id="trt_evenement_form">
        <h1><?php echo $title ?></h1>

        <!------------------------->
        <!-- Gestion des erreurs -->
        <!------------------------->
        <?php
                
        if(isset($_GET['error'])){
            if($_GET['error'] ==1) {?>
                <div class="error">
                    <h3>Vous devez renseigner le nom de événement.</h3>
                </div>
            <?php }
                if($_GET['error'] ==2) {?>
                    <div class="error">
                        <h3>Vous devez renseigner un lieu à l'énénement.</h3>
                    </div>
                <?php }
                    if($_GET['error'] ==3) {?>
                    <div class="error">
                        <h3>Vous devez renseigner une date de début à l'énénement.</h3>
                    </div>
                    <?php }
                        if($_GET['error'] ==4) {?>
                            <div class="error">
                                <h3>Vous devez renseigner une description à l'énénement</h3>
                            </div>
                        
                        <?php }} ?>

        <!------------------------------------------>
        <!-- Formulaire de traitement Sport -->
        <!------------------------------------------>
        <form  class="trt_evenement_form" enctype="multipart/form-data" action="trt_evenement.php?method=<?php
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
            
            <fieldset>
                <label for="">Nom de l'événement: </label>
                <input placeholder="Nom de l'événement*" type="text" name="nomEvenement" id="nomEvenement" value="<?php if(isset($_GET['nom'])){echo $_GET['nom'];}else{if(isset($_GET['id'])){echo $donnees['nomEvenement'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Lieu de l'événement: </label>
                <input placeholder="Lieu de l'événement*" type="text" name="lieuEvenement" id="lieuEvenement" value="<?php if(isset($_GET['lieu'])){echo $_GET['lieu'];}else{if(isset($_GET['id'])){echo $donnees['lieuEvenement'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Date début événement: </label>
                <input placeholder="Date de l'événement*" type="date" name="dateDebutEvenement" id="dateDebutEvenement" value="<?php if(isset($_GET['dateDebut'])){echo $_GET['dateDebut'];}else{if(isset($_GET['id'])){echo $donnees['dateDebutEvenement'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Date fin événement: </label>
                <input placeholder="Date de l'événement*" type="date" name="dateFinEvenement" id="dateFinEvenement" value="<?php if(isset($_GET['dateFin'])){echo $_GET['dateFin'];}else{if(isset($_GET['id'])){echo $donnees['dateFinEvenement'];}}?>">
            </fieldset>
            <fieldset class="textarea">
                <p>Description de l'événement:<p>
                <textarea placeholder="Description de l'événement*" name="txtEvenement" cols="70" rows="7" value=""><?php if(isset($_GET['txt'])){echo $_GET['txt'];}else{if(isset($_GET['id'])){echo $donnees['txtEvenement'];}}?></textarea>
            </fieldset>
            <fieldset class="textarea">
                <p>Activité(s) de l'événement :</p> 
                <textarea placeholder="Activité(s) de l'événement" name="activiteEvenement" cols="70" rows="5" value=""><?php if(isset($_GET['activiteEvenement'])){echo $_GET['activiteEvenement'];}else{if(isset($_GET['id'])){echo $donnees['activiteEvenement'];}}?></textarea>
            </fieldset>
            <fieldset class="textarea">
                <p>Participant(s) accueilli(s)</p> 
                <textarea placeholder="Participant(s) accueilli(s)" name="participantEvenement" cols="70" rows="7" value=""><?php if(isset($_GET['participantEvenement'])){echo $_GET['participantEvenement'];}else{if(isset($_GET['id'])){echo $donnees['participantEvenement'];}}?></textarea>
            </fieldset>
            <div class="button">
                <button type="submit"><?php echo $button;?></button>
            </div>
        </form>
        <a href="../dashboard#form_evenement"><button>Annulé</button></a>
    </div>
    <!-- fin de id="trt_bureau_form" -->
    </body>

</html>
