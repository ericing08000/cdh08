<?php
if(isset($_SESSION['pseudoUser'])){

   session_start();
}


//----------------------------------------
//Connexion à la base de données en POO
//----------------------------------------
require_once('class/Database.php');
$connect = new Database('localhost:3308' , 'cdh08' , 'ericing', 'Eric@ing%08000');
$bdd = $connect->PDOConnexion();

?>
<!DOCTYPE html>

<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="image/logo/cdh08.ico" type="image/x-icon">
        <link rel="stylesheet" href="css/recyclerie.css">
        <title>Recyclerie</title>
    </head>

    <body>
        <!----------------------->
        <!--Navbar-->
        <!----------------------->    
        <?php 
        
        include ('include/navbar.php');
        
        
        ?>
       

        <!-------------------------->
        <!------- Parallax --------->
        <!-------------------------->
        <div  id="recyclerie" class="recyclerie_parallax">
            <h2>La recyclerie</h2>
        </div>
        
        <!-------------------------->
        <!-- La recyclerie -->
        <!-------------------------->
        <div class="recyclerie_intitule">
            <h1>La recyclerie</h1>
            <hr>
            <div class="recyclerie">
                
            <?php
            //------------------------------------------
            //-- Préparer le requête pour la recyclerie 
            //------------------------------------------
            $req = $bdd->prepare("SELECT * FROM recyclerie WHERE quantiteMateriel > 0");
            $req -> execute();

            $count = $req->rowcount();
            
            if($count > 0){

                while($donnees = $req->fetch()){
                    //Afficher le résultat de la requête
                    //var_dump($donnees);
                    
                    ?>
                    <div class="photo">
                        <div class="card" title="<?= $donnees['nomMateriel'];?>" id="btn_recyclerie">
                        <div class="card_header">
                            <img title="logo Handisport" src="image/logo/cdh08.png" alt="logo Handisport">
                            <img title="<?= $donnees['nomMateriel'];?>" src="image/recyclerie/<?= $donnees['photoMateriel'];?>" alt="<?= $donnees['altPhotoMateriel'];?>">  
                        </div>
                        <div class="card_footer">
                            <p><?= $donnees['nomMateriel'];?></p>
                
                            <div class="card_quantite">
                                <h4><?= $donnees['quantiteMateriel'];?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- fin de class="card" -->
                    </div>
                    <!-- fin de class="photo" -->
                    
                    <?php   }   $req -> closeCursor(); ?> 
                </div>
                <!-- fin de class="photo" -->
            <?php }else{?>
                <div class="photo_null">
                    <div class="card_null" title="Pas de materiel à proposer" id="btn_recyclerie">
                    <div class="card_header">
                        <img title="logo Handisport" src="image/logo/cdh08.png" alt="logo Handisport">
                        <img title="handbike" src="image/recyclerie/imageDefaut.png" alt="">  
                    </div>
                    <div class="card_footer">
                        <p>Pas de materiel à proposer</p>
            
                        <div class="card_quantite">
                            <h4>0</h4>
                        </div>
                    </div>
                </div>
                <!-- fin de class="card" -->
                </div>
                <!-- fin de class="photo" -->
            <?php }?>

                
            </div>
            <!-- fin de class="recyclerie" -->

        <?php include ('include/modal_form_recyclerie.php');?>       
        <!----------------------->
        <!--footer-->
        <!----------------------->    
        <?php include ('include/footer.php');?>

        <script src="js/jquery.js"></script>  
         
    </body>
    
    
</html>
