<!-------------------------------->
<!-- Formulaire - Utilisateur -->
<!-------------------------------->

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

        $title = "Éditer un utilisateur";
        $button = "Modifier";
        //echo $_GET['id'];
        
    //-----------------------------------------------
    //-- Requête : ID_user ='".$_GET['id']."' ---
    //-----------------------------------------------
    $req = $bdd->prepare("SELECT u.ID_user, u.pseudoUser, u.prenomUser, u.nomUser, tp.nomTypeCompte,u.telUser, u.emailUser, u.mdpUser, tp.ID_typeCompte FROM user AS u, type_compte AS tp WHERE ID_user='".$_GET["id"]."' AND u.ID_typeCompte=tp.ID_typeCompte ORDER BY u.pseudoUser");
    $req -> execute();

        $donnees = $req->fetch();
        //Afficher le résultat de la requête  
        // echo"<pre>";
        // print_r($donnees);
        // echo"</pre>";
    }else{
        $title = "Ajouter un utilisateur";
        $button = "Ajouter";
        
    }

    if(isset($_GET['suppr'])){
        //echo $_GET['suppr'];
        $title = "Supprimer un utilisateur";
        $button = "Supprimer";
    }

?>


<!DOCTYPE html>

<html lang="fr" id="haut">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="../image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="../css/trt_user_form.css">
        <title>Traitement - Utilisateur</title>
    </head>

    <body>
    <div id="trt_user_form">
        <h1><?php echo $title ?></h1>

        <!------------------------->
        <!-- Gestion des erreurs -->
        <!------------------------->
        <?php if(isset($_GET['error'])){
                if($_GET['error'] ==1) {?>
                    <div class="error">
                        <h3>Le pseudo existe déjà.</h3>
                    </div>
                <?php }
                    if($_GET['error'] ==2) {?>
                    <div class="error">
                        <h3>L'email existe déjà.</h3>
                    </div>
                <?php }} ?>

        <!------------------------------------------>
        <!-- Formulaire de traitement utilisateur -->
        <!------------------------------------------>
        <form  class="trt_user_form" action="trt_user.php?method=<?php
            if(!isset($_GET['id'])){
                echo 'insert';}
            else
            {
                if(isset($_GET['suppr']) && isset($_GET['id'])){
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
            
                <fieldset>
                    <label for="">Pseudo : </label>
                    <input placeholder="Pseudo" type="text" name="pseudoUser" id="pseudoUser" 
                    value="<?php if(isset($_GET['id'])){ echo $donnees['pseudoUser'];
                                }else{ echo '';}?>" required>
                </fieldset>

                <fieldset>
                    <label for="">Prénom : </label>
                    <input placeholder="Prénom" type="text" name="prenomUser" id="prenomUser" value="<?php if(isset($_GET['id'])){ echo $donnees['prenomUser'];}else{ echo '';}?>" required>
                </fieldset>

                <fieldset>
                    <label for="">Nom : </label>
                    <input placeholder="Nom" type="text" name="nomUser" id="nomUser" value="<?php if(isset($_GET['id'])){ echo $donnees['nomUser'];}else{ echo '';}?>" required>
                </fieldset>
            
                <fieldset>
                    <label for="">Type de compte : </label>
                    <select name="ID_typeCompte" id="ID_typeCompte">
                        <?php
                        // On prépare la requête liste type compte dans une variable «$req_list:
                        $req_list = $bdd->prepare("SELECT * FROM type_compte ORDER BY nomTypeCompte");
                        $req_list->execute();
                            
                            //boucle sur la requête liste type compte
                            while($donnees1 = $req_list->fetch()){?>
                        
                            <option <?php if(!isset($_GET['ID_typeCompte'])){$_GET['ID_typeCompte']=1;} if($donnees1['ID_typeCompte']==$_GET['ID_typeCompte']) echo "selected='selected'";?>value="<?php echo $donnees1['ID_typeCompte'];?>"><?php echo $donnees1['nomTypeCompte'];?></option>
                            
                            <?php } ?>
                        
                    </select>
                </fieldset>
                <fieldset>
                    <label for="">Téléphone : </label>
                    <input id="telUser" title="Renseigner votre téléphone ou votre portable*" placeholder="Téléphone ou portable 00.00.00.00.00*" type="tel" pattern="[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}.[0-9]{2}" name="telUser" value ="<?php if(isset($_GET['id'])){ echo $donnees['telUser'];}else{ echo '';}?>"required>
                </fieldset>
                <fieldset>
                    <label for="">Email : </label>
                    <input id="emailUser" title="Renseigner votre email" placeholder="Email*" type="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[a-z]{2,}$" name="emailUser" value="<?php if(isset($_GET['id'])){ echo $donnees['emailUser'];}else{ echo '';}?>" required>
                </fieldset>
                <?php if(!isset($_GET['id'])){?>                  
                    <fieldset>
                        <label for="">Mot de passe : </label>
                        <input placeholder="Mot de passe" type="password" name="mdpUser" id="mdpUser" value="<?php if(isset($_GET['id'])){ echo $donnees['mdpUser'];}else{ echo '';}?>" required>
                    </fieldset>
                <?php }?>

                <div class="button">
                    <button type="submit"><?php echo $button;?></button>
                </div>          
        </form>
        <a href="../dashboard#form_user"><button>Annulé</button></a>
    </div>
    <!-- fin de  id="trt_user_form"-->
    
    </body>

</html>
