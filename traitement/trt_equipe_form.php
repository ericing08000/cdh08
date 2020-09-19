<!---------------------------------------->
<!-- Formulaire - Équipe -->
<!---------------------------------------->

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

        $title = "Éditer un membre de l'équipe";
        $button = "Modifier";
        //echo $_GET['id'];

    //-----------------------------------------------
    //-- Requête : ID_Equipe ='".$_GET['id']."' ---
    //-----------------------------------------------
    $req = $bdd->prepare("SELECT * FROM equipe WHERE ID_Equipe='".$_GET['id']."'");
    $req -> execute();

        $donnees = $req->fetch();
        //Afficher le résultat de la requête
        // echo"<pre>";
        // print_r($donnees);
        // echo"</pre>";

    }else{
        $title = "Ajouter un membre de l'équipe";
        $button = "Ajouter";

    }

    if(isset($_GET['suppr'])){
        //echo $_GET['suppr'];
        $title = "Supprimer un membre de l'équipe";
        $button = "Supprimer";
    }

?>


<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/trt_equipe_form.css">
        <title>Traitement - Equipe</title>
    </head>

    <body>
    <div id="trt_equipe_form">
        <h1><?php echo $title ?></h1>

        <!------------------------->
        <!-- Gestion des erreurs -->
        <!------------------------->
        <?php
                
        if(isset($_GET['error'])){
                if($_GET['error'] ==1) {?>
                    <div class="error">
                        <h3>Vous devez renseigner le prénom du membre de l'équipe.</h3>
                    </div>
                <?php }
                    if($_GET['error'] ==2) {?>
                    <div class="error">
                        <h3>Vous devez renseigner le nom du membre de l'équipe.</h3>
                    </div>
                <?php }} ?>

        <!------------------------------------------>
        <!-- Formulaire de traitement Equipe -->
        <!------------------------------------------>
        <form  class="trt_equipe_form" enctype="multipart/form-data" action="trt_equipe.php?method=<?php
            if(!isset($_GET['id'])){
                echo 'insert';}

            else
            {
                if(isset($_GET['id']) && isset($_GET['suppr'])){
                    echo 'delete&id=';
                    echo ($_GET['id']);
                }
                else
                {
                    if(isset($_GET['id']) && empty($_GET['suppr'])){
                        echo 'edit&id=';
                        echo ($_GET['id']);
                    }
                }
            }
            ?>"
            method="post">
            <div id="photoEquipe">
                <fieldset class="photoEquipe">
                    <img value="photoEquipe" name="photoEquipe" src="../image/photo/<?php if(!isset($donnees['photoEquipe'])){?>imageDefaut.png<?php }else{ echo $donnees['photoEquipe'];}?>" alt="image défaut">
                </fieldset>
                <fieldset>
                    <label for="">Ajouter une photo : </label>
                    <input type="file" name="downloadPhoto" id="downloadPhoto">
                </fieldset>
                <fieldset>
                    <label for="">Ajouter légende : </label>
                    <input placeholder="Ajouter une légende à la photo" type="text" name="altPhotoEquipe" id="altPhotoEquipe" value="<?php if(isset($_GET['id'])){echo $donnees['altPhotoEquipe'];}?>">
                </fieldset>
            </div>
            <br>
            <fieldset>
                <label for="">Prénom : </label>
                <input placeholder="Prénom" type="text" name="prenomEquipe" id="prenomEquipe" value="<?php if(isset($_GET['id'])){echo $donnees['prenomEquipe'];}?>">
            </fieldset>

            <fieldset>
                <label for="">Nom : </label>
                <input placeholder="Nom" type="text" name="nomEquipe" id="nomEquipe" value="<?php if(isset($_GET['id'])){echo $donnees['nomEquipe'];}?>">
            </fieldset>

            <fieldset>
                <label for="">Désignation : </label>
                <input placeholder="Désignation" type="text" name="designationEquipe" id="designationEquipe" value="<?php if(isset($_GET['id'])){echo $donnees['designationEquipe'];}?>">
            </fieldset>
            <fieldset class="buttonRadio">
                <label for="">Status : </label>

                    <div >

                        <input type="radio" id="actif" name="statusEquipe" value="1"
                        <?php if(!isset($_GET['id'])){?>checked="checked"<?php }elseif($donnees['statusEquipe']==1){?>checked="checked"<?php }?>>
                        <label for="actif">Actif</label>
                    </div>

                <div>
                        <input type="radio" id="inactif" name="statusEquipe" value="2"
                        <?php if(!isset($_GET['id'])){}elseif($donnees['statusEquipe']==2){?>checked="checked"<?php }?>>
                        <label for="inactif">Inactif</label>
                    </div>

            </fieldset>

            <div class="button">
                <button type="submit"><?php echo $button;?></button>
            </div>
        </form>
        <a href="../dashboard#form_equipe"><button>Annulé</button></a>
    </div>
    <!-- fin de id="trt_equipe_form" -->
    </body>

</html>
