<?php 
//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('../class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
    <link rel="stylesheet" href="../css/trt_reset_forgotMdp.css">
    <title>Traitement - Réinitialisation du mot de passe</title>
</head>
<body>
    <div id="trt_reset_forgotMdp_form">
            
        <?php  
            $search = $bdd->prepare("SELECT * FROM user WHERE ID_user = '".$_GET['id']."' ");
            $search-> execute();
            $data_search = $search->fetch();
        ?>
        <!------------------------->
        <!-- Gestion des erreurs -->
        <!------------------------->
        <?php
                
        if(isset($_GET['success'])){
            if($_GET['success'] == 1) {?>
                <div class="success">
                    <h3>Votre mot de passe a bien été réinitialiser, vous pouvez vous connecter.</h3>
                </div>
            <?php }
                
        } 
        if(isset($_GET['error'])){
            if(isset($_GET['error'])){
                if($_GET['error'] == 1) {?>
                    <div class="error">
                        <h3>Votre mot de passe de confirmation n'est pas valide.</h3>
                    </div>
                <?php }
            
            }
        }?>

            <!-------------------------->
            <!-- Formulaire reset Mdp -->
            <!-------------------------->
            <?php if(!isset($_GET['success'])){?> 

            <form id="reset_forgotMdp_form" action="trt_reset_forgotMdp.php?id=<?=$data_search['ID_user'];?>" method="post">
                <h3>Bienvenue : <a><?=$data_search['pseudoUser'];?></a></h3>

                <fieldset>
                    <label>Mot de passe : </label>
                    <input placeholder="Mot de passe" type="password" name="mdpUser" id="mdpUser" autofocus required>
                </fieldset>
                <fieldset>
                    <label>Confirmation du mot de passe : </label>
                    <input placeholder="Mot de passe" type="password" name="confirmMdpUser" id="confirmMdpUser" required>
                </fieldset>
                <br>
                <div class="trt_reset_forgotMdp_form">
                    <div class="button">
                        <button type="submit">Valider</button>
                    </div>
                </div>

            </form>
            <!-- Fin du formulaire -->
            <?php }?>




            <!-- Gestion des boutons -->
            <p style="display:none" id="error_signin"></p>
            
            <div class="trt_reset_forgotMdp_form">
                <div class="button">
                
                    <?php
                        if(isset($_GET['success'])){?>
                        <a href="javascript:window.close();"><button>Quitter</button></a>
                    <?php } ?>        
                </div>
            </div>
        
    </div>
    <!-- fin de id="trt_bureau_form" -->
</body>


</html>