<!--==================================-->
<!-- Formulaire - Matériel Recyclerie -->
<!--==================================-->

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

        $title = "Éditer un matériel";
        $button = "Modifier";
        //echo $_GET['id'];

    //-----------------------------------------------
    //-- Requête : ID_Recyclerie ='".$_GET['id']."' ---
    //-----------------------------------------------
    $req = $bdd->prepare("SELECT * FROM recyclerie WHERE ID_Recyclerie='".$_GET['id']."'");
    $req -> execute();

        $donnees = $req->fetch();
        //Afficher le résultat de la requête
        // echo"<pre>";
        // print_r($donnees);
        // echo"</pre>";

    }else{
        $title = "Ajouter un matériel";
        $button = "Ajouter";

    }

    if(isset($_GET['suppr'])){
        //echo $_GET['suppr'];
        $title = "Supprimer un matériel";
        $button = "Supprimer";
    }

?>

<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/trt_recyclerie_form.css">
        <title>Traitement - Recyclerie</title>
    </head>

    <body>
    <div id="trt_recyclerie_form">
        <h1><?php echo $title ?></h1>

        <!------------------------->
        <!-- Gestion des erreurs -->
        <!------------------------->
        <?php
                
        if(isset($_GET['error'])){
            if($_GET['error'] ==1) {?>
                <div class="error">
                    <h3>Vous devez renseigner un nom de matériel.</h3>
                </div>
            <?php }
                if($_GET['error'] ==2) {?>
                    <div class="error">
                        <h3>Vous devez renseigner une légende à la photo.</h3>
                    </div>
                <?php }
                    if($_GET['error'] ==3) {?>
                    <div class="error">
                        <h3>Ce matériel existe déjà ...</h3>
                    </div>
                    <?php }
                        if($_GET['error'] ==4) {?>
                            <div class="error">
                                <h3>Attention la quantité est vide.</h3>
                            </div>
                        <?php }
                            if($_GET['error'] ==5) {?>
                            <div class="error">
                                <h3>Vous devez ajouter une photo.</h3>
                            </div>
                        <?php }} ?>

        <!------------------------------------------>
        <!-- Formulaire de traitement Recyclerie -->
        <!------------------------------------------>
        <form  class="trt_recyclerie_form" enctype="multipart/form-data" action="trt_recyclerie.php?method=<?php
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
                    <img value="photoMateriel" name="photoMateriel" src="../image/recyclerie/<?php if(!isset($donnees['photoMateriel'])){?>imageDefaut.png<?php }else{ echo $donnees['photoMateriel'];}?>" alt="image défaut">
                </fieldset>
                <fieldset>
                    <label for="">Ajouter une photo : </label>
                    <input type="file" name="downloadPhotoMateriel" id="downloadPhotoMateriel">
                </fieldset>
                <fieldset>
                    <label for="">Ajouter une légende : </label>
                    <input placeholder="Ajouter une légende à la photo*" type="text" name="altPhotoMateriel" id="altPhotoMateriel" value="<?php if(isset($_GET['alt'])){echo $_GET['alt'];}else{if(isset($_GET['id'])){echo $donnees['altPhotoMateriel'];}}?>">
                </fieldset>
            </div>
            <br>
            <fieldset>
                <label for="">Nom du matériel: </label>
                <input placeholder="Nom du matériel*" type="text" name="nomMateriel" id="nomMateriel" value="<?php if(isset($_GET['nomMateriel'])){echo $_GET['nomMateriel'];}else{if(isset($_GET['id'])){echo $donnees['nomMateriel'];}}?>">
            </fieldset>
            <fieldset>
                <label for="">Quantité: </label>
                <input placeholder="Indiquez une quantité*" type="text" name="quantiteMateriel" id="quantiteMateriel" value="<?php if(isset($_GET['quantiteMateriel'])){echo $_GET['quantiteMateriel'];}else{if(isset($_GET['id'])){echo $donnees['quantiteMateriel'];}}?>">
            </fieldset>

            

            <div class="button">
                <button type="submit"><?php echo $button;?></button>
            </div>
        </form>
        <a href="../dashboard#form_recyclerie"><button>Annulé</button></a>
    </div>
    <!-- fin de id="trt_bureau_form" -->
    </body>

</html>
