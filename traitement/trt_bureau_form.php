<!-------------------------------------->
<!-- Formlaire - Bureau -->
<!-------------------------------------->

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

        $title = "Éditer un membre du Bureau";
        $button = "Modifier";
        //echo $_GET['id'];

    //-----------------------------------------------
    //-- Requête : ID_Bureau ='".$_GET['id']."' ---
    //-----------------------------------------------
    $req = $bdd->prepare("SELECT * FROM bureau WHERE ID_Bureau='".$_GET['id']."'");
    $req -> execute();

        $donnees = $req->fetch();
        //Afficher le résultat de la requête
        // echo"<pre>";
        // print_r($donnees);
        // echo"</pre>";

    }else{
        $title = "Ajouter un membre du Bureau";
        $button = "Ajouter";

    }

    if(isset($_GET['suppr'])){
        //echo $_GET['suppr'];
        $title = "Supprimer un membre du Bureau";
        $button = "Supprimer";
    }

?>


<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/trt_bureau_form.css">
        <title>Traitement - Bureau</title>
    </head>

    <body>
    <div id="trt_bureau_form">
        <h1><?php echo $title ?></h1>

        <!------------------------->
        <!-- Gestion des erreurs -->
        <!------------------------->
        <?php
                
        if(isset($_GET['error'])){
                if($_GET['error'] ==1) {?>
                    <div class="error">
                        <h3>Vous devez renseigner le prénom du membre</h3>
                    </div>
                <?php }
                    if($_GET['error'] ==2) {?>
                    <div class="error">
                        <h3>Vous devez renseigner le nom du membre.</h3>
                    </div>    
                <?php }
                    if($_GET['error'] ==3) {?>
                        <div class="error">
                            <h3>Vous devez ajouter une photo.</h3>
                        </div>
                    <?php }
                        if($_GET['error'] ==4) {?>
                            <div class="error">
                                <h3>Vous devez ajouter une légende à la photo.</h3>
                            </div>
                        <?php }
            } ?>

        <!------------------------------------------>
        <!-- Formulaire de traitement Bureau -->
        <!------------------------------------------>
        <form  class="trt_bureau_form" enctype="multipart/form-data" action="trt_bureau.php?method=<?php
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
            <div id="photo">
                <fieldset class="photo">
                    <img value="photoBureau" name="photoBureau" src="../image/photo/<?php if(!isset($donnees['photoBureau'])){?>imageDefaut.png<?php }else{ echo $donnees['photoBureau'];}?>" alt="image défaut">
                </fieldset>
                <fieldset>
                    <label for="">Ajouter une photo : </label>
                    <input type="file" name="downloadPhoto" id="downloadPhoto">
                </fieldset>
                <fieldset>
                    <label for="">Ajouter légende : </label>
                    <input placeholder="Ajouter une légende à la photo*" type="text" name="altPhoto" id="altPhoto" value="<?php if(isset($_GET['id'])){echo $donnees['altPhoto'];}?>">
                </fieldset>
            </div>
            <br>
            <fieldset>
                <label for="">Prénom : </label>
                <input placeholder="Prénom*" type="text" name="prenomBureau" id="prenomBureau" 
                value="<?php if(isset($_GET['prenom'])){echo $_GET['prenom'];}else{if(isset($_GET['id'])){echo $donnees['prenomBureau'];}}?>">
            </fieldset>

            <fieldset>
                <label for="">Nom : </label>
                <input placeholder="Nom*" type="text" name="nomBureau" id="nomBureau" value="<?php if(isset($_GET['nom'])){echo $_GET['nom'];}else{if(isset($_GET['id'])){echo $donnees['nomBureau'];}}?>">
            </fieldset>

            <fieldset>
                <label for="">Désignation : </label>
                <select name="designationBureau" id="designationBureau">
                    <option <?php if(isset($donnees['designationBureau'])){if($donnees['designationBureau']=='Le Président'){ echo "selected='selected'";}}?> value="Le Président">Le Président</option>
                    <option <?php if(isset($donnees['designationBureau'])){if($donnees['designationBureau']=='Le Vice-Président') {echo "selected='selected'";}}?> value="Le Vice-Président">Le Vice-Président</option>
                    <option <?php if(isset($donnees['designationBureau'])){if($donnees['designationBureau']=='Le Vice-Président suppléant'){ echo "selected='selected'";}}?> value="Le Vice-Président suppléant">Le Vice-Président suppléant</option>
                    <option <?php if(isset($donnees['designationBureau'])){if($donnees['designationBureau']=='Le Trésorier'){ echo "selected='selected'";}}?> value="Le Trésorier">Le Trésorier</option>
                    <option <?php if(isset($donnees['designationBureau'])){if($donnees['designationBureau']=='Le Secrétaire Général') {echo "selected='selected'";}}?> value="Le Secrétaire Général">Le Secrétaire Général</option>
                </select>
            </fieldset>
            <fieldset class="buttonRadio">
                <label for="">Status : </label>

                    <div >

                        <input type="radio" id="actif" name="statusBureau" value="1"
                        <?php if(!isset($_GET['id'])){?>checked="checked"<?php }elseif($donnees['statusBureau']==1){?>checked="checked"<?php }?>>
                        <label for="actif">Actif</label>
                    </div>

                <div>
                        <input type="radio" id="inactif" name="statusBureau" value="2"
                        <?php if(!isset($_GET['id'])){}elseif($donnees['statusBureau']==2){?>checked="checked"<?php }?>>
                        <label for="inactif">Inactif</label>
                    </div>

            </fieldset>

            <div class="button">
                <button type="submit"><?php echo $button;?></button>
            </div>
        </form>
        <a href="../dashboard#form_bureau"><button>Annulé</button></a>
    </div>
    <!-- fin de id="trt_bureau_form" -->
    </body>

</html>
